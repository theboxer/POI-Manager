<?php

class Containers {

    /**
     * @url GET containers
     * @url GET containers/{id}
     */
    function getContainers($id = null) {
        if ($id != null) {
            /** @var modResource $container */
            $container = $this->restler->modx->getObject('modResource', $id);

            if ($container && $container->class_key == 'MarvinCategory') {
                $response = $container->toArray();
                $response = array_merge($container->ExtendedFields->toArray(), $response);
                $msg = 'success';
            } else {
                $response = null;
                $msg = 'No object was found.';
            }
        } else {
            /** @var xPDOQuery $c */
            $c = $this->restler->modx->newQuery('modResource');
            $c->leftJoin('MarvinCategoryExtendedFields', 'ExtendedFields');
            $c->where(array('class_key' => 'MarvinCategory'));
            $c->select($this->restler->modx->getSelectColumns('modResource','modResource'));
            $c->select($this->restler->modx->getSelectColumns('MarvinCategoryExtendedFields','ExtendedFields', '', array('color')));

            $categories = $this->restler->modx->getCollection('modResource', $c);

            $response = array();
            $msg = 'No object was found.';

            /** @var MarvinCategory $category */
            foreach ($categories as $category) {
                $response[] = $category->toArray();
                $msg = 'success';
            }
        }

        return $this->createResponse($response, $msg);
    }

    public function createResponse($res, $msg) {
        $ret = array();
        $ret['msg'] = $msg;
        $ret['data'] = $res;

        return $ret;
    }
} 