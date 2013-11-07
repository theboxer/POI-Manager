<?php
/**
 * @package marvin
 */
$xpdo_meta_map['MarvinLocationCategory']= array (
  'package' => 'marvin',
  'version' => NULL,
  'table' => 'marvin_locations_categories',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'location' => NULL,
    'category' => NULL,
  ),
  'fieldMeta' => 
  array (
    'location' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
    ),
    'category' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
    ),
  ),
  'indexes' => 
  array (
    'PRIMARY' => 
    array (
      'alias' => 'PRIMARY',
      'primary' => true,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'location' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'category' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
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
    'Category' => 
    array (
      'class' => 'MarvinCategory',
      'local' => 'category',
      'foreign' => 'id',
      'owner' => 'foreign',
      'cardinality' => 'one',
    ),
  ),
);
