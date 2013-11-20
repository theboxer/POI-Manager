<?php
require_once dirname(dirname(__FILE__)) . '/modobjectsoftremoveprocessor.php';
/**
 * Remove an Comment.
 * 
 * @package marvin
 * @subpackage processors.comment
 */
class MarvinCommentDeleteProcessor extends modObjectSoftRemoveProcessor {
    public $classKey = 'MarvinComment';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.comment';
    public $useDeletedOn = true;
    public $deletedOnField = 'deleted';
}
return 'MarvinCommentDeleteProcessor';
