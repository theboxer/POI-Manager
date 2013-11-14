<?php
require_once dirname(__FILE__) . '/index.class.php';
/**
 * @package marvin
 */
class LocationManagerController extends MarvinBaseManagerController {
    public static function getDefaultController() { return 'location/create'; }
}