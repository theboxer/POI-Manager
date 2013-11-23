<?php
/**
 * @package marvin
 * @subpackage processors.locationtype
 */
class MarvinLocationTypeGetProcessor extends modObjectGetProcessor
{
    public $classKey = 'MarvinLocationType';
    public $languageTopics = array('marvin:default');
    /** @var MarvinLocationType $object */
    public $object;

    public function beforeOutput() {
        /** @var modUser $updatedBy */
        $updatedBy = $this->object->getOne('UpdatedBy');
        if ($updatedBy) {
            $this->object->set('updated_by_name', $updatedBy->Profile->fullname);
        }
    }
}

return 'MarvinLocationTypeGetProcessor';
