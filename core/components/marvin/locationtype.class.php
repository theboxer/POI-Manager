<?php
require_once dirname(__FILE__) . '/index.class.php';
/**
 * @package marvin
 */
class LocationTypeManagerController extends MarvinBaseManagerController {
    public static function getDefaultController() { return 'locationtype/list'; }
}