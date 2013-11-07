<?php
/**
 * Add snippets to build
 * 
 * @package marvin
 * @subpackage build
 */
$snippets = array();

$snippets[0]= $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => 'Marvin',
    'description' => 'Displays Items.',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.marvin.php'),
),'',true,true);
$properties = include $sources['build'].'properties/properties.marvin.php';
$snippets[0]->setProperties($properties);
unset($properties);

return $snippets;
