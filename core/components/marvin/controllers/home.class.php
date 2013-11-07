<?php
/**
 * Loads the home page.
 *
 * @package marvin
 * @subpackage controllers
 */
class MarvinHomeManagerController extends MarvinBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }
    public function getPageTitle() { return $this->modx->lexicon('marvin'); }
    public function loadCustomCssJs() {
        $this->addJavascript($this->marvin->config['jsUrl'].'mgr/extra/griddraganddrop.js');
        $this->addJavascript($this->marvin->config['jsUrl'].'mgr/widgets/items.grid.js');
        $this->addJavascript($this->marvin->config['jsUrl'].'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/sections/home.js');
    }
    public function getTemplateFile() { return $this->marvin->config['templatesPath'].'home.tpl'; }
}
