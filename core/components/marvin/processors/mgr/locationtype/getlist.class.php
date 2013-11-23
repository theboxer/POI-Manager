<?php
/**
 * Get list Location Types
 *
 * @package marvin
 * @subpackage processors.locationtype
 */
class MarvinLocationTypeGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'MarvinLocationType';
    public $languageTopics = array('marvin:default');
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'marvin.locationtype';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                    'name:LIKE' => '%'.$query.'%',
                    'OR:description:LIKE' => '%'.$query.'%',
                ));
        }

        $c->where(array('deleted' => 0));

        return $c;
    }

    public function prepareRow(xPDOObject $object){
        $objectArray = $object->toArray();

        /** @var modUser $updatedBy */
        $updatedBy = $object->getOne('UpdatedBy');
        if ($updatedBy) {
            $objectArray['updated_by_name'] = $updatedBy->Profile->fullname;
        }

        return $objectArray;
    }
}
return 'MarvinLocationTypeGetListProcessor';
