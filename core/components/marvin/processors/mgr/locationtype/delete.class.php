<?php
require_once dirname(dirname(__FILE__)) . '/modobjectsoftremoveprocessor.php';
/**
 * Remove an Location type
 * 
 * @package marvin
 * @subpackage processors.locationtype
 */
class MarvinLocationTypeDeleteProcessor extends modObjectSoftRemoveProcessor {
    public $classKey = 'MarvinLocationType';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.locationtype';
    public $useDeletedOn = true;
    public $deletedOnField = 'deleted';
}
return 'MarvinLocationTypeDeleteProcessor';
