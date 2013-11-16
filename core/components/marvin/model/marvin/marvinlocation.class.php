<?php
require_once 'marvinsimpleobject.class.php';
/**
 * @property string $name
 * @property string $alias
 * @property float $lat
 * @property float $lng
 * @property int $zoom
 * @property string $state
 * @property int $type
 * @property MarvinLocationType $Type
 * @property MarvinFeedback $Feedback
 * @property MarvinComment $Comments
 * @property MarvinPhoto $Photos
 * @property MarvinLocationTag $LocationTags
 * @property MarvinFieldValue $FieldValues
 * @property MarvinLocationCategory $LocationCategories
 *
 * @package marvin
 */
class MarvinLocation extends MarvinSimpleObject {

    /**
     * Add categories to Location
     *
     * @param array $categories
     */
    public function addCategories($categories) {
        $this->removeCategories();

        foreach($categories as $category) {
            /** @var MarvinCategory $category */
            $category = $this->xpdo->getObject('MarvinCategory', $category);
            if ($category) {
                /** @var MarvinLocationCategory $locationCategory */
                $locationCategory = $this->xpdo->newObject('MarvinLocationCategory');
                $locationCategory->addOne($category, 'Category');
                $locationCategory->addOne($this, 'Location');
                $locationCategory->save();
            }
        }
    }

    /**
     * Remove all categories from Location
     */
    public function removeCategories() {
        $categories = $this->LocationCategories;

        /** @var MarvinLocationCategory $category */
        foreach ($categories as $category) {
            $category->remove();
        }
    }
}
