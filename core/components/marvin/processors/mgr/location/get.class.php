<?php
/**
 * @package marvin
 * @subpackage processors
 */
class MarvinLocationGetProcessor extends modObjectGetProcessor
{
    public $classKey = 'MarvinLocation';
    public $languageTopics = array('marvin:default');
    /** @var MarvinLocation $object */
    public $object;

    public function beforeOutput() {



        $categories = $this->object->getMany('LocationCategories');
        $categoryOutput = array();
        foreach($categories as $category){
            $categoryOutput[] = $category->category;
        }

        $this->object->set('fake_categories', implode(',', $categoryOutput));

        /** @var modUser $updatedBy */
        $updatedBy = $this->object->getOne('UpdatedBy');
        if ($updatedBy) {
            $this->object->set('updated_by_name', $updatedBy->Profile->fullname);
        }
    }
}

return 'MarvinLocationGetProcessor';
