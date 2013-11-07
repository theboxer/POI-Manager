<?php
/**
 * Create an Item
 * 
 * @package marvin
 * @subpackage processors
 */
class MarvinCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'MarvinItem';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.items';

    public function beforeSet(){
        $items = $this->modx->getCollection($this->classKey);

        $this->setProperty('position', count($items));

        return parent::beforeSet();
    }

    public function beforeSave() {
        $name = $this->getProperty('name');

        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('marvin.item_err_ns_name'));
        } else if ($this->doesAlreadyExist(array('name' => $name))) {
            $this->addFieldError('name',$this->modx->lexicon('marvin.item_err_ae'));
        }
        return parent::beforeSave();
    }
}
return 'MarvinCreateProcessor';
