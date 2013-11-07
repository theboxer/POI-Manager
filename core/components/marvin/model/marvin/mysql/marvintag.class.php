<?php
/**
 * @package marvin
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/marvintag.class.php');
class MarvinTag_mysql extends MarvinTag {}
?>