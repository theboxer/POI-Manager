<?php
/**
 * Create a Field
 * 
 * @package marvin
 * @subpackage processors.field
 */
class MarvinFieldCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'MarvinField';
    public $languageTopics = array('marvin:default');
    public $objectType = 'marvin.field';
    /** @var MarvinField $object */
    public $object;

    public function beforeSet() {
        $locationType = $this->getProperty('location_type', null);

        if (empty($locationType)) {
            return $this->modx->lexicon('marvin.field.err_ns_location_type');
        }

        $position = $this->getProperty('position', null);
        if (empty($position)) {
            $stmt = $this->modx->query("SELECT MAX(position) as max_position, count(id) as id FROM {$this->modx->getTableName('MarvinField')} WHERE deleted=0 AND location_type={$locationType}");
            $o = $stmt->fetch(PDO::FETCH_OBJ);
            $stmt->closeCursor();

            if ($o->id > 0) {
                $this->setProperty('position', $o->max_position + 1);
            } else {
                $this->setProperty('position', 0);
            }
        }

        $this->setProperty('created', time());

        return parent::beforeSet();
    }
}
return 'MarvinFieldCreateProcessor';
