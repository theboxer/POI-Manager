<?php
namespace Luracast\Restler;

require_once dirname(__FILE__) . '/Restler.php';

class RestlerMODX extends Restler{
    public $modx;

    public function __construct($productionMode = false, $refreshCache = false, $modx){
        $this->modx = $modx;

        return parent::__construct($productionMode, $refreshCache);
    }
} 