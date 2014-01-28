<?php
/**
 * Marvin's API
 *
 * @package marvin
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
if (!include_once(MODX_CORE_PATH . 'model/modx/modx.class.php')) die();

use Luracast\Restler\AutoLoader;

class API {
    /** @var modX $modx */
    public $modx;
    /** @var Marvin $marvin */
    public $marvin;

    public function __construct() {
        $this->modx= new modX('', array(xPDO::OPT_CONN_INIT => array(xPDO::OPT_CONN_MUTABLE => true)));

        /* initialize the proper context */
        $ctx = isset($_REQUEST['ctx']) && !empty($_REQUEST['ctx']) ? $_REQUEST['ctx'] : 'mgr';
        $this->modx->initialize($ctx);

        if ($ctx == 'mgr') {
            $ml = $this->modx->getOption('manager_language',null,'en');
            if ($ml != 'en') {
                $this->modx->lexicon->load($ml.':core:default');
                $this->modx->setOption('cultureKey',$ml);
            }
        }

        $corePath = $this->modx->getOption('marvin.core_path',null,$this->modx->getOption('core_path').'components/marvin/');
        require_once $corePath.'model/marvin/marvin.class.php';

        $this->marvin = new Marvin($this->modx);

        $this->modx->lexicon->load('marvin:default');

        require_once $corePath . 'libs/Luracast/Restler/AutoLoader.php';
        $corePath = $this->modx->getOption('marvin.core_path',null,$this->modx->getOption('core_path').'components/marvin/');

        require_once $corePath . 'api/poitypes.php';
        require_once $corePath . 'api/containers.php';
        require_once $corePath . 'api/pois.php';

        call_user_func(function ()
        {
            $loader = AutoLoader::instance();
            spl_autoload_register($loader);
            return $loader;
        });
    }

    public function run(){
        $r = new RestlerMODX(false, false, $this->modx);
        $r->modx =& $this->modx;

        $r->setSupportedFormats('JsonFormat','XmlFormat');

        $r->addAPIClass('Containers', '');
        $r->addAPIClass('POITypes', '');
        $r->addAPIClass('POIs', '');
        $r->handle();
    }
}

$api = new API();
$api->run();

