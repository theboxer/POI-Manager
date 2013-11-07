<?php
/**
 * Get list Items
 *
 * @package marvin
 * @subpackage processors
 */
class MarvinGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'MarvinItem';
    public $languageTopics = array('marvin:default');
    public $defaultSortField = 'position';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'marvin.items';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                    'name:LIKE' => '%'.$query.'%',
                    'OR:description:LIKE' => '%'.$query.'%',
                ));
        }
        return $c;
    }
}
return 'MarvinGetListProcessor';
