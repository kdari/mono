<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */


 function aitsliderCreatorPostType()
 {
	register_post_type('ait-slider-creator',
		array(
			'labels' => array(
			'name'			=> __('Sliders', THEME_CODE_NAME),
			'singular_name' => __('Slider Item', THEME_CODE_NAME),
			'add_new'		=> __('Add New Item', THEME_CODE_NAME),
			'add_new_item'	=> __('Add New Slider Item', THEME_CODE_NAME),
			'edit_item'		=> __('Edit Slider Item', THEME_CODE_NAME),
			'new_item'		=> __('New Item', THEME_CODE_NAME),
			'view_item'		=> __('View Item', THEME_CODE_NAME),
			'search_items'	=> __('Search Items', THEME_CODE_NAME),
			'not_found'		=> __('No Slider Items found', THEME_CODE_NAME),
			'not_found_in_trash' => __('No items found in Trash', THEME_CODE_NAME)
		),
		'public' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'ait-slider-creator'),
		'supports' => array('title', 'page-attributes'),
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/slider-creator/slider-creator.png',
		'menu_position' => $GLOBALS['aitThemeCustomTypes']['slider-creator'],
		)
	);

	aitsliderCreatorTaxonomies();
}



function aitsliderCreatorTaxonomies()
{

	register_taxonomy( 'ait-slider-creator-category', array( 'ait-slider-creator' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Slider Categories', 'taxonomy general name' ),
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
		'rewrite' => array('slug' => 'ait-slider-creator-category'),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Sliders', 'ait-slider-creator-category' )){
		wp_insert_term( 'Uncategorized Sliders', 'ait-slider-creator-category' );
	}
}

add_action( 'init', 'aitsliderCreatorPostType' );

$sliderCreatorOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-slider-creator',
	'title' => 'Slider Item Options',
	'types' => array('ait-slider-creator'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
	'js' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.js',
));



function aitsliderCreatorChangeColumns($cols)
{
  $cols = array(
    'cb'		=> '<input type="checkbox" />',
    'title'		=> __( 'Item Name', THEME_CODE_NAME ),
    'slider_type'	=> __( 'Type', THEME_CODE_NAME ),
    'slider_top_img' => __( 'Top Image', THEME_CODE_NAME ),
    'slider_back_img' => __( 'Background Image', THEME_CODE_NAME ),
    'slider_link' => __( 'Link', THEME_CODE_NAME ),
    'menu_order' => __( 'Order', THEME_CODE_NAME ),
    'category'  => __( 'Slider Category', THEME_CODE_NAME ),
  );

  return $cols;
}
add_filter( "manage_ait-slider-creator_posts_columns", "aitsliderCreatorChangeColumns");

function aitsliderCreatorCustomColumns($column, $post_id)
{
	global $sliderCreatorOptions;
	$options = $sliderCreatorOptions->the_meta();

	switch ($column){
		case "slider_type":
			if(isset($options['itemType'])){
				echo $options['itemType'];
			} else {
				echo "Image";
			}
			break;

		case "slider_top_img":
		  if(!empty($options['slideType']) && $options['slideType']=='advanced')
      	  {
      	  		switch($options['advancedItemType'])
	        	{
			          case "image":
			            if(isset($options['advancedImageSource'])){
			      				echo '<img src="'.TIMTHUMB_URL.'?src='.$options['advancedImageSource'].'&w=100&h=100" alt="" />';
			      			}
			            break;
			          case "video":
			            if(isset($options['advancedVideoPreview'])){
			      				echo '<img src="'.TIMTHUMB_URL.'?src='.$options['advancedVideoPreview'].'&w=100&h=100" alt="" />';
			      			}
			            break;
			          case "flash":
			            if(isset($options['advancedSwfPreview'])){
			      				echo '<img src="'.TIMTHUMB_URL.'?src='.$options['advancedSwfPreview'].'&w=100&h=100" alt="" />';
			      			}
			            break;
	        	}
		  }
		  else
      	  {
	        	if(!empty($options['topImage'])){
	  				echo '<img src="'.TIMTHUMB_URL.'?src='.$options['topImage'].'&w=100&h=100" alt="" />';
	  			}
      	  }
		  break;

		case "slider_back_img":
			if(!empty($options['backgroundImage'])){
				echo '<img src="'.TIMTHUMB_URL.'?src='.$options['backgroundImage'].'&w=100&h=100" alt="" />';
			}
			break;
		case "slider_link":
			if(!empty($options['itemType']) && $options['itemType'] == "video"){
				echo $options['videoUrl'];
			} else {
				echo $options['link'];
			}
			break;
	}
}
add_action( "manage_posts_custom_column", "aitsliderCreatorCustomColumns", 10, 2 );

function aitsliderCreatorSortableColumns()
{
  return array(
    'title'=> 'title',
    'category'=> 'category',
    'menu_order'=> 'order',
    'slider_type'=> 'slider_type',
  );
}
add_filter( "manage_edit-ait-slider-creator_sortable_columns", "aitsliderCreatorSortableColumns" );