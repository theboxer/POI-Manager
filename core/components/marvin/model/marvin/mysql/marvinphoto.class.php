<?php
/**
 * @package marvin
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/marvinphoto.class.php');
class MarvinPhoto_mysql extends MarvinPhoto {}
?>