<?php
/**
 * Loads the home page.
 *
 * @package marvin
 * @subpackage controllers
 */
class MarvinLocationUpdateManagerController extends MarvinBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }
    public function getPageTitle() { return $this->modx->lexicon('marvin'); }
    public function loadCustomCssJs() {
        $this->addCss($this->marvin->config['cssUrl'].'superboxselect.css');

        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/extra/SuperBoxSelect.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/extra/marvin.combo.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/location/marvin.panel.location.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/sections/location/create.js');
    }
    public function getTemplateFile() { return $this->marvin->config['templatesPath'].'location/location.tpl'; }
}
