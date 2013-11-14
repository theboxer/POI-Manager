<?php
require_once dirname(__FILE__) . '/model/marvin/marvin.class.php';
/**
 * @package marvin
 */
abstract class MarvinBaseManagerController extends modExtraManagerController {
    /** @var Marvin $marvin */
    public $marvin;
    public function initialize() {
        $this->marvin = new Marvin($this->modx);

        $this->addCss($this->marvin->config['cssUrl'].'mgr.css');
        $this->addJavascript($this->marvin->config['jsUrl'].'mgr/marvin.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            Marvin.config = '.$this->modx->toJSON($this->marvin->config).';
            Marvin.config.connector_url = "'.$this->marvin->config['connectorUrl'].'";
        });
        </script>');
        return parent::initialize();
    }
    public function getLanguageTopics() {
        return array('marvin:default');
    }
    public function checkPermissions() { return true;}
}

class IndexManagerController extends MarvinBaseManagerController {
    public static function getDefaultController() { return 'home'; }
}


