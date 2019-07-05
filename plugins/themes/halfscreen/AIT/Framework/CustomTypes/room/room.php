<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitRoomPostType()
{
	register_post_type( 'ait-room',
		array(
			'labels' => array(
				'name'			=> __('Rooms' , THEME_CODE_NAME),
				'singular_name' => __('Room' , THEME_CODE_NAME),
				'add_new'		=> __('Add new', THEME_CODE_NAME),
				'add_new_item'	=> __('Add new room', THEME_CODE_NAME),
				'edit_item'		=> __('Edit room', THEME_CODE_NAME),
				'new_item'		=> __('New room', THEME_CODE_NAME),
				'not_found'		=> __('No rooms found', THEME_CODE_NAME),
				'not_found_in_trash' => __('No rooms found in Trash', THEME_CODE_NAME),
				'menu_name'		=> __('Rooms'),
			),
			'description' => __('Manipulating with rooms'),
			'public' => true,
			'show_in_nav_menus' => true,
			'supports' => array(
				'title',
				'thumbnail',
				'editor',
				'excerpt',
				'page-attributes',
				'comments',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/room/room.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['room'],
			'has_archive' => 'rooms',
			'query_var' => 'room',
			'rewrite' => array('slug' => 'room'),
		)
	);
	aitRoomTaxonomies();
}


function aitRoomTaxonomies()
{

	register_taxonomy( 'ait-room-category', array( 'ait-room' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Room Categories', 'taxonomy general name' ),
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
		'rewrite' => array( 'slug' => 'rooms' ),
		'query_var' => 'rooms',
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Rooms', 'ait-room-category' )){
		wp_insert_term( 'Uncategorized Rooms', 'ait-room-category' );
	}
}
add_action( 'init', 'aitRoomPostType');



function aitRoomFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-room', 'side' );
	add_meta_box('postimagediv', __('Image for room'), 'post_thumbnail_meta_box', 'ait-room', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitRoomFeaturedImageMetabox');


$roomOptions = new WPAlchemy_MetaBox(array
(
	'id' => '_ait-room',
	'title' => __('Options for room'),
	'types' => array('ait-room'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));


function aitRoomChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title' ),
		'room_description_short'			=> __( 'Text' ),
		'thumbnail'		=> __( 'Image' ),
		'menu_order'	=> __( 'Order' ),
		'category'      => __( 'Category' ),
	);

	return $cols;
}
add_filter( "manage_ait-room_posts_columns", "aitRoomChangeColumns");



function aitRoomCustomColumns($column, $post_id)
{
	global $roomOptions;

	$options = $roomOptions->the_meta();

	switch ($column){
		case "room_description_short":

			if(isset($options['roomDescriptionShort'])){
				echo "<p>".$options['roomDescriptionShort']."</p>";
			}
			unset($options);
			break;
	}
}
add_action( "manage_posts_custom_column", "aitRoomCustomColumns", 10, 2);

function aitRoomSortableColumns()
{
	return array(
		'title'						=> 'title',
		'room_description_short'			=> 'room_description_short'
	);
}

add_filter( "manage_edit_ait-room_sortable_columns", "aitRoomSortableColumns" );