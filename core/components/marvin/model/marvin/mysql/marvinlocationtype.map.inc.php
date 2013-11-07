<?php
/**
 * @package marvin
 */
$xpdo_meta_map['MarvinLocationType']= array (
  'package' => 'marvin',
  'version' => NULL,
  'table' => 'marvin_location_types',
  'extends' => 'MarvinSimpleObject',
  'fields' => 
  array (
    'name' => NULL,
    'description' => '',
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'string',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
    ),
    'description' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
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
    'Fields' => 
    array (
      'class' => 'MarvinField',
      'local' => 'id',
      'foreign' => 'location_type',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
