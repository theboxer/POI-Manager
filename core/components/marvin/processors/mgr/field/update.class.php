<?php
/**
 * Update a Field
 * 
 * @package marvin
 * @subpackage processors.field
 */

class MarvinFieldUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'MarvinField';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.field';
    /** @var MarvinField $object */
    public $object;

    public function beforeSet() {
        $this->setProperty('updated', time());
        $this->setProperty('updated_by', $this->modx->user->id);

        return parent::beforeSet();
    }

}
return 'MarvinFieldUpdateProcessor';
