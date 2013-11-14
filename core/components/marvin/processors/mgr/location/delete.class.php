<?php
require_once dirname(dirname(__FILE__)) . '/modobjectsoftremoveprocessor.php';
/**
 * Remove an Item.
 * 
 * @package marvin
 * @subpackage processors.location
 */
class MarvinLocationDeleteProcessor extends modObjectSoftRemoveProcessor {
    public $classKey = 'MarvinLocation';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.locations';
    public $useDeletedOn = true;
    public $deletedOnField = 'deleted';
}
return 'MarvinLocationDeleteProcessor';
