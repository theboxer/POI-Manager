<?php
/**
 * @package marvin
 */
$xpdo_meta_map['MarvinLocationTag']= array (
  'package' => 'marvin',
  'version' => NULL,
  'table' => 'marvin_locations_tags',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'location' => NULL,
    'tag' => NULL,
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
    'tag' => 
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
        'tag' => 
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
    'Tag' => 
    array (
      'class' => 'MarvinTag',
      'local' => 'tag',
      'foreign' => 'id',
      'owner' => 'foreign',
      'cardinality' => 'one',
    ),
  ),
);
