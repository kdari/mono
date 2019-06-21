<?php
/**
 * Holds the ShareaholicPublicJS class.
 *
 * @package shareaholic
 */

/**
 * This class gets the necessary components ready
 * for rendering the shareaholic js code for the template
 *
 * @package shareaholic
 */
class ShareaholicPublicJS {

  /**
   * Return a base set of settings for the Shareaholic JS or Publisher SDK
   */
  public static function get_base_settings() {
    $base_settings = array(
      'endpoints' => array(
        'local_recs_url' => admin_url('admin-ajax.php') . '?action=shareaholic_permalink_related',
        'ajax_url' => admin_url('admin-ajax.php')
      )
    );
    
    $disable_share_counts_api = ShareaholicUtilities::get_option('disable_internal_share_counts_api');
    $share_counts_connect_check = ShareaholicUtilities::get_option('share_counts_connect_check');

    if (isset($disable_share_counts_api)) {
      if (isset($share_counts_connect_check) && $share_counts_connect_check == 'SUCCESS' && $disable_share_counts_api != 'on') {
        $base_settings['endpoints']['share_counts_url'] = admin_url('admin-ajax.php') . '?action=shareaholic_share_counts_api';
      }
    }
    
    // Used by Share Count Recovery
    if (is_singular()) {
      global $post;
      
      $base_settings['url_components']['year'] = date('Y', strtotime($post->post_date));
      $base_settings['url_components']['monthnum'] = date('m', strtotime($post->post_date));
      $base_settings['url_components']['day'] = date('d', strtotime($post->post_date));
      
      $base_settings['url_components']['hour'] = date('H', strtotime($post->post_date));
      $base_settings['url_components']['minute'] = date('i', strtotime($post->post_date));
      $base_settings['url_components']['second'] = date('s', strtotime($post->post_date));      
      
      $base_settings['url_components']['post_id'] = "$post->ID";
      $base_settings['url_components']['postname'] = $post->post_name;
      
      if (ShareaholicUtilities::get_option('enable_user_nicename') == "on"){
        $base_settings['url_components']['author'] = get_the_author_meta('user_nicename', $post->post_author);
      }
      
      // ******** copied from WP core - START ******** //
      $category = '';
      $cats = get_the_category($post->ID);
			if ( $cats ) {
        // Sort the terms by ID and get the first category.
        if (function_exists('wp_list_sort')) {
          $cats = wp_list_sort( $cats, array(
            'term_id' => 'ASC',
          ) );
        } else {
          usort( $cats, '_usort_terms_by_ID' );
        }

				$category_object = apply_filters( 'post_link_category', $cats[0], $cats, $post );

				$category_object = get_term( $category_object, 'category' );
				$category = $category_object->slug;
				if ( $parent = $category_object->parent )
					$category = get_category_parents($parent, false, '/', true) . $category;
			}
			// show default category in permalinks, without
			// having to assign it explicitly
			if ( empty($category) ) {
				$default_category = get_term( get_option( 'default_category' ), 'category' );
				if ( $default_category && ! is_wp_error( $default_category ) ) {
					$category = $default_category->slug;
				}
			}
      // ******** copied from WP core - END ******** //
      
      $base_settings['url_components']['category'] = $category;
    }
    
    return $base_settings;
  }

  public static function get_overrides() {
    $output = '';

    if (ShareaholicUtilities::get_env() === 'staging') {
      $output = "data-shr-environment='stage' data-shr-assetbase='https://s3.amazonaws.com/cdn-staging-shareaholic/v2/'";
    }

    return $output;
   }

}
