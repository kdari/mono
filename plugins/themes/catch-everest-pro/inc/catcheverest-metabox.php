<?php
/**
 * Catch Everest Custom meta box
 *
 * @package Catch Themes
 * @subpackage Catch_Everest
 * @since Catch Everest 1.0
 */
 
 // Add the Meta Box  
function catcheverest_add_custom_box() {
	add_meta_box(
		'catcheverest-options',							  	//Unique ID
       __( 'Catch Everest Options', 'catcheverest' ),   	//Title
        'catcheverest_meta_options',                   	//Callback function
        'page'                                          	//show metabox in page
    ); 
	add_meta_box(
		'catcheverest-options',							  	//Unique ID
       __( 'Catch Everest Options', 'catcheverest' ),   	//Title
        'catcheverest_meta_options',                   	//Callback function
        'post'                                          	//show metabox in post
    ); 	
}
add_action( 'add_meta_boxes', 'catcheverest_add_custom_box' );


//Sidebar Layout Options
global $sidebar_layout;
$sidebar_layout = array(
		 'default-sidebar' => array(
            			'id'		=> 'catcheverest-sidebarlayout',
						'value' 	=> 'default',
						'label' 	=> __( 'Default Layout Set in', 'catcheverest' ).' <a href="'.get_bloginfo('url').'/wp-admin/themes.php?page=theme_options" target="_blank">'. __( 'Theme Options', 'catcheverest' ).'</a>',
						'thumbnail' => ' '
        			),
       'right-sidebar' => array(
						'id' => 'catcheverest-sidebarlayout',
						'value' => 'right-sidebar',
						'label' => __( 'Right sidebar', 'catcheverest' ),
						'thumbnail' => get_template_directory_uri() . '/inc/panel/images/right-sidebar.png'
       				),
        'left-sidebar' => array(
            			'id'		=> 'catcheverest-sidebarlayout',
						'value' 	=> 'left-sidebar',
						'label' 	=> __( 'Left sidebar', 'catcheverest' ),
						'thumbnail' => get_template_directory_uri() . '/inc/panel/images/left-sidebar.png'
       				),	 
        'no-sidebar' => array(
            			'id'		=> 'catcheverest-sidebarlayout',
						'value' 	=> 'no-sidebar',
						'label' 	=> __( 'No sidebar', 'catcheverest' ),
						'thumbnail' => get_template_directory_uri() . '/inc/panel/images/no-sidebar.png'
        			),
		'no-sidebar-full-width' => array(
            			'id'		=> 'catcheverest-sidebarlayout',
						'value' 	=> 'no-sidebar-full-width',
						'label' 	=> __( 'No sidebar, Full Width', 'catcheverest' ),
						'thumbnail' => get_template_directory_uri() . '/inc/panel/images/no-sidebar-fullwidth.png'
        			),
        'no-sidebar-one-column' => array(
            			'id'		=> 'catcheverest-sidebarlayout',
						'value' 	=> 'no-sidebar-one-column',
						'label' 	=> __( 'No Sidebar, One Column', 'catcheverest' ),
						'thumbnail' => get_template_directory_uri() . '/inc/panel/images/one-column.png'
        			)		

    );


//Sidebar Options
global $sidebar_options;
$sidebar_options = array(
	'main-sidebar' => array(
		'id'		=> 'catcheverest-sidebar-options',
		'value' 	=> 'default-sidebar',
		'label' 	=> __( 'Default Sidebar', 'catcheverest' )
	),
	'optional-sidebar-one' => array(
		'id' => 'catcheverest-sidebar-options',
		'value' => 'optional-sidebar-one',
		'label' => __( 'Optional Sidebar One', 'catcheverest' )
	),
	'optional-sidebar-two' => array(
		'id' => 'catcheverest-sidebar-options',
		'value' => 'optional-sidebar-two',
		'label' => __( 'Optional Sidebar Two', 'catcheverest' )
	),
	'optional-sidebar-three' => array(
		'id' => 'catcheverest-sidebar-options',
		'value' => 'optional-sidebar-three',
		'label' => __( 'Optional Sidebar three', 'catcheverest' )
	)	
);


//Featured Image Options
global $featuredimage_options;
$featuredimage_options = array(
	'default' => array(
		'id'		=> 'catcheverest-featured-image',
		'value' 	=> 'default',
		'label' 	=> __( 'Default Layout Set in', 'catcheverest' ).' <a href="'.get_bloginfo('url').'/wp-admin/themes.php?page=theme_options" target="_blank">'. __( 'Theme Options', 'catcheverest' ).'</a>',
	),							   
	'featured' => array(
		'id'		=> 'catcheverest-featured-image',
		'value' 	=> 'featured',
		'label' 	=> __( 'Featured Image', 'catcheverest' )
	),
	'full' => array(
		'id' => 'catcheverest-featured-image',
		'value' => 'full',
		'label' => __( 'Full Image', 'catcheverest' )
	),
	'slider' => array(
		'id' => 'catcheverest-featured-image',
		'value' => 'slider',
		'label' => __( 'Slider Image', 'catcheverest' )
	),
	'disable' => array(
		'id' => 'catcheverest-featured-image',
		'value' => 'disable',
		'label' => __( 'Disable Image', 'catcheverest' )
	)
	
);
	
/**
 * @renders metabox to for sidebar layout
 */
function catcheverest_meta_options() {  
    global $sidebar_layout, $sidebar_options, $featuredimage_options, $post;  
	
	
    // Use nonce for verification  
    wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );

    // Begin the field table and loop  ?>
    <div class="catcheverest-meta" style="border-bottom: 2px solid #dfdfdf; margin-bottom: 10px; padding-bottom: 10px;">
    	<h4 class="title"><?php _e('Sidebar Layout', 'catcheverest'); ?></h4>
        <table id="sidebar-layout" class="form-table" width="100%">
            <tbody> 
                <tr>
                    <?php  
                    foreach ($sidebar_layout as $field) {  
                        $metalayout = get_post_meta( $post->ID, $field['id'], true );
                        if(empty( $metalayout ) ){
                            $metalayout='default';
                        }
                        if( $field['thumbnail']==' ' ): ?>
                                <label class="description">
                                    <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $metalayout ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
                                </label>
                        <?php else: ?>
                            <td>
                                <label class="description">
                                    <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" width="136" height="122" alt="" /></span></br>
                                    <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $metalayout ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
                                </label>
                            </td>
                        <?php endif;
                    } // end foreach 
                    ?>
                </tr>
            </tbody>
        </table>
   	</div><!-- .catcheverest-meta -->
    
    <div class="catcheverest-meta" style="border-bottom: 2px solid #dfdfdf; margin-bottom: 10px; padding-bottom: 10px;">
    	<h4 class="title"><?php _e('Select Sidebar', 'catcheverest'); ?></h4>   
        <table id="sidebar-select" class="form-table" width="100%">
            <tbody> 
                <tr>
                    <?php  
                    foreach ($sidebar_options as $field) {  
                        
                        $metasidebar = get_post_meta( $post->ID, $field['id'], true );
                        
                        if (empty( $metasidebar ) ){
                            $metasidebar='default-sidebar';
                        } ?>
                        <td style="max-width: 100px; vertical-align: top;">
                            <label class="description">
                                <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $metasidebar ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
                            </label>
                        </td>
                        
                        <?php
                    } // end foreach 
                    ?>
                </tr>
            </tbody>
        </table>        
	</div><!-- .catcheverest-meta -->   
    
    <div class="catcheverest-meta">
    	<h4 class="title"><?php _e('Content Featured Image Size', 'catcheverest'); ?></h4>  
        <table id="featuedimage-metabox" class="form-table" width="100%">
            <tbody> 
                <tr>
                    <?php  
                    foreach ($featuredimage_options as $field) { 
					
					 	$metaimage = get_post_meta( $post->ID, $field['id'], true );
                        
                        if (empty( $metaimage ) ){
                            $metaimage='default';
                        } ?>
                        
                        <td style="width: 100px;">
                            <label class="description">
                                <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $metaimage ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
                            </label>
                        </td>
                        
                        <?php
                    } // end foreach 
                    ?>
                </tr>
            </tbody>
        </table>          
	</div><!-- .catcheverest-meta -->   
                       
<?php 
}


/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function catcheverest_save_custom_meta( $post_id ) { 
	global $sidebar_layout, $sidebar_options, $featuredimage_options, $post; 
	
	// Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'custom_meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'custom_meta_box_nonce' ], basename( __FILE__ ) ) )
        return;
		
	// Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
		
	if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  
	
	foreach ($sidebar_layout as $field) {  
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true); 
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {  
			update_post_meta($post_id, $field['id'], $new);  
		} elseif ('' == $new && $old) {  
			delete_post_meta($post_id, $field['id'], $old);  
		} 
	 } // end foreach   
	 
	foreach ( $sidebar_options as $field ) {  
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true); 
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {  
			update_post_meta($post_id, $field['id'], $new);  
		} elseif ('' == $new && $old) {  
			delete_post_meta($post_id, $field['id'], $old);  
		} 
	 } // end foreach  
	 
	foreach ( $featuredimage_options as $field ) {  
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true); 
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {  
			update_post_meta($post_id, $field['id'], $new);  
		} elseif ('' == $new && $old) {  
			delete_post_meta($post_id, $field['id'], $old);  
		} 
	 } // end foreach 
	 
}
add_action('save_post', 'catcheverest_save_custom_meta'); 