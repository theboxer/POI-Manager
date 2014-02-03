<?php
/**
 * Resolve creating custom db tables during install.
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
            $modx->loadClass('MarvinSimpleObject');

            $manager = $modx->getManager();

            $manager->createObjectContainer('MarvinCategoryExtendedFields');
            $manager->createObjectContainer('MarvinLocation');
            $manager->createObjectContainer('MarvinFeedback');
            $manager->createObjectContainer('MarvinComment');
            $manager->createObjectContainer('MarvinPhoto');
            $manager->createObjectContainer('MarvinTag');
            $manager->createObjectContainer('MarvinLocationType');
            $manager->createObjectContainer('MarvinField');
            $manager->createObjectContainer('MarvinFieldValue');
            $manager->createObjectContainer('MarvinLocationTag');
            $manager->createObjectContainer('MarvinLocationCategory');

            break;
        case xPDOTransport::ACTION_UPGRADE:
            break;
    }
}
return true;