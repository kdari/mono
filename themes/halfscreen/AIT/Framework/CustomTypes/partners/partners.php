<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitPartnersPostType()
{
	register_post_type( 'ait-partners',
		array(
			'labels' => array(
				'name'			=> __('Partners'),
				'singular_name' => __('partners'),
				'add_new'		=> __('Add new partners'),
				'add_new_item'	=> __('Add new partners'),
				'edit_item'		=> __('Edit partners'),
				'new_item'		=> __('New partners'),
				'not_found'		=> __('No partners found'),
				'not_found_in_trash' => __('No partners found in Trash'),
				'menu_name'		=> __('Partners'),
			),
			'description' => __('Manipulating with partners'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/partners/partners.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['partners'],
		)
	);
	aitPartnersTaxonomies();
}


function aitPartnersTaxonomies()
{

	register_taxonomy('ait-partners-category', array('ait-partners'), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Partners Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Partners Category', 'taxonomy singular name' ),
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
		'rewrite' => array( 'slug' => 'ait-partners-category' ),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Partners', 'ait-partners-category' )){
		wp_insert_term( 'Uncategorized Partners', 'ait-partners-category' );
	}
}
add_action( 'init', 'aitPartnersPostType' );



function aitPartnersFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-partners-box', 'side' );
	add_meta_box('postimagediv', __('Partners image'), 'post_thumbnail_meta_box', 'ait-partners', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitPartnersFeaturedImageMetabox');



$partnersOptions = new WPAlchemy_MetaBox(array
(
	'id' => '_ait-partners',
	'title' => __('Options for partners'),
	'types' => array('ait-partners'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));



function aitPartnersChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title' ),
		'partners_link'			=> __( 'Link' ),
		'thumbnail'		=> __( 'Image' ),
		'menu_order'	=> __( 'Order' ),
		'category'      => __( 'Category' ),
	);

	return $cols;
}
add_filter( "manage_ait-partners_posts_columns", "aitPartnersChangeColumns");



function aitPartnersCustomColumns($column, $post_id)
{
	global $partnersOptions;
	$options = $partnersOptions->the_meta();

	switch ($column)
	{
		
		case "partners_link":

			if(isset($options['partnersLink'])){
				echo '<a href="' . htmlspecialchars($options['partnersLink']) . '">' . htmlspecialchars($options['partnersLink']) . "</a>";
			}
			unset($options);
			break;	
	}
}
add_action( "manage_posts_custom_column", "aitPartnersCustomColumns", 10, 2);


function aitPartnersSortableColumns()
{
	return array(
		'title'			=> 'title',
		'link'			=> 'link'
	);
}

add_filter("manage_edit_ait-partners_sortable_columns", "aitPartnersSortableColumns");
