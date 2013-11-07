<?php
/**
 * @package marvin
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/marvinfeedback.class.php');
class MarvinFeedback_mysql extends MarvinFeedback {}
?>