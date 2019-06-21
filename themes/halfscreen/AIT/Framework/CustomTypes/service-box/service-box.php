<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitServicesBoxPostType()
{
	register_post_type( 'ait-service-box',
		array(
			'labels' => array(
				'name'			=> __('Service boxes' , THEME_CODE_NAME),
				'singular_name' => __('Service box' , THEME_CODE_NAME),
				'add_new'		=> __('Add new', THEME_CODE_NAME),
				'add_new_item'	=> __('Add new box', THEME_CODE_NAME),
				'edit_item'		=> __('Edit box', THEME_CODE_NAME),
				'new_item'		=> __('New box', THEME_CODE_NAME),
				'not_found'		=> __('No boxes found', THEME_CODE_NAME),
				'not_found_in_trash' => __('No boxes found in Trash', THEME_CODE_NAME),
				'menu_name'		=> __('Service-Boxes'),
			),
			'description' => __('Manipulating with service boxes'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/service-box/service-box.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['service-box'],
		)
	);
	aitServiceBoxTaxonomies();
}


function aitServiceBoxTaxonomies()
{

	register_taxonomy( 'ait-service-box-category', array( 'ait-service-box' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Service Box Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Category', 'taxonomy singular name' ),
			'search_items'	=> __( 'Search Category' ),
			'all_items'		=> __( 'All Gategories' ),
			'parent_item'	=> __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'		=> __( 'Edit Category' ),
			'update_item'	=> __( 'Update Gategory' ),
			'add_new_item'	=> __( 'Add New Category' ),
			'new_item_name' => __( 'New Category Name' ),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'ait-service-box-category' ),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Service-Boxes', 'ait-service-box-category' )){
		wp_insert_term( 'Uncategorized Service-Boxes', 'ait-service-box-category' );
	}
}
add_action( 'init', 'aitServicesBoxPostType');



function aitServiceBoxFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-service-box', 'side' );
	add_meta_box('postimagediv', __('Icon for box'), 'post_thumbnail_meta_box', 'ait-service-box', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitServiceBoxFeaturedImageMetabox');


$serviceBoxOptions = new WPAlchemy_MetaBox(array
(
	'id' => '_ait-service-box',
	'title' => __('Options for service box'),
	'types' => array('ait-service-box'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));


function aitServiceBoxChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title' ),
		'service_box_text'			=> __( 'Text' ),
		'service_box_link'			=> __( 'Link' ),
		'thumbnail'		=> __( 'Image' ),
		'menu_order'	=> __( 'Order' ),
		'category'      => __( 'Category' ),
	);

	return $cols;
}
add_filter( "manage_ait-service-box_posts_columns", "aitServiceBoxChangeColumns");



function aitServiceBoxCustomColumns($column, $post_id)
{
	global $serviceBoxOptions;

	$options = $serviceBoxOptions->the_meta();

	switch ($column){
		case "service_box_text":

			if(isset($options['boxText'])){
				echo "<p>".$options['boxText']."</p>";
			}
			unset($options);
			break;

		case "service_box_link":

			if(isset($options['boxLink'])){
				echo '<a href="' . htmlspecialchars($options['boxLink']) . '">' . htmlspecialchars($options['boxLink']) . "</a>";
			}
			unset($options);
			break;
	}
}
add_action( "manage_posts_custom_column", "aitServiceBoxCustomColumns", 10, 2);

function aitServiceBoxSortableColumns()
{
	return array(
		'title' => 'title',
		'menu_order' => 'order',
		'category' => 'category',
	);
}

add_filter( "manage_edit-ait-service-box_sortable_columns", "aitServiceBoxSortableColumns" );