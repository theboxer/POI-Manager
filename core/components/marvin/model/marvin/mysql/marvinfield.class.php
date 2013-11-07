<?php
/**
 * @package marvin
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/marvinfield.class.php');
class MarvinField_mysql extends MarvinField {}
?>