<?php
/**
 * Template Name: Fullwidth Template
 * Description: Page without sidebar
 *
 * @package WordPress
 * @subpackage Creator
 * @since Creator 1.0
 */

$latteParams['post'] = WpLatte::createPostEntity(
	$GLOBALS['wp_query']->post,
	array(
		'meta' => $GLOBALS['pageOptions'],
	)
);

$latteParams['page']->classes = implode(' ', get_post_class());

/* HEADER HEIGHT :: START */
$sliderOptions = $latteParams['post']->options('page_slider');
//var_dump($sliderOptions->sliderType);
$term = $wpdb->get_results( "SELECT * FROM `wp_terms` WHERE `slug` LIKE '".$sliderOptions->sliderType."'" );
//var_dump($term);
$term = $term[0]->term_id; 
$objects = $wpdb->get_results( "SELECT * FROM `wp_term_relationships` WHERE `term_taxonomy_id` LIKE '".$term."'" );
//var_dump($objects);

$maxHeight = 0;
$iterator = 0;
foreach($objects as $imageId){
  //var_dump($imageId->object_id);
	$image = $wpdb->get_results( "SELECT * FROM `wp_postmeta` WHERE `meta_key` LIKE '_ait_slider-creator' AND `post_id` = '".$imageId->object_id."'" );
  //var_dump($image);
  $imageData = unserialize($image[0]->meta_value);
  //var_dump($imageData);
  if($imageData['slideType'] == 'normal'){
    if(!empty($imageData['topImage'])){
  		$src = THEME_DIR . "/" . substr($imageData['topImage'], strlen(THEME_URL) + 1);
  		if(!is_file($src)){
  			$u = wp_upload_dir();
  			$baseUrl = $u['baseurl'];
  			$baseDir = $u['basedir'];
  			$src = $baseDir . "/" . substr($imageData['topImage'], strlen($baseUrl) + 1);
  		}
  
  		if(is_file($src)){
  			$imageSize[$imageData['topImage']] = @getimagesize($src);
  			$imageHeight = $imageSize[$imageData['topImage']][1];
  
  			if($imageHeight > $maxHeight){
  				$maxHeight = $imageHeight;
  			}
  		}
  		$latteParams['headerHeightUse'] = "TopImage";
  	} else {
      $src = THEME_DIR . "/" . substr($imageData['backgroundImage'], strlen(THEME_URL) + 1);
  		if(!is_file($src)){
  			$u = wp_upload_dir();
  			$baseUrl = $u['baseurl'];
  			$baseDir = $u['basedir'];
  			$src = $baseDir . "/" . substr($imageData['backgroundImage'], strlen($baseUrl) + 1);
  		}
  
  		if(is_file($src)){
  			$imageSize[$imageData['backgroundImage']] = @getimagesize($src);
  			$imageHeight = $imageSize[$imageData['backgroundImage']][1];
  
  			if($imageHeight > $maxHeight){
  				$maxHeight = $imageHeight;
  			}
  		}
  		$latteParams['headerHeightUse'] = "BottomImage";		
    }
    $iterator++;
    break;
  } 
}

$latteParams['debugIterator'] = $iterator; 
$latteParams['imageSize'] = $imageHeight;

/* HEADER HEIGHT :: END */

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();