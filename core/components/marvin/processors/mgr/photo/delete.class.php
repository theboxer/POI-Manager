<?php
require_once dirname(dirname(__FILE__)) . '/modobjectsoftremoveprocessor.php';
/**
 * Remove a Photo.
 * 
 * @package marvin
 * @subpackage processors.photo
 */
class MarvinPhotoDeleteProcessor extends modObjectSoftRemoveProcessor {
    public $classKey = 'MarvinPhoto';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.photo';
    public $useDeletedOn = true;
    public $deletedOnField = 'deleted';
}
return 'MarvinPhotoDeleteProcessor';
