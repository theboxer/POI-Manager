<?php
/**
 * Get list of Fields
 *
 * @package marvin
 * @subpackage processors.field
 */
class MarvinFieldGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'MarvinField';
    public $languageTopics = array('marvin:default');
    public $defaultSortField = 'position';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'marvin.field';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'name:LIKE' => '%'.$query.'%'
            ));
        }

        $locationType = $this->getProperty('location_type');
        if (!empty($locationType)) {
            $c->where(array('location_type' => $locationType));
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
return 'MarvinFieldGetListProcessor';
