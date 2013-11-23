<?php
require_once dirname(dirname(__FILE__)) . '/modobjectsoftremoveprocessor.php';
/**
 * Remove a Field.
 * 
 * @package marvin
 * @subpackage processors.field
 */
class MarvinFieldDeleteProcessor extends modObjectSoftRemoveProcessor {
    public $classKey = 'MarvinField';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.field';
    public $useDeletedOn = true;
    public $deletedOnField = 'deleted';
}
return 'MarvinFieldDeleteProcessor';
