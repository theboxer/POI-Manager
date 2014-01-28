<?php

class POITypes {

    /**
     * @url GET poitypes/{id}
     */
    function type($id) {
        if (intval($id) <= 0) throw new RestException(400, "Id field is missing");

        /** @var modResource $container */
        $type = $this->restler->modx->getObject('MarvinLocationType', $id);

        $response = array();

        if ($type) {
            $response = $type->toArray();
        }

        return $this->createResponse($response, 'success');
    }

    /**
     * @url GET poitypes/
     */
    function types() {
        /** @var xPDOQuery $c */
        $c = $this->restler->modx->newQuery('MarvinLocationType');

        $types = $this->restler->modx->getCollection('MarvinLocationType', $c);

        $response = array();

        /** @var MarvinLocationType $type */
        foreach ($types as $type) {
            $response[] = $type->toArray();
        }

        return $this->createResponse($response, 'success');
    }

    /**
     * @url GET poitypes/{type}/fields/{id}
     * @url GET fields/{id}
     * @url GET fields/
     */
    function field($id, $type = null) {
        if (intval($id) <= 0) throw new RestException(400, "Id field is missing");

        /** @var xPDOQuery $c */
        $c = $this->restler->modx->newQuery('MarvinField');

        if ($type) {
            $c->where(array(
                'location_type' => $type
            ));
        }

        $c->where(array('id' => $id));

        $fields = $this->restler->modx->getCollection('MarvinField', $c);

        $response = array();

        /** @var MarvinField $field */
        foreach ($fields as $field) {
            $response[] = $field->toArray();
        }

        return $this->createResponse($response, 'success');
    }

    /**
     * @url GET poitypes/{type}/fields/
     */
    function fields($type) {
        if (intval($type) <= 0) throw new RestException(400, "Type field is missing");

        /** @var xPDOQuery $c */
        $c = $this->restler->modx->newQuery('MarvinField');

        $c->where(array(
            'location_type' => $type
        ));

        $fields = $this->restler->modx->getCollection('MarvinField', $c);

        $response = array();

        /** @var MarvinField $field */
        foreach ($fields as $field) {
            $response[] = $field->toArray();
        }

        return $this->createResponse($response, 'success');
    }

    public function createResponse($res, $msg) {
        $ret = array();
        $ret['msg'] = $msg;
        $ret['data'] = $res;

        return $ret;
    }
} 