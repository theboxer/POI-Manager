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
     */
    public function getComments($id) {
        if (intval($id) <= 0) throw new RestException(400, "Id field is missing");

        $comments = $this->restler->modx->getCollection('MarvinComment', array('location' => $id));

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

    private function getCommentDetails(MarvinComment $comment){
        $response = $comment->toArray();

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