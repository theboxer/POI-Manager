<?php
/**
 * @package marvin
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/marvinlocation.class.php');
class MarvinLocation_mysql extends MarvinLocation {}
?>