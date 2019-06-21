<?php

$latteParams['bodyClasses'] .= ' with-sidebar';
$latteParams['bodyId'] = 'normal-page';

$latteParams['archive'] = new WpLatteArchiveEntity();

$latteParams['posts'] = WpLatte::createPostEntity($GLOBALS['wp_query']->posts);
$latteParams['post'] = new WpLattePostEntity($GLOBALS['wp_query']->queried_object, array( 'meta' => $GLOBALS['pageOptions']));

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();
