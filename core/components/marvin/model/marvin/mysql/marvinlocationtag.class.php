<?php
/**
 * @package marvin
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/marvinlocationtag.class.php');
class MarvinLocationTag_mysql extends MarvinLocationTag {}
?>