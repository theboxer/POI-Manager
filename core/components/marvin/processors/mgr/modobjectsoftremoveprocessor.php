<?php

abstract class modObjectSoftRemoveProcessor extends modObjectProcessor
{
    /** @var boolean $checkRemovePermission If set to true, will check the remove permission on modAccessibleObjects */
    public $checkRemovePermission = true;
    /** @var string $beforeRemoveEvent The name of the event to fire before removal */
    public $beforeRemoveEvent = '';
    /** @var string $afterRemoveEvent The name of the event to fire after removal */
    public $afterRemoveEvent = '';
    /** @var bool $userDeletedOn To use or not deleted on field */
    public $useDeletedOn = true;
    /** @var string $deletedOnField Name of deleted on field */
    public $deletedOnField = 'deleted_on';
    /** @var bool $userDeleted To use or not deleted field */
    public $useDeleted = true;
    /** @var string $deletedField Name of deleted field */
    public $deletedField = 'deleted';
    /** @var bool $userDeletedBy To use or not deleted by field */
    public $useDeletedBy = true;
    /** @var string $deletedByField Name of deleted by field */
    public $deletedByField = 'deleted_by';

    public function initialize() {
        $primaryKey = $this->getProperty($this->primaryKeyField, false);
        if (empty($primaryKey)) {
            return $this->modx->lexicon($this->objectType . '_err_ns');
        }
        $this->object = $this->modx->getObject($this->classKey, $primaryKey);
        if (empty($this->object)) {
            return $this->modx->lexicon($this->objectType . '_err_nfs', array($this->primaryKeyField => $primaryKey));
        }

        if ($this->checkRemovePermission && $this->object instanceof modAccessibleObject && !$this->object->checkPolicy('remove')) {
            return $this->modx->lexicon('access_denied');
        }

        if (!$this->useDeleted && !$this->useDeletedOn && !$this->useDeletedBy) {
            return $this->modx->lexicon($this->objectType . '_err_dt_ns');
        }

        if ($this->useDeleted && ($this->deletedField == null)) {
            return $this->modx->lexicon($this->objectType . '_err_df_ns');
        }

        if ($this->useDeletedOn && ($this->deletedOnField == null)) {
            return $this->modx->lexicon($this->objectType . '_err_dof_ns');
        }

        if ($this->useDeletedBy && ($this->deletedByField == null)) {
            return $this->modx->lexicon($this->objectType . '_err_dbf_ns');
        }


        return true;
    }

    public function process() {
        $canRemove = $this->beforeRemove();
        if ($canRemove !== true) {
            return $this->failure($canRemove);
        }
        $preventRemoval = $this->fireBeforeRemoveEvent();
        if (!empty($preventRemoval)) {
            return $this->failure($preventRemoval);
        }


        if ($this->useDeleted) {
            $this->object->set($this->deletedField, true);
        }

        if ($this->useDeletedOn) {
            $this->object->set($this->deletedOnField, time());
        }

        if ($this->useDeletedBy) {
            $this->object->set($this->deletedByField, $this->modx->user->id);
        }

        if ($this->object->save() == false) {
            return $this->failure($this->modx->lexicon($this->objectType . '_err_soft_remove'));
        }

        $this->afterRemove();
        $this->fireAfterRemoveEvent();
        $this->logManagerAction();
        $this->cleanup();

        return $this->success('', array($this->primaryKeyField => $this->object->get($this->primaryKeyField)));
    }

    /**
     * Can contain pre-removal logic; return false to prevent remove.
     * @return boolean
     */
    public function beforeRemove() {
        return !$this->hasErrors();
    }

    /**
     * Can contain post-removal logic.
     * @return bool
     */
    public function afterRemove() {
        return true;
    }

    /**
     * Log the removal manager action
     * @return void
     */
    public function logManagerAction() {
        $this->modx->logManagerAction($this->objectType . '_soft_delete', $this->classKey, $this->object->get($this->primaryKeyField));
    }

    /**
     * After removal, manager action log, and event firing logic
     * @return void
     */
    public function cleanup() {
    }

    /**
     * If specified, fire the before remove event
     * @return boolean Return false to allow removal; non-empty to prevent it
     */
    public function fireBeforeRemoveEvent() {
        $preventRemove = false;
        if (!empty($this->beforeRemoveEvent)) {
            $response = $this->modx->invokeEvent($this->beforeRemoveEvent, array(
                                                                                $this->primaryKeyField => $this->object->get($this->primaryKeyField),
                                                                                $this->objectType => &$this->object,
                                                                           ));
            $preventRemove = $this->processEventResponse($response);
        }

        return $preventRemove;
    }

    /**
     * If specified, fire the after remove event
     * @return void
     */
    public function fireAfterRemoveEvent() {
        if (!empty($this->afterRemoveEvent)) {
            $this->modx->invokeEvent($this->afterRemoveEvent, array(
                                                                   $this->primaryKeyField => $this->object->get($this->primaryKeyField),
                                                                   $this->objectType => &$this->object,
                                                              ));
        }
    }
}
