<?php
/**
 * @package marvin
 */
$xpdo_meta_map['MarvinLocation']= array (
  'package' => 'marvin',
  'version' => NULL,
  'table' => 'marvin_locations',
  'extends' => 'MarvinSimpleObject',
  'fields' => 
  array (
    'name' => '',
    'alias' => '',
    'lat' => NULL,
    'lng' => NULL,
    'zoom' => 7,
    'state' => '',
    'type' => NULL,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'alias' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'lat' => 
    array (
      'dbtype' => 'float',
      'precision' => '20,15',
      'phptype' => 'float',
      'null' => false,
    ),
    'lng' => 
    array (
      'dbtype' => 'float',
      'precision' => '20,15',
      'phptype' => 'float',
      'null' => false,
    ),
    'zoom' => 
    array (
      'dbtype' => 'int',
      'precision' => '5',
      'phptype' => 'integer',
      'null' => false,
      'default' => 7,
    ),
    'state' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'type' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
  'composites' => 
  array (
    'Feedback' => 
    array (
      'class' => 'MarvinFeedback',
      'local' => 'id',
      'foreign' => 'location',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'Comments' => 
    array (
      'class' => 'MarvinComment',
      'local' => 'id',
      'foreign' => 'location',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'Photos' => 
    array (
      'class' => 'MarvinPhoto',
      'local' => 'id',
      'foreign' => 'location',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'LocationTags' => 
    array (
      'class' => 'MarvinLocationTag',
      'local' => 'id',
      'foreign' => 'tag',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'FieldValues' => 
    array (
      'class' => 'MarvinFieldValue',
      'local' => 'id',
      'foreign' => 'location',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'LocationCategories' => 
    array (
      'class' => 'MarvinLocationCategory',
      'local' => 'id',
      'foreign' => 'location',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'Type' => 
    array (
      'class' => 'MarvinLocationType',
      'local' => 'type',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
