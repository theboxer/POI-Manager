<?php
/**
 * @package marvin
 */
$xpdo_meta_map['MarvinSimpleObject']= array (
  'package' => 'marvin',
  'version' => NULL,
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'created' => 0,
    'updated' => 0,
    'updated_by' => 0,
    'deleted' => NULL,
  ),
  'fieldMeta' => 
  array (
    'created' => 
    array (
      'dbtype' => 'int',
      'precision' => '20',
      'phptype' => 'timestamp',
      'null' => false,
      'default' => 0,
    ),
    'updated' => 
    array (
      'dbtype' => 'int',
      'precision' => '20',
      'phptype' => 'timestamp',
      'null' => false,
      'default' => 0,
    ),
    'updated_by' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'deleted' => 
    array (
      'dbtype' => 'int',
      'precision' => '20',
      'phptype' => 'timestamp',
      'null' => false,
    ),
  ),
  'aggregates' => 
  array (
    'UpdatedBy' => 
    array (
      'class' => 'modUser',
      'local' => 'updated_by',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
