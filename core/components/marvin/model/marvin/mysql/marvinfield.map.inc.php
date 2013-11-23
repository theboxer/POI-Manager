<?php
/**
 * @package marvin
 */
$xpdo_meta_map['MarvinField']= array (
  'package' => 'marvin',
  'version' => NULL,
  'table' => 'marvin_fields',
  'extends' => 'MarvinSimpleObject',
  'fields' => 
  array (
    'name' => NULL,
    'type' => 'textfield',
    'default' => '',
    'required' => 0,
    'read_only' => 0,
    'position' => 0,
    'location_type' => 0,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
    ),
    'type' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => 'textfield',
    ),
    'default' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'required' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'read_only' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'position' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'location_type' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
  ),
  'composites' => 
  array (
    'Locations' => 
    array (
      'class' => 'MarvinLocation',
      'local' => 'id',
      'foreign' => 'type',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'Values' => 
    array (
      'class' => 'MarvinFieldValue',
      'local' => 'id',
      'foreign' => 'field',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'LocationType' => 
    array (
      'class' => 'MarvinLocationType',
      'local' => 'location_type',
      'foreign' => 'id',
      'owner' => 'foreign',
      'cardinality' => 'one',
    ),
  ),
);
