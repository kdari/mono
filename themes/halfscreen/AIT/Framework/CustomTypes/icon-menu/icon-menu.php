<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitIconMenuPostType()
{
	register_post_type( 'ait-icon-menu',
		array(
			'labels' => array(
				'name'			=> __('Icon Menu'),
				'singular_name' => __('icon-menu'),
				'add_new'		=> __('Add new icon menu'),
				'add_new_item'	=> __('Add new icon menu'),
				'edit_item'		=> __('Edit icon'),
				'new_item'		=> __('New icon'),
				'not_found'		=> __('No icons found'),
				'not_found_in_trash' => __('No icons found in Trash'),
				'menu_name'		=> __('Icon Menu'),
			),
			'description' => __('Manipulating with icon menu'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/icon-menu/icon-menu.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['icon-menu'],
		)
	);
	aitIconMenuTaxonomies();
}


function aitIconMenuTaxonomies()
{

	register_taxonomy('ait-icon-menu-category', array('ait-icon-menu'), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Icon Menu Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Icon Menu Category', 'taxonomy singular name' ),
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
		'rewrite' => array( 'slug' => 'ait-icon-menu-category' ),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Icon Menus', 'ait-icon-menu-category' )){
		wp_insert_term( 'Uncategorized Icon Menus', 'ait-icon-menu-category' );
	}
}
add_action( 'init', 'aitIconMenuPostType' );



function aitIconMenuFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-icon-menu-box', 'side' );
	add_meta_box('postimagediv', __('Icon Menu image'), 'post_thumbnail_meta_box', 'ait-icon-menu', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitIconMenuFeaturedImageMetabox');



$iconMenuOptions = new WPAlchemy_MetaBox(array
(
	'id' => '_ait-icon-menu',
	'title' => __('Options for Icon Menu'),
	'types' => array('ait-icon-menu'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));



function aitIconMenuChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title' ),
		'icon-menu_text'			=> __( 'Text' ),
		'icon-menu_link'			=> __( 'Link' ),
		'icon-menu_label'			=> __( 'Label' ),
		'thumbnail'		=> __( 'Image' ),
		'menu_order'	=> __( 'Order' ),
		'category'      => __( 'Category' ),
	);

	return $cols;
}
add_filter( "manage_ait-icon-menu_posts_columns", "aitIconMenuChangeColumns");



function aitIconMenuCustomColumns($column, $post_id)
{
	global $iconMenuOptions;
	$options = $iconMenuOptions->the_meta();

	switch ($column)
	{
		
		case "icon-menu_text":

			if(isset($options['iconMenuText'])){
				echo "<p>".$options['iconMenuText']."</p>";
			}
			unset($options);
			break;

		case "icon-menu_link":

			if(isset($options['iconMenuLink'])){
				echo '<a href="' . htmlspecialchars($options['iconMenuLink']) . '">' . htmlspecialchars($options['iconMenuLink']) . "</a>";
			}
			unset($options);
			break;
			
		case "icon-menu_label":

			if(isset($options['iconMenuLabel'])){
				if(isset($options['iconMenuLabelColor'])){
					$color = "background-color: #".$options['iconMenuLabelColor'].";";
				} else {
					$color = 'background-color: #C9000D;';
				}
				echo '<span class="label"><span style="'.$color.' display: inline-block; font-size: 11px; font-weight: bold; line-height: 16px; padding: 1px 10px 2px 10px; color: #FFFFFF; -moz-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3); -webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3); box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3); -moz-border-radius: 2px; -webkit-border-radius: 2px; border-radius: 2px;">'.$options['iconMenuLabel'].'</span></span>';
			}
			unset($options);
			break;
			
	}
}
add_action( "manage_posts_custom_column", "aitIconMenuCustomColumns", 10, 2);


function aitIconMenuSortableColumns()
{
	return array(
		'title'			=> 'title',
		'text'			=> 'text',
		'link'			=> 'link'
	);
}

add_filter("manage_edit_ait-icon-menu_sortable_columns", "aitIconMenuSortableColumns");
