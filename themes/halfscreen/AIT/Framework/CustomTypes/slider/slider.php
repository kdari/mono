<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */


function aitSliderPostType()
{
	register_post_type('ait-slider',
		array(
			'labels' => array(
				'name'			=> __( 'Sliders', THEME_CODE_NAME),
				'singular_name' => __( 'Slider', THEME_CODE_NAME),
				'add_new'		=> __('Add new', THEME_CODE_NAME),
				'add_new_item'	=> __('Add new slide', THEME_CODE_NAME),
				'edit_item'		=> __('Edit slide', THEME_CODE_NAME),
				'new_item'		=> __('New slide', THEME_CODE_NAME),
				'not_found'		=> __('No slides found', THEME_CODE_NAME),
				'not_found_in_trash' => __('No slides found in Trash', THEME_CODE_NAME),
				'menu_name'		=> __('Sliders'),
			),
			'description' => __('Manipulating with slides and sliders'),
			'public' => true,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'hierarchical' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'editor',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/slider/slider.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['slider'],
		)
	);
	aitSliderTaxonomies();
}



function aitSliderTaxonomies()
{
	register_taxonomy( 'ait-slider-category', array('ait-slider'), array(
		'labels' => array(
			'name'			=> _x( 'Sliders Types', 'taxonomy general name' ),
			'singular_name' => _x( 'Slider Type', 'taxonomy singular name' ),
			'search_items'	=> __( 'Search Slider' ),
			'all_items'		=> __( 'All Sliders' ),
			'edit_item'		=> __( 'Edit Slider' ),
			'update_item'	=> __( 'Update Slider' ),
			'add_new_item'	=> __( 'Add New Slider' ),
			'new_item_name' => __( 'New Slider Name' ),
		),
		'show_in_nav_menus' => false,
		'public' => true, // Should this taxonomy be exposed in the admin UI.
		'hierarchical' => true,
		'show_ui' => true,
	));
}

add_action( 'init', 'aitSliderPostType' );



function aitSliderImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-slider', 'side' );
	add_meta_box('postimagediv', __('Slide Image'), 'post_thumbnail_meta_box', 'ait-slider', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitSliderImageMetabox');



$sliderOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-slider',
	'title' => __('Options for slide'),
	'types' => array('ait-slider'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));



function aitSliderChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title', THEME_CODE_NAME ),
		'thumbnail'		=> __( 'Image', THEME_CODE_NAME ),
		'ait-slider-category'	=> __( 'Slider Type', THEME_CODE_NAME ),
		'caption'		=> __( 'Caption', THEME_CODE_NAME ),
		'menu-order'	=> __( 'Order', THEME_CODE_NAME ),
		'slide-link'	=> __( 'Link', THEME_CODE_NAME ),
	);

	return $cols;
}
add_filter( "manage_ait-slider_posts_columns", "aitSliderChangeColumns" );



function aitSliderCustomColumns($column, $post_id)
{
	global $sliderOptions;

	switch($column){
		case "caption":
			the_content();
			break;

		case "ait-slider-category":
			$terms = get_the_terms($post_id, 'ait-slider-category');
			if(!empty($terms)){
				foreach($terms as $term){
					echo "<p>{$term->name}</p>";
				}
			}else{
				echo "<p><em>Slide must have some type</em></p>";
			}
		break;

		case "menu-order":
			$post = get_post($post_id);
			echo $post->menu_order;
			unset($post);
			break;

		case "slide-link":
			$options = $sliderOptions->the_meta();

			if(isset($options['slideLink'])){
				echo '<a href="' . esc_url($options['slideLink']) . '">' . htmlspecialchars($options['slideLink']) . "</a>";
			}
			unset($options);
			break;
	}
}
add_action( "manage_posts_custom_column", "aitSliderCustomColumns", 10, 2);