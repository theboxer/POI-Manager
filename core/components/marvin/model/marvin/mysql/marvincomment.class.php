<?php
/**
 * @package marvin
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/marvincomment.class.php');
class MarvinComment_mysql extends MarvinComment {}
?>