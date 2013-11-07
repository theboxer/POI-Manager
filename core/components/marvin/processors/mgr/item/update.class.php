<?php
/**
 * Update an Item
 * 
 * @package marvin
 * @subpackage processors
 */

class MarvinUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'MarvinItem';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.items';

    public function beforeSet() {
        $name = $this->getProperty('name');

        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('marvin.item_err_ns_name'));

        } else if ($this->modx->getCount($this->classKey, array('name' => $name)) && ($this->object->name != $name)) {
            $this->addFieldError('name',$this->modx->lexicon('marvin.item_err_ae'));
        }
        return parent::beforeSet();
    }

}
return 'MarvinUpdateProcessor';
