<?php
/**
 * @package marvin
 */
$xpdo_meta_map['MarvinCategoryExtendedFields']= array (
  'package' => 'marvin',
  'version' => NULL,
  'table' => 'marvin_category_extended_fields',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'icon' => '',
    'color' => '',
    'category' => NULL,
  ),
  'fieldMeta' => 
  array (
    'icon' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'color' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'category' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
  'aggregates' => 
  array (
    'Category' => 
    array (
      'class' => 'MarvinCategory',
      'local' => 'category',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
