<?php
/**
 * @package marvin
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/marvinfieldvalue.class.php');
class MarvinFieldValue_mysql extends MarvinFieldValue {}
?>