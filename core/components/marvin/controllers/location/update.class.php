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

        $this->addLastJavascript('http://maps.google.com/maps/api/js?sensor=false');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/extra/SuperBoxSelect.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/extra/marvin.combo.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/extra/gmappanel.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/extra/map.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/location/marvin.panel.location.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/feedback/marvin.grid.feedback.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/feedback/marvin.window.feedback.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/comment/marvin.grid.comment.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/comment/marvin.window.comment.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/sections/location/create.js');
    }
    public function getTemplateFile() { return $this->marvin->config['templatesPath'].'location/location.tpl'; }
}
