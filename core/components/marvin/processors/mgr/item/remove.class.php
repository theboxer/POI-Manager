<?php
/**
 * Remove an Item.
 * 
 * @package marvin
 * @subpackage processors
 */
class MarvinRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'MarvinItem';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.items';
}
return 'MarvinRemoveProcessor';
