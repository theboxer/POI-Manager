<?php
/**
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
            'text_create' => 'marvin',
            'text_create_here' => 'cerate marvin here',
        );
    }

    public function getResourceTypeName() {
        $this->xpdo->lexicon->load('marvin:default');
        return 'Marvin';
    }
}