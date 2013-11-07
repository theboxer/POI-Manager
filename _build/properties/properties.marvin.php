<?php
/**
 * Properties for the Marvin snippet.
 *
 * @package marvin
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'tpl',
        'desc' => 'prop_marvin.tpl_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'Item',
        'lexicon' => 'marvin:properties',
    ),
    array(
        'name' => 'sortBy',
        'desc' => 'prop_marvin.sortby_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'name',
        'lexicon' => 'marvin:properties',
    ),
    array(
        'name' => 'sortDir',
        'desc' => 'prop_marvin.sortdir_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'ASC',
        'lexicon' => 'marvin:properties',
    ),
    array(
        'name' => 'limit',
        'desc' => 'prop_marvin.limit_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 5,
        'lexicon' => 'marvin:properties',
    ),
    array(
        'name' => 'outputSeparator',
        'desc' => 'prop_marvin.outputseparator_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'marvin:properties',
    ),
    array(
        'name' => 'toPlaceholder',
        'desc' => 'prop_marvin.toplaceholder_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => true,
        'lexicon' => 'marvin:properties',
    ),
/*
    array(
        'name' => '',
        'desc' => 'prop_marvin.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'marvin:properties',
    ),
    */
);

return $properties;
