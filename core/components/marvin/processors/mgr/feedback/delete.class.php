<?php
require_once dirname(dirname(__FILE__)) . '/modobjectsoftremoveprocessor.php';
/**
 * Remove an Feedback.
 * 
 * @package marvin
 * @subpackage processors.feedback
 */
class MarvinFeedbackDeleteProcessor extends modObjectSoftRemoveProcessor {
    public $classKey = 'MarvinFeedback';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.feedback';
    public $useDeletedOn = true;
    public $deletedOnField = 'deleted';
}
return 'MarvinFeedbackDeleteProcessor';
