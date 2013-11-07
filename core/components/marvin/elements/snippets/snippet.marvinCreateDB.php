<?php
$marvin = $modx->getService('marvin','Marvin',$modx->getOption('marvin.core_path',null,$modx->getOption('core_path').'components/marvin/').'model/marvin/',$scriptProperties);
if (!($marvin instanceof Marvin)) return '';


$m = $modx->getManager();
$m->createObjectContainer('MarvinCategoryExtendedFields');
$m->createObjectContainer('MarvinLocation');
$m->createObjectContainer('MarvinFeedback');
$m->createObjectContainer('MarvinComment');
$m->createObjectContainer('MarvinPhoto');
$m->createObjectContainer('MarvinTag');
$m->createObjectContainer('MarvinLocationType');
$m->createObjectContainer('MarvinField');
$m->createObjectContainer('MarvinFieldValue');
$m->createObjectContainer('MarvinLocationTag');
$m->createObjectContainer('MarvinLocationCategory');

return 'Table created.';
