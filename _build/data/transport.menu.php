<?php
/**
 * Adds modActions and modMenus into package
 *
 * @package marvin
 * @subpackage build
 */
$action= $modx->newObject('modAction');
$action->fromArray(array(
    'id' => 1,
    'namespace' => 'marvin',
    'parent' => 0,
    'controller' => 'locationtype',
    'haslayout' => true,
    'lang_topics' => 'marvin:default',
    'assets' => '',
),'',true,true);

$menu= $modx->newObject('modMenu');
$menu->fromArray(array(
    'text' => 'marvin.locationtype.menu',
    'parent' => 'components',
    'description' => 'marvin.locationtype.menu_desc',
    'icon' => '',
    'menuindex' => 0,
    'params' => '',
    'handler' => '',
),'',true,true);
$menu->addOne($action);
unset($menus);

return $menu;