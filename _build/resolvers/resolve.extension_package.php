<?php

if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            /** @var modX $modx */
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('marvin.core_path', null, '[[++core_path]]components/marvin/model/');

        if ($modx instanceof modX) {
                $modx->addExtensionPackage('marvin',$modelPath);
            }
            break;
        case xPDOTransport::ACTION_UNINSTALL:
            $modx =& $object->xpdo;
            if ($modx instanceof modX) {
                $modx->removeExtensionPackage('marvin');
            }
            break;
    }
}
return true;