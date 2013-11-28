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
            $this->addFieldError('fake_categories',$this->modx->lexicon('marvin.location.err_ns_category'));
        }

        $name = $this->getProperty('name');
        $alias = $this->getProperty('alias');

        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('marvin.location.err_ns_name'));
        }

        $locationType = $this->getProperty('type');
        if (empty($locationType)) {
            $this->addFieldError('type',$this->modx->lexicon('marvin.location.err_ns_type'));

        }

        $modResource = new modResource($this->modx);
        if (empty($alias)) {
            $this->setProperty('alias', $modResource->cleanAlias($name));
        }

        $type = $this->modx->getObject('MarvinLocationType', $locationType);
        $fields = $type->getMany('Fields', array('required' => 1));

        /** @var MarvinField $field */
        foreach ($fields as $field) {
            $custom = $this->getProperty('custom-' . $field->id);
            if (empty($custom)) {
                $this->addFieldError('custom-' . $field->id, $this->modx->lexicon('marvin.location.err_ns_custom'));
            }
        }

        $this->setProperty('created', time());

        return parent::beforeSet();
    }

    public function afterSave() {
        $this->object->addCategories($this->categories);

        $fields = $this->object->Type->Fields;

        /** @var MarvinField $field */
        foreach ($fields as $field) {
            /** @var MarvinFieldValue $value */

            $value = $this->modx->newObject('MarvinFieldValue');
            $value->set('location', $this->object->id);
            $value->set('field', $field->id);
            $value->set('value', $this->getProperty('custom-' . $field->id));
            $value->save();
        }

        return parent::afterSave();
    }

}
return 'MarvinLocationCreateProcessor';
