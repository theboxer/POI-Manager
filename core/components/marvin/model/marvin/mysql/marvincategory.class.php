<?php
/**
 * @package marvin
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/marvincategory.class.php');
class MarvinCategory_mysql extends MarvinCategory {}
?>