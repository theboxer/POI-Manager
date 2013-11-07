<?php
/**
 * @package marvin
 */
$xpdo_meta_map['MarvinTag']= array (
  'package' => 'marvin',
  'version' => NULL,
  'table' => 'marvin_tags',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'tag' => '',
    'context' => 'web',
  ),
  'fieldMeta' => 
  array (
    'tag' => 
    array (
      'dbtype' => 'string',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'context' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => 'web',
      'index' => 'index',
    ),
  ),
  'indexes' => 
  array (
    'context' => 
    array (
      'alias' => 'context',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'context' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'composites' => 
  array (
    'TagLocations' => 
    array (
      'class' => 'MarvinLocationTag',
      'local' => 'id',
      'foreign' => 'location',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'Context' => 
    array (
      'class' => 'modContext',
      'local' => 'context',
      'foreign' => 'key',
      'owner' => 'foreign',
      'cardinality' => 'one',
    ),
  ),
);
