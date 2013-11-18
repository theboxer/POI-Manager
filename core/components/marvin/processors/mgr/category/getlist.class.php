<?php
/**
 * Get list of Categories
 *
 * @package marvin
 * @subpackage processors.category
 */
class MarvinCategoryGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'modResource';
    public $languageTopics = array('marvin:default');
    public $defaultSortField = 'pagetitle';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'marvin.category';

    public function prepareQueryBeforeCount(xPDOQuery $c) {

        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'id' => $query,
                'OR:pagetitle:LIKE' => '%'.$query.'%',
            ));
        }

        $c->where(array(
            'class_key' => 'MarvinCategory',
            'deleted' => 0
        ));

        return $c;
    }
}
return 'MarvinCategoryGetListProcessor';
