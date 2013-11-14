<?php
/**
 * @package marvin
 * @subpackage processors
 */
class MarvinLocationGetProcessor extends modObjectGetProcessor
{
    public $classKey = 'MarvinLocation';
    public $languageTopics = array('marvin:default');

    public function beforeOutput() {



        $categories = $this->object->getMany('LocationCategories');
        $categoryOutput = array();
        foreach($categories as $category){
            $categoryOutput[] = $category->category;
        }

        $this->object->set('fake_categories', implode(',', $categoryOutput));

//        $createdBy = $this->modx->getObject('modUser', $this->object->created_by);
//        if ($createdBy) {
//            $createdByProfile = $createdBy->getOne('Profile');
//            $this->object->set('created_by_name', $createdByProfile->fullname);
//        }
//        $editedBy = $this->modx->getObject('modUser', $this->object->edited_by);
//        if ($editedBy) {
//            $editedByProfile = $editedBy->getOne('Profile');
//            $this->object->set('edited_by_name', $editedByProfile->fullname);
//        }
    }
}

return 'MarvinLocationGetProcessor';
