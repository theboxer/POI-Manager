<?php
/**
 * Loads the home page.
 *
 * @package marvin
 * @subpackage controllers
 */
class MarvinLocationTypeListManagerController extends MarvinBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }
    public function getPageTitle() { return $this->modx->lexicon('marvin'); }
    public function loadCustomCssJs() {
        $this->addJavascript($this->marvin->config['jsUrl'].'mgr/widgets/locationtype/marvin.grid.locationtype.js');
        $this->addJavascript($this->marvin->config['jsUrl'].'mgr/widgets/locationtype/marvin.panel.locationtype.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/sections/locationtype/list.js');
    }
    public function getTemplateFile() { return $this->marvin->config['templatesPath'].'locationtype/locationtype.tpl'; }
}
