<?php
/**
 * Loads the home page.
 *
 * @package marvin
 * @subpackage controllers
 */
class MarvinLocationTypeUpdateManagerController extends MarvinBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }
    public function getPageTitle() { return $this->modx->lexicon('marvin'); }
    public function loadCustomCssJs() {
        $this->addJavascript($this->marvin->config['jsUrl'].'mgr/extra/marvin.combo.js');
        $this->addJavascript($this->marvin->config['jsUrl'].'mgr/widgets/field/marvin.window.field.js');
        $this->addJavascript($this->marvin->config['jsUrl'].'mgr/widgets/field/marvin.grid.field.js');
        $this->addJavascript($this->marvin->config['jsUrl'].'mgr/widgets/locationtype/marvin.panel.locationtypeform.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/sections/locationtype/update.js');
    }
    public function getTemplateFile() { return $this->marvin->config['templatesPath'].'locationtype/locationtype.tpl'; }
}
