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

        $fields = $this->object->Type->getMany('Fields', array('required' => 1));

        /** @var MarvinField $field */
        foreach ($fields as $field) {
            $custom = $this->getProperty('custom-' . $field->id);
            if (empty($custom)) {
                $this->addFieldError('custom-' . $field->id, $this->modx->lexicon('marvin.location.err_ns_custom'));
            }
        }

        $this->setProperty('updated', time());
        $this->setProperty('updated_by', $this->modx->user->id);

        return parent::beforeSet();
    }

    public function afterSave(){
        $this->object->addCategories($this->categories);

        $fields = $this->object->Type->Fields;

        /** @var MarvinField $field */
        foreach ($fields as $field) {
            /** @var MarvinFieldValue $value */
            $value = $field->getMany('Values', array('location' => $this->object->id));
            if (!$value) {
                $value = $this->modx->newObject('MarvinFieldValue');
                $value->set('location', $this->object->id);
                $value->set('field', $field->id);
                $value->set('value', $this->getProperty('custom-' . $field->id));
                $value->save();
            } else {
                foreach ($value as $v) {
                    $v->set('value', $this->getProperty('custom-' . $field->id));
                    $v->save();
                    break;
                }
            }
        }

        return parent::afterSave();
    }

}
return 'MarvinLocationUpdateProcessor';
