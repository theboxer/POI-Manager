<?php
/**
 * Update a Location type
 * 
 * @package marvin
 * @subpackage processors.locationtype
 */

class MarvinLocationTypeUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'MarvinLocationType';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.locationtype';
    /** @var MarvinLocationType $object */
    public $object;

    public function beforeSet() {
        $name = $this->getProperty('name');
        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('marvin.locationtype.err_ns_name'));
        } else if ($this->modx->getCount($this->classKey, array('name' => $name)) && ($this->object->name != $name)) {
            $this->addFieldError('name', $this->modx->lexicon('marvin.locationtype.err_ae_name'));
        }

        $this->setProperty('updated', time());
        $this->setProperty('updated_by', $this->modx->user->id);

        return parent::beforeSet();
    }

}
return 'MarvinLocationTypeUpdateProcessor';
