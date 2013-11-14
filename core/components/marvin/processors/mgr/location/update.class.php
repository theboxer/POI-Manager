<?php
/**
 * Update a Location
 * 
 * @package marvin
 * @subpackage processors
 */

class MarvinLocationUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'MarvinLocation';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.location';
    /** @var MarvinLocation $object */
    public $object;
    /** @var array $categories */
    private $categories;

    public function beforeSet() {
        $categories = $this->getProperty('categories', '');
        $this->categories = $this->modx->marvin->explodeAndClean($categories);

        if (count($this->categories) <= 0) {
            $this->addFieldError('fake_categories',$this->modx->lexicon('marvin.location.err_ns_category'));
        }

        $name = $this->getProperty('name');
        $alias = $this->getProperty('alias');

        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('marvin.location.err_ns_name'));
        }

        $modResource = new modResource($this->modx);
        if (empty($alias)) {
            $this->setProperty('alias', $modResource->cleanAlias($name));
        }

        $this->setProperty('updated', time());
        $this->setProperty('updated_by', $this->modx->user->id);
        
        return parent::beforeSet();
    }

    public function afterSave(){
        $this->object->addCategories($this->categories);
    }

}
return 'MarvinLocationUpdateProcessor';
