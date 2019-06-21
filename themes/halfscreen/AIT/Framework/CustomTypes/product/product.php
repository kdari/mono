<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitProductPostType()
{
	register_post_type( 'ait-product',
		array(
			'labels' => array(
				'name'			=> __('Products'),
				'singular_name' => __('product'),
				'add_new'		=> __('Add new product'),
				'add_new_item'	=> __('Add new product'),
				'edit_item'		=> __('Edit product'),
				'new_item'		=> __('New product'),
				'not_found'		=> __('No products found'),
				'not_found_in_trash' => __('No products found in Trash'),
				'menu_name'		=> __('Products'),
			),
			'description' => __('Manipulating with products'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/product/product.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['product'],
		)
	);
	aitProductTaxonomies();
}


function aitProductTaxonomies()
{

	register_taxonomy('ait-product-category', array('ait-product'), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Products Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Products Category', 'taxonomy singular name' ),
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
		'rewrite' => array( 'slug' => 'ait-product-category' ),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Products', 'ait-product-category' )){
		wp_insert_term( 'Uncategorized Products', 'ait-product-category' );
	}
}
add_action( 'init', 'aitProductPostType' );



function aitProductFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-product-box', 'side' );
	add_meta_box('postimagediv', __('Product image'), 'post_thumbnail_meta_box', 'ait-product', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitProductFeaturedImageMetabox');



$productOptions = new WPAlchemy_MetaBox(array
(
	'id' => '_ait-product',
	'title' => __('Options for product'),
	'types' => array('ait-product'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));



function aitProductChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title' ),
		'product_text'			=> __( 'Text' ),
		'product_link'			=> __( 'Link' ),
		'product_label'			=> __( 'Label' ),
		'thumbnail'		=> __( 'Image' ),
		'menu_order'	=> __( 'Order' ),
		'category'      => __( 'Category' ),
	);

	return $cols;
}
add_filter( "manage_ait-product_posts_columns", "aitProductChangeColumns");



function aitProductCustomColumns($column, $post_id)
{
	global $productOptions;
	$options = $productOptions->the_meta();

	switch ($column)
	{

		case "product_text":

			if(isset($options['productText'])){
				echo "<p>".$options['productText']."</p>";
			}
			unset($options);
			break;

		case "product_link":

			if(isset($options['productLink'])){
				echo '<a href="' . htmlspecialchars($options['productLink']) . '">' . htmlspecialchars($options['productLink']) . "</a>";
			}
			unset($options);
			break;

		case "product_label":

			if(isset($options['productLabel'])){
				if(isset($options['productLabelColor'])){
					$color = "background-color: #".$options['productLabelColor'].";";
				} else {
					$color = 'background-color: #C9000D;';
				}
				echo '<span class="label"><span style="'.$color.' display: inline-block; font-size: 11px; font-weight: bold; line-height: 16px; padding: 1px 10px 2px 10px; color: #FFFFFF; -moz-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3); -webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3); box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3); -moz-border-radius: 2px; -webkit-border-radius: 2px; border-radius: 2px;">'.$options['productLabel'].'</span></span>';
			}
			unset($options);
			break;

	}
}
add_action( "manage_posts_custom_column", "aitProductCustomColumns", 10, 2);


function aitProductSortableColumns()
{
	return array(
		'product_label' => 'product_label',
		'menu_order' => 'order',
		'category' => 'category',
	);
}
add_filter("manage_edit-ait-product_sortable_columns", "aitProductSortableColumns");
