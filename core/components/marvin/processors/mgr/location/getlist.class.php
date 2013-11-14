<?php
/**
 * Get list of Locations
 *
 * @package marvin
 * @subpackage processors.location
 */
class MarvinLocationGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'MarvinLocation';
    public $languageTopics = array('marvin:default');
    public $defaultSortField = 'created';
    public $defaultSortDirection = 'DESC';
    public $objectType = 'marvin.locations';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $category = $this->getProperty('category');
        if (!empty($category)) {
            $c->rightJoin('MarvinLocationCategory', 'Category', 'Category.location = MarvinLocation.id AND Category.category =' . $category);
        }

        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                    'name:LIKE' => '%'.$query.'%',
                ));
        }

        $c->where(array(
            'deleted' => 0
        ));
        
        return $c;
    }
}
return 'MarvinLocationGetListProcessor';
