<?php
/**
 * Resolve creating db tables
 *
 * @package marvin
 * @subpackage build
 */
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('marvin.core_path',null,$modx->getOption('core_path').'components/marvin/').'model/';
            $modx->addPackage('marvin',$modelPath);

            $manager = $modx->getManager();

            $manager->createObjectContainer('MarvinItem');

            break;
        case xPDOTransport::ACTION_UPGRADE:
            break;
    }
}
return true;
