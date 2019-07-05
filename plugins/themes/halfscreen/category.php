<?php

$latteParams['bodyClasses'] .= ' with-sidebar';
$latteParams['bodyId'] = 'normal-page';

$latteParams['category'] = new WpLatteCategoryEntity($GLOBALS['wp_query']->queried_object);
$latteParams['post'] = new WpLattePostEntity($GLOBALS['wp_query']->queried_object, array( 'meta' => $GLOBALS['pageOptions']));

$latteParams['posts'] = WpLatte::createPostEntity($GLOBALS['wp_query']->posts);

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();
