<?php

/**
 * AIT Theme Framework
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 * Developer: Cifro Nix (http://about.me/Cifro)
 */



function aitHomeBoxPostType()
{
	register_post_type('ait-home-box',
		array(
			'labels' => array(
				'name'			=> __('Home boxes' , THEME_CODE_NAME),
				'singular_name' => __('Home box' , THEME_CODE_NAME),
				'add_new'		=> __('Add new', THEME_CODE_NAME),
				'add_new_item'	=> __('Add new box', THEME_CODE_NAME),
				'edit_item'		=> __('Edit box', THEME_CODE_NAME),
				'new_item'		=> __('New box', THEME_CODE_NAME),
				'not_found'		=> __('No boxes found', THEME_CODE_NAME),
				'not_found_in_trash' => __('No boxes found in Trash', THEME_CODE_NAME),
				'menu_name'		=> __('Home Boxes'),
			),
			'description' => __('Manipulating with home boxes on homepage'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/home-box/home-box.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['home-box'],
		)
	);
}
add_action( 'init', 'aitHomeBoxPostType' );

function aitFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-home-box', 'side' );
	add_meta_box('postimagediv', __('Image'), 'post_thumbnail_meta_box', 'ait-home-box', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitFeaturedImageMetabox');


$homeBoxOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-home-box',
	'title' => __('Options for featured box'),
	'types' => array('ait-home-box'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));



function aitHomeBoxChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title', THEME_CODE_NAME ),
		'thumbnail'		=> __( 'Image', THEME_CODE_NAME ),
		'isBigBox'		=> __( 'Large box', THEME_CODE_NAME ),
		'menu_order'	=> __( 'Order', THEME_CODE_NAME ),
		'boxLink'		=> __( 'Link', THEME_CODE_NAME ),
	);

	return $cols;
}
add_filter( "manage_ait-home-box_posts_columns", "aitHomeBoxChangeColumns" );



function aitHomeBoxCustomColumns($column, $postId)
{
	global $homeBoxOptions;

	switch($column){
		case "isBigBox":
			$options = $homeBoxOptions->the_meta();

			if(isset($options['isBigBox'])){
				echo "<strong>" . __( "Yes" ) . "</strong>";
			}else{
				echo __( "No" );
			}
			break;

		case "boxLink":
			$options = $homeBoxOptions->the_meta();

			if(isset($options['boxLink'])){
				echo '<a href="' . htmlspecialchars($options['boxLink']) . '">' . htmlspecialchars($options['boxLink']) . "</a>";
			}
			break;
	}
}
add_action( "manage_posts_custom_column", "aitHomeBoxCustomColumns", 10, 2);