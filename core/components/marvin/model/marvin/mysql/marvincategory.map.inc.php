<?php
/**
 * @package marvin
 */
$xpdo_meta_map['MarvinCategory']= array (
  'package' => 'marvin',
  'version' => NULL,
  'extends' => 'modResource',
  'fields' => 
  array (
  ),
  'fieldMeta' => 
  array (
  ),
  'composites' => 
  array (
    'CategoryLocations' => 
    array (
      'class' => 'MarvinLocationCategory',
      'local' => 'id',
      'foreign' => 'category',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'ExtendedFields' => 
    array (
      'class' => 'MarvinCategoryExtendedFields',
      'local' => 'id',
      'foreign' => 'category',
      'cardinality' => 'one',
      'owner' => 'local',
    ),
  ),
);
