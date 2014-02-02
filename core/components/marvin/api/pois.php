<?php

class POIs {

    /**
     * @url GET pois/{id}
     */
    public function getPOI($id) {

        if (intval($id) <= 0) throw new RestException(400, "Id field is missing");

        /** @var MarvinLocation $poi */
        $poi = $this->restler->modx->getObject('MarvinLocation', $id);

        $response = array();

        if ($poi) {
            $response = $this->getPOIDetails($poi);
        }

        return $this->createResponse($response, 'success');
    }

    /**
     * @url GET pois
     */
    public function getPOIs() {
        $pois = $this->restler->modx->getCollection('MarvinLocation');

        $response = array();

        /** @var MarvinLocation $poi */
        foreach ($pois as $poi) {
            $response[] = $this->getPOIDetails($poi);
        }

        return $this->createResponse($response, 'success');
    }

    /**
     * @url GET containers/{id}/pois
     */
    public function getPOIsInContainer($id) {
        if (intval($id) <= 0) throw new RestException(400, "Id field is missing");

        $container = $this->restler->modx->getObject('modResource', $id);

        if (!$container) {
            throw new RestException(400, "Container not found");
        }

        $pois = $container->CategoryLocations;

        $response = array();

        /** @var MarvinLocationCategory $poi */
        foreach ($pois as $poi) {
            $response[] = $this->getPOIDetails($poi->Location);
        }

        return $this->createResponse($response, 'success');
    }

    /**
     * @url GET pois/{id}/comments
     * @url GET comments
     */
    public function getComments($id = 0) {
        $c = $this->restler->modx->newQuery('MarvinComment');

        if (intval($id) > 0) {
            $c->where(array('location' => $id));
        }

        $comments = $this->restler->modx->getCollection('MarvinComment', $c);

        $response = array();

        foreach ($comments as $comment) {
            $response[] = $this->getCommentDetails($comment);
        }

        return $this->createResponse($response, 'success');
    }

    /**
     * @url GET pois/{poi}/comments/{id}
     * @url GET comments/{id}
     */
    public function getComment($id, $poi = 0) {
        if (intval($id) <= 0) throw new RestException(400, "Id field is missing");

        $c = $this->restler->modx->newQuery('MarvinComment');
        $c->where(array('id' => $id));

        if (intval($poi) > 0) {
            $c->where(array('location' => $poi));
        }

        $comments = $this->restler->modx->getCollection('MarvinComment', $c);

        $response = array();

        foreach ($comments as $comment) {
            $response[] = $this->getCommentDetails($comment);
        }

        return $this->createResponse($response, 'success');
    }

    /**
     * @url GET pois/{id}/photos
     * @url GET photos
     */
    public function getPhotos($id = 0) {
        $c = $this->restler->modx->newQuery('MarvinPhoto');

        if (intval($id) > 0) {
            $c->where(array('location' => $id));
        }

        $photos = $this->restler->modx->getCollection('MarvinPhoto', $c);

        $response = array();

        foreach ($photos as $photo) {
            $response[] = $this->getPhotoDetails($photo);
        }

        return $this->createResponse($response, 'success');
    }

    /**
     * @url GET pois/{poi}/photos/{id}
     * @url GET photos/{id}
     */
    public function getPhoto($id, $poi = 0) {
        if (intval($id) <= 0) throw new RestException(400, "Id field is missing");

        $c = $this->restler->modx->newQuery('MarvinPhoto');
        $c->where(array('id' => $id));

        if (intval($poi) > 0) {
            $c->where(array('location' => $poi));
        }

        $photos = $this->restler->modx->getCollection('MarvinPhoto', $c);

        $response = array();

        foreach ($photos as $photo) {
            $response[] = $this->getPhotoDetails($photo);
        }

        return $this->createResponse($response, 'success');
    }

    /**
     * @url GET pois/{id}/feedbacks
     * @url GET feedbacks
     */
    public function getFeedbacks($id = 0) {
        $c = $this->restler->modx->newQuery('MarvinFeedback');

        if (intval($id) > 0) {
            $c->where(array('location' => $id));
        }

        $feedbacks = $this->restler->modx->getCollection('MarvinFeedback', $c);

        $response = array();

        foreach ($feedbacks as $feedback) {
            $response[] = $this->getFeedbackDetails($feedback);
        }

        return $this->createResponse($response, 'success');
    }

    /**
     * @url GET pois/{poi}/feedbacks/{id}
     * @url GET feedbacks/{id}
     */
    public function getFeedback($id, $poi = 0) {
        if (intval($id) <= 0) throw new RestException(400, "Id field is missing");

        $c = $this->restler->modx->newQuery('MarvinFeedback');
        $c->where(array('id' => $id));

        if (intval($poi) > 0) {
            $c->where(array('location' => $poi));
        }

        $feedbacks = $this->restler->modx->getCollection('MarvinFeedback', $c);

        $response = array();

        foreach ($feedbacks as $feedback) {
            $response[] = $this->getFeedbackDetails($feedback);
        }

        return $this->createResponse($response, 'success');
    }

    private function getFeedbackDetails(MarvinFeedback $feedback){
        $response = $feedback->toArray();

        return $response;
    }

    private function getCommentDetails(MarvinComment $comment){
        $response = $comment->toArray();

        return $response;
    }

    private function getPhotoDetails(MarvinPhoto $photo){
        $response = $photo->toArray();

        return $response;
    }

    private function getPOIDetails(MarvinLocation $poi){
        $response = $poi->toArray();

        $response['typeFields'] = array();

        $fields = $poi->Type->Fields;

        /** @var MarvinField $field */
        foreach ($fields as $field) {
            $response['typeFields'][$field->id] = array('name' => $field->name, 'value' => $this->getTypeFieldValue($field, $poi));
        }

        return $response;
    }

    private function getTypeFieldValue(MarvinField $field, MarvinLocation $poi){
        $values = $this->restler->modx->getCollection('MarvinFieldValue', array(
            'field' => $field->id,
            'location' => $poi->id
        ));
        $value = null;
        foreach ($values as $value) {
            $value = $value->value;
            break;
        }

        return $value;
    }

    public function createResponse($res, $msg) {
        $ret = array();
        $ret['msg'] = $msg;
        $ret['data'] = $res;

        return $ret;
    }
} 