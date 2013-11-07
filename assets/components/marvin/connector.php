<?php
/**
 * Marvin Connector
 *
 * @package marvin
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('marvin.core_path',null,$modx->getOption('core_path').'components/marvin/');
require_once $corePath.'model/marvin/marvin.class.php';
$modx->marvin = new Marvin($modx);

$modx->lexicon->load('marvin:default');

/* handle request */
$path = $modx->getOption('processorsPath',$modx->marvin->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));
