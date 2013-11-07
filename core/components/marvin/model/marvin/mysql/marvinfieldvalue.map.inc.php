<?php
/**
 * @package marvin
 */
$xpdo_meta_map['MarvinFieldValue']= array (
  'package' => 'marvin',
  'version' => NULL,
  'table' => 'marvin_field_values',
  'extends' => 'MarvinSimpleObject',
  'fields' => 
  array (
    'value' => '',
    'location' => 0,
    'field' => 0,
  ),
  'fieldMeta' => 
  array (
    'value' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'location' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'field' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
  ),
  'aggregates' => 
  array (
    'Location' => 
    array (
      'class' => 'MarvinLocation',
      'local' => 'location',
      'foreign' => 'id',
      'owner' => 'foreign',
      'cardinality' => 'one',
    ),
    'Field' => 
    array (
      'class' => 'MarvinField',
      'local' => 'field',
      'foreign' => 'id',
      'owner' => 'foreign',
      'cardinality' => 'one',
    ),
  ),
);
