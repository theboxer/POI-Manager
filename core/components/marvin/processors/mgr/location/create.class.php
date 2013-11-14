<?php
/**
 * Create a Location
 * 
 * @package marvin
 * @subpackage processors.location
 */
class MarvinLocationCreateProcessor extends modObjectCreateProcessor {
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
            $this->addFieldError('fake_category',$this->modx->lexicon('marvin.location.err_ns_category'));
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

        $this->setProperty('created', time());

        return parent::beforeSave();
    }

    public function afterSave() {
        $this->object->addCategories($this->categories);
    }

}
return 'MarvinLocationCreateProcessor';
