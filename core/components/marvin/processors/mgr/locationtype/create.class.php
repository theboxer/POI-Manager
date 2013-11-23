<?php
/**
 * Create a Location type
 * 
 * @package marvin
 * @subpackage processors.locationtype
 */
class MarvinLocationTypeCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'MarvinLocationType';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.locationtype';
    /** @var MarvinLocationType $object */
    public $object;

    public function beforeSet() {
        $name = $this->getProperty('name');

        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('marvin.locationtype.err_ns_name'));
        } else {
            if ($this->doesAlreadyExist(array('name' => $name))) {
                $this->addFieldError('name', $this->modx->lexicon('marvin.locationtype.err_ae_name'));
            }
        }

        $this->setProperty('created', time());

        return parent::beforeSet();
    }
}
return 'MarvinLocationTypeCreateProcessor';
