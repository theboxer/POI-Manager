<?php
/**
 * Loads system settings into build
 *
 * @package marvin
 * @subpackage build
 */
$settings = array();

$settings['marvin.default_zoom'] = $modx->newObject('modSystemSetting');
$settings['marvin.default_zoom']->set('key', 'marvin.default_zoom');
$settings['marvin.default_zoom']->fromArray(array(
    'value'     => '7',
    'xtype'     => 'textfield',
    'namespace' => 'marvin',
    'area'      => 'Map options'
));
$settings['marvin.default_lat'] = $modx->newObject('modSystemSetting');
$settings['marvin.default_lat']->set('key', 'marvin.default_lat');
$settings['marvin.default_lat']->fromArray(array(
    'value'     => '50.0775058',
    'xtype'     => 'textfield',
    'namespace' => 'marvin',
    'area'      => 'Map options'
));
$settings['marvin.default_lng'] = $modx->newObject('modSystemSetting');
$settings['marvin.default_lng']->set('key', 'marvin.default_lng');
$settings['marvin.default_lng']->fromArray(array(
    'value'     => '14.4296144',
    'xtype'     => 'textfield',
    'namespace' => 'marvin',
    'area'      => 'Map options'
));



return $settings;