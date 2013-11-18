<?php
/**
 * Get list of Feedback
 *
 * @package marvin
 * @subpackage processors.feedback
 */
class MarvinFeedbackGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'MarvinFeedback';
    public $languageTopics = array('marvin:default');
    public $defaultSortField = 'created';
    public $defaultSortDirection = 'DESC';
    public $objectType = 'marvin.feedback';

    public function prepareQueryBeforeCount(xPDOQuery $c) {

        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'text:LIKE' => '%'.$query.'%',
                'OR:authors_name:LIKE' => '%'.$query.'%',
                'OR:authors_email:LIKE' => '%'.$query.'%'
            ));
        }

        $location = $this->getProperty('location');
        if (!empty($location)) {
            $c->where(array('location' => $location));
        }

        $c->where(array('deleted' => 0));

        return $c;
    }
}
return 'MarvinFeedbackGetListProcessor';
