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

    public function beforeSet(){
        $this->setProperty('updated', time());
        $this->setProperty('updated_by', $this->modx->user->id);

        return parent::beforeSet();
    }

}
return 'MarvinUpdateFeedbackProcessor';
