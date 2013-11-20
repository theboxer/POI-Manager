<?php
/**
 * Update a Feedback
 * 
 * @package marvin
 * @subpackage processors.feedback
 */

class MarvinUpdateFeedbackProcessor extends modObjectUpdateProcessor {
    public $classKey = 'MarvinFeedback';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.feedback';

}
return 'MarvinUpdateFeedbackProcessor';
