<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitGalleryPostType()
{
	register_post_type( 'ait-gallery',
		array(
			'labels' => array(
				'name'			=> __('Grid-Gallery' , THEME_CODE_NAME),
				'singular_name' => __('Picture' , THEME_CODE_NAME),
				'add_new'		=> __('Add new', THEME_CODE_NAME),
				'add_new_item'	=> __('Add new picture', THEME_CODE_NAME),
				'edit_item'		=> __('Edit Picture', THEME_CODE_NAME),
				'new_item'		=> __('New Picture', THEME_CODE_NAME),
				'not_found'		=> __('No pictures found', THEME_CODE_NAME),
				'not_found_in_trash' => __('No pictures found in Trash', THEME_CODE_NAME),
				'menu_name'		=> __('Grid-Gallery'),
			),
			'description' => __('Manipulating with gallery'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/gallery/gallery.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['gallery'],
		)
	);
	aitGalleryTaxonomies();
}


function aitGalleryTaxonomies()
{

	register_taxonomy( 'ait-gallery-category', array( 'ait-gallery' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Gallery Categories', THEME_CODE_NAME ),
			'singular_name' => _x( 'Category', THEME_CODE_NAME ),
			'search_items'	=> __( 'Search Category', THEME_CODE_NAME ),
			'all_items'		=> __( 'All Gategories', THEME_CODE_NAME ),
			'parent_item'	=> __( 'Parent Category', THEME_CODE_NAME ),
			'parent_item_colon' => __( 'Parent Category:', THEME_CODE_NAME ),
			'edit_item'		=> __( 'Edit Category', THEME_CODE_NAME ),
			'update_item'	=> __( 'Update Gategory', THEME_CODE_NAME ),
			'add_new_item'	=> __( 'Add New Category', THEME_CODE_NAME ),
			'new_item_name' => __( 'New Category Name', THEME_CODE_NAME ),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'ait-gallery-category' ),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Gallery', 'ait-gallery-category' )){
		wp_insert_term( 'Uncategorized Gallery', 'ait-gallery-category' );
	}
}
add_action( 'init', 'aitGalleryPostType');



function aitGalleryFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-gallery', 'side' );
	add_meta_box('postimagediv', __('Thumbnail'), 'post_thumbnail_meta_box', 'ait-gallery', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitGalleryFeaturedImageMetabox');


$galleryOptions = new WPAlchemy_MetaBox(array
(
	'id' => '_ait-gallery',
	'title' => __('Options for Picture'),
	'types' => array('ait-gallery'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));


function aitGalleryChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title', THEME_CODE_NAME ),
		'thumbnail'		=> __( 'Thumbnail', THEME_CODE_NAME ),
		'large_image'	=> __( 'Large Image', THEME_CODE_NAME ),
		'description'	=> __( 'Description', THEME_CODE_NAME ),
		'menu_order'	=> __( 'Order', THEME_CODE_NAME ),
		'category'      => __( 'Category', THEME_CODE_NAME ),
	);

	return $cols;
}
add_filter( "manage_ait-gallery_posts_columns", "aitGalleryChangeColumns");

function aitGalleryCustomColumns($column, $post_id)
{
	global $galleryOptions;

	$options = $galleryOptions->the_meta();

	switch ($column){
		case "large_image":
			if(isset($options['largeImage'])){
				echo '<img src="'.TIMTHUMB_URL.'?src='.htmlspecialchars($options['largeImage']).'&w=100&h=100" alt="" />';
			}
			break;
		case "description":
			if(isset($options['description'])){
				echo $options['description'];
			}
			break;
	}
}
add_action( "manage_posts_custom_column", "aitGalleryCustomColumns", 10, 2);

function aitGallerySortableColumns()
{
	return array(
		'title' => 'title',
		'menu_order' => 'order',
		'category' => 'category',
	);
}

add_filter( "manage_edit-ait-gallery_sortable_columns", "aitGallerySortableColumns" );