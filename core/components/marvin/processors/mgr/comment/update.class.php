<?php
/**
 * Update a Comment
 * 
 * @package marvin
 * @subpackage processors.comment
 */

class MarvinUpdateCommentProcessor extends modObjectUpdateProcessor {
    public $classKey = 'MarvinComment';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.comment';

    public function beforeSet(){
        $this->setProperty('updated', time());
        $this->setProperty('updated_by', $this->modx->user->id);

        return parent::beforeSet();
    }

}
return 'MarvinUpdateCommentProcessor';
