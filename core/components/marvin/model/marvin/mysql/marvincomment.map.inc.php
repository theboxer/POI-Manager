<?php
/**
 * @package marvin
 */
$xpdo_meta_map['MarvinComment']= array (
  'package' => 'marvin',
  'version' => NULL,
  'table' => 'marvin_comments',
  'extends' => 'MarvinSimpleObject',
  'fields' => 
  array (
    'text' => '',
    'authors_name' => '',
    'authors_email' => '',
    'state' => '',
    'location' => 0,
  ),
  'fieldMeta' => 
  array (
    'text' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'authors_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'authors_email' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'state' => 
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
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
