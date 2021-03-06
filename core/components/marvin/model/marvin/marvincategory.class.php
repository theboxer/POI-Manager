<?php
require_once MODX_CORE_PATH.'model/modx/modprocessor.class.php';
require_once MODX_CORE_PATH.'model/modx/processors/resource/create.class.php';
require_once MODX_CORE_PATH.'model/modx/processors/resource/update.class.php';
/**
 * @property MarvinCategoryExtendedFields $ExtendedFields
 * @property MarvinLocationCategory $CategoryLocations
 *
 * @package marvin
 */
class MarvinCategory extends modResource {
    public $showInContextMenu = true;

    function __construct(xPDO & $xpdo) {
        parent :: __construct($xpdo);
        $this->set('class_key','MarvinCategory');
    }

    public static function getControllerPath(xPDO &$modx) {
        return $modx->getOption('marvin.core_path',null,$modx->getOption('core_path').'components/marvin/').'controllers/';
    }

    public function getContextMenuText() {
        $this->xpdo->lexicon->load('marvin:default');
        return array(
            'text_create' => $this->xpdo->lexicon('marvin.system.text_create'),
            'text_create_here' => $this->xpdo->lexicon('marvin.system.text_create_here'),
        );
    }

    public function getResourceTypeName() {
        $this->xpdo->lexicon->load('marvin:default');
        return $this->xpdo->lexicon('marvin.system.type_name');
    }
}

class MarvinCategoryCreateProcessor extends modResourceCreateProcessor {
    /** @var MarvinCategory $object */
    public $object;

    public function beforeSave() {
        /** @var MarvinCategoryExtendedFields $categoryExtendedFields */
        $categoryExtendedFields = $this->modx->newObject('MarvinCategoryExtendedFields');

        $categoryExtendedFields->fromArray($this->getProperties());

        $this->object->addOne($categoryExtendedFields, 'ExtendedFields');

        return parent::beforeSave();
    }
}

class MarvinCategoryUpdateProcessor extends modResourceUpdateProcessor {
    /** @var MarvinCategory $object */
    public $object;

    public function beforeSave() {
        /** @var MarvinCategoryExtendedFields $categoryExtendedFields */
        $categoryExtendedFields = $this->object->ExtendedFields;

        $categoryExtendedFields->fromArray($this->getProperties());

        $this->object->addOne($categoryExtendedFields, 'ExtendedFields');

        return parent::beforeSave();
    }
}
