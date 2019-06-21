<?php
/**
 * Catch Everest Theme Options
 *
 * @package Catch Themes
 * @subpackage Catch_Everest
 * @since Catch Everest 1.0
 */
add_action( 'admin_init', 'catcheverest_register_settings' );
add_action( 'admin_menu', 'catcheverest_options_menu' );


/**
 * Enqueue admin script and styles
 *
 * @uses wp_register_script, wp_enqueue_script and wp_enqueue_style
 * @Calling jquery, jquery-ui-tabs,jquery-cookie, jquery-ui-sortable, jquery-ui-draggable, media-upload, thickbox, farbtastic, colorpicker
 */
function catcheverest_admin_scripts() {
	//jQuery Cookie
	wp_register_script( 'jquery-cookie', get_template_directory_uri() . '/inc/panel/js/jquery.cookie.min.js', array( 'jquery' ), '1.0', true );
	
	wp_enqueue_script( 'catcheverest_admin', get_template_directory_uri().'/inc/panel/js/admin.js', array( 'jquery', 'jquery-ui-tabs', 'jquery-cookie', 'jquery-ui-sortable', 'jquery-ui-draggable' ) );
	wp_enqueue_script( 'catcheverest_upload', get_template_directory_uri().'/inc/panel/js/add_image_scripts.js', array( 'jquery','media-upload','thickbox' ) );
	
	wp_enqueue_script( 'catcheverest_color', get_template_directory_uri().'/inc/panel/js/color_picker.js', array( 'farbtastic' ) );
	
	wp_enqueue_style( 'catcheverest_admin_style',get_template_directory_uri().'/inc/panel/admin.css', array( 'farbtastic', 'thickbox'), '1.0', 'screen' );

}
add_action('admin_print_styles-appearance_page_theme_options', 'catcheverest_admin_scripts');


/*
 * Create a function for Theme Options Page
 *
 * @uses add_menu_page
 * @add action admin_menu 
 */
function catcheverest_options_menu() {

	add_theme_page( 
        __( 'Theme Options', 'catcheverest' ),           // Name of page
        __( 'Theme Options', 'catcheverest' ),           // Label in menu
        'edit_theme_options',                           // Capability required
        'theme_options',                                // Menu slug, used to uniquely identify the page
        'catcheverest_theme_options_do_page'             // Function that renders the options page
    );	

}


/* 
 * Admin Social Links
 * use facebook and twitter scripts
 */
function catcheverest_admin_social() { ?>
<!-- Start Social scripts -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=276203972392824";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<!-- End Social scripts -->
<?php
}
add_action('admin_print_styles-appearance_page_theme_options','catcheverest_admin_social');


/*
 * Register options and validation callbacks
 *
 * @uses register_setting
 * @action admin_init
 */
function catcheverest_register_settings(){
	register_setting( 'catcheverest_options', 'catcheverest_options', 'catcheverest_theme_options_validate' );
}


/*
 * Render Catch Everest Theme Options page
 *
 * @uses settings_fields, get_option, bloginfo
 * @Settings Updated
 */
function catcheverest_theme_options_do_page() {
	if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;
	?>
    
	<div id="catchthemes" class="wrap">
    	
    	<form method="post" action="options.php">
			<?php
                settings_fields( 'catcheverest_options' );
                global $catcheverest_options_settings;
                $options = $catcheverest_options_settings;				
            ?>   
            <?php if (false !== $_REQUEST['settings-updated']) : ?>
            	<div class="updated fade"><p><strong><?php _e('Options Saved', 'catcheverest'); ?></strong></p></div>
            <?php endif; ?>            
            
			<div id="theme-option-header">
            	<div id="theme-social">
                	<ul>
            			<li class="widget-fb">
                            <div data-show-faces="false" data-width="80" data-layout="button_count" data-send="false" data-href="<?php echo esc_url(__('http://facebook.com/catchthemes','catcheverest')); ?>" class="fb-like"></div></li>
                     	<li class="widget-tw">
                            <a data-dnt="true" data-show-screen-name="true" data-show-count="true" class="twitter-follow-button" href="<?php echo esc_url(__('https://twitter.com/catchthemes','catcheverest')); ?>">Follow @catchthemes</a>
            			</li>
                   	</ul>
               	</div><!-- #theme-social -->
            
                <div id="theme-option-title">
                    <h2 class="title"><?php _e( 'Theme Options By', 'catcheverest' ); ?></h2>
                    <h2 class="logo">
                        <a href="<?php echo esc_url( __( 'http://catchthemes.com/', 'catcheverest' ) ); ?>" title="<?php esc_attr_e( 'Catch Themes', 'catcheverest' ); ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri().'/inc/panel/images/catch-themes.png'; ?>" alt="<?php _e( 'Catch Themes', 'catcheverest' ); ?>" />
                        </a>
                    </h2>
                </div><!-- #theme-option-title -->
            
                <div id="theme-support">
                    <ul>
                        <li><a class="button" href="<?php echo esc_url(__('http://catchthemes.com/support-forum/forum/catch-everest-pro-premium/','catcheverest')); ?>" title="<?php esc_attr_e('Support Forum', 'catcheverest'); ?>" target="_blank"><?php printf(__('Support Forum','catcheverest')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('http://catchthemes.com/theme-instructions/catch-everest-pro/','catcheverest')); ?>" title="<?php esc_attr_e('Theme Instruction', 'catcheverest'); ?>" target="_blank"><?php printf(__('Theme Instruction','catcheverest')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('https://www.facebook.com/catchthemes/','catcheverest')); ?>" title="<?php esc_attr_e('Like Catch Themes on Facebook', 'catcheverest'); ?>" target="_blank"><?php printf(__('Facebook','catcheverest')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('https://twitter.com/catchthemes/','catcheverest')); ?>" title="<?php esc_attr_e('Follow Catch Themes on Twitter', 'catcheverest'); ?>" target="_blank"><?php printf(__('Twitter','catcheverest')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('http://wordpress.org/support/view/theme-reviews/catch-everest','catcheverest')); ?>" title="<?php esc_attr_e('Rate us 5 Star on WordPress', 'catcheverest'); ?>" target="_blank"><?php printf(__('5 Star Rating','catcheverest')); ?></a></li>
                   	</ul>
                </div><!-- #theme-support --> 
                 
          	</div><!-- #theme-option-header -->              
 
            
            <div id="catcheverest_ad_tabs">
                <ul class="tabNavigation" id="mainNav">
                    <li><a href="#themeoptions"><?php _e( 'Theme Options', 'catcheverest' );?></a></li>
                    <li><a href="#homepagesettings"><?php _e( 'Homepage Settings', 'catcheverest' );?></a></li>
                    <li><a href="#slidersettings"><?php _e( 'Featured Slider', 'catcheverest' );?></a></li>
                    <li><a href="#sociallinks"><?php _e( 'Social Links', 'catcheverest' );?></a></li>
                    <li><a href="#webmaster"><?php _e( 'Webmaster Tools', 'catcheverest' );?></a></li>
                </ul><!-- .tabsNavigation #mainNav -->
                   
                   
                <!-- Option for Design Settings -->
                <div id="themeoptions">     
                
                	<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Responsive Design', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                        	<table class="form-table">
                                <tbody>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Disable Responsive Design?', 'catcheverest' ); ?></th>
                                        <input type='hidden' value='0' name='catcheverest_options[disable_responsive]'>
                                        <td><input type="checkbox" id="headerlogo" name="catcheverest_options[disable_responsive]" value="1" <?php checked( '1', $options['disable_responsive'] ); ?> /> <?php _e('Check to disable', 'catcheverest'); ?></td>
                                    </tr>
                               	</tbody>
                          	</table>
                      		<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content --> 
                    </div><!-- .option-container --> 
                       
                  	<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Favicon', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php _e( 'Disable Favicon?', 'catcheverest' ); ?></th>
                                         <input type='hidden' value='0' name='catcheverest_options[remove_favicon]'>
                                        <td><input type="checkbox" id="favicon" name="catcheverest_options[remove_favicon]" value="1" <?php checked( '1', $options['remove_favicon'] ); ?> /> <?php _e('Check to disable', 'catcheverest'); ?></td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Fav Icon URL:', 'catcheverest' ); ?></th>
                                        <td><?php if ( !empty ( $options[ 'fav_icon' ] ) ) { ?>
                                                <input class="upload-url" size="65" type="text" name="catcheverest_options[fav_icon]" value="<?php echo esc_url( $options [ 'fav_icon' ] ); ?>" /> <input id="st_upload_button" class="st_upload_button button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Fav Icon','catcheverest' );?>" />
                                            <?php } else { ?>
                                                <input class="upload-url" size="65" type="text" name="catcheverest_options[fav_icon]" value="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" alt="fav" /> <input id="st_upload_button" class="st_upload_button button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Upload Fav Icon','catcheverest' );?>" />
                                            <?php }  ?> 
                                            
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><?php _e( 'Preview: ', 'catcheverest' ); ?></th>
                                        <td> 
                                            <?php 
                                                if ( !empty( $options[ 'fav_icon' ] ) ) { 
                                                    echo '<img src="'.esc_url( $options[ 'fav_icon' ] ).'" alt="fav" />';
                                                } else {
                                                    echo '<img src="'. get_template_directory_uri().'/images/favicon.ico" alt="fav" />';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                                        
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Header Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table"> 
                            	<tbody>
                                    <tr>
                                        <th scope="row"><?php _e( 'Custom Header: Logo & Site Detais', 'catcheverest' ); ?></th>
                                        <td><a class="button" href="<?php echo admin_url('themes.php?page=custom-header'); ?>"><?php _e('Click Here to Add/Replace Header Logo & Site Details', 'catcheverest'); ?></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Move Site Title and Description', 'catcheverest' ); ?></th>
                                        <input type='hidden' value='0' name='catcheverest_options[site_title_above]'>
                                        <td><input type="checkbox" id="site-title" name="catcheverest_options[site_title_above]" value="1" <?php checked( '1', $options['site_title_above'] ); ?> /> <?php _e('Check to move above the Header/Logo Image', 'catcheverest'); ?></td>
                                    </tr>
                             	</tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Header Right Sidebar Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table"> 
                            	<tbody>                
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Disable Header Right Sidebar?', 'catcheverest' ); ?></th>
                                        <input type='hidden' value='0' name='catcheverest_options[disable_header_right_sidebar]'>
                                        <td><input type="checkbox" id="headerlogo" name="catcheverest_options[disable_header_right_sidebar]" value="1" <?php checked( '1', $options['disable_header_right_sidebar'] ); ?> /> <?php _e('Check to Disable', 'catchthemes'); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Header Right Sidebar', 'catcheverest' ); ?></th>
                                        <td><a class="button" href="<?php echo esc_url( admin_url( 'widgets.php' ) ) ; ?>" title="<?php esc_attr_e( 'Widgets', 'catchthemes' ); ?>"><?php _e( 'Click Here to Add/Replace Widgets', 'catcheverest' );?></a></td>
                                    </tr>
                              	</tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->  
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Header Featured Image Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table"> 
                            	<tbody>      
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Enable Featured Header Image', 'catcheverest' ); ?></label></th>
                                        <td>
                                            <label title="enable-header-homepage" class="box">
                                            <input type="radio" name="catcheverest_options[enable_featured_header_image]" id="enable-header-homepage" <?php checked($options['enable_featured_header_image'], 'homepage') ?> value="homepage"  />
                                            <?php _e( 'Homepage', 'catcheverest' ); ?>
                                            </label>
                                            <label title="enable-header-allpage" class="box">
                                            <input type="radio" name="catcheverest_options[enable_featured_header_image]" id="enable-header-allpage" <?php checked($options['enable_featured_header_image'], 'allpage') ?> value="allpage"  />
                                             <?php _e( 'Entire Site', 'catcheverest' ); ?>
                                            </label>
                                            <label title="disable-header" class="box">
                                            <input type="radio" name="catcheverest_options[enable_featured_header_image]" id="disable-header" <?php checked($options['enable_featured_header_image'], 'disable') ?> value="disable" />
                                             <?php _e( 'Disable', 'catcheverest' ); ?>
                                            </label>                                
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Featured HeaderImage Position', 'catcheverest' ); ?></label></th>
                                        <td>
                                        	<label title="before-menu" class="box"><input type="radio" name="catcheverest_options[featured_header_image_position]" id="before-menu" <?php checked($options['featured_header_image_position'], 'before-menu') ?> value="before-menu"  />
                                            <?php _e( 'Before Menu', 'catcheverest' ); ?>
                                            </label>
                                            
                                            <label title="after-menu" class="box"><input type="radio" name="catcheverest_options[featured_header_image_position]" id="after-menu" <?php checked($options['featured_header_image_position'], 'after-menu') ?> value="after-menu"  />
                                            <?php _e( 'After Menu', 'catcheverest' ); ?>
                                            </label> 
                                            
                                        	<label title="before-header" class="box"><input type="radio" name="catcheverest_options[featured_header_image_position]" id="before-header" <?php checked($options['featured_header_image_position'], 'before-header') ?> value="before-header"  />
                                            <?php _e( 'Before Header', 'catcheverest' ); ?>
                                            </label> 
                                            
                                            <label title="after-sidebartop" class="box"><input type="radio" name="catcheverest_options[featured_header_image_position]" id="after-sidebartop" <?php checked($options['featured_header_image_position'], 'after-sidebartop') ?> value="after-sidebartop"  />
                                            <?php _e( 'After Top Sidebar', 'catcheverest' ); ?>
                                            </label>                                    
                                        </td>
                                    </tr> 
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Featured Header Image URL', 'catcheverest' ); ?></th>
                                        <td>
                                        	<input class="upload-url" size="65" type="text" name="catcheverest_options[featured_header_image]" value="<?php echo esc_url( $options [ 'featured_header_image' ] ); ?>" /> <input id="st_upload_button" class="st_upload_button button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Change Image','catcheverest' );?>" />
                                        </td>
                                    </tr>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Featured Header Image Alt/Title Tag', 'catcheverest' ); ?></th>
                                        <td>
                                        	<input class="upload-url" size="65" type="text" name="catcheverest_options[featured_header_image_alt]" value="<?php echo esc_attr( $options [ 'featured_header_image_alt' ] ); ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Featured Header Image Link URL', 'catcheverest' ); ?></label></th>
                                        <td><input type="text" size="65" name="catcheverest_options[featured_header_image_url]" value="<?php echo esc_url( $options [ 'featured_header_image_url' ] ); ?>" /> <?php _e( 'Add in the Link URL', 'catcheverest' ); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Target. Open Link in New Window?', 'catcheverest' ); ?></label></th>
                                        <input type="hidden" value="0" name="catcheverest_options[featured_header_image_base]"> 
                                        <td><input type="checkbox" id="header-image-base" name="catcheverest_options[featured_header_image_base]" value="1" <?php checked( '1', $options['featured_header_image_base'] ); ?> /> <?php _e('Check to open in new window', 'catchthemes'); ?>
                                        </td>
                                    </tr>   
                                     
                         		</tbody>
                            </table>
                       	 	<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catchthemes' ); ?>" /></p> 
						</div><!-- .option-content --> 
                 	</div><!-- .option-container -->             
                                        
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Color Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                        	<table class="form-table">  
                                <tbody>
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Default Color Scheme', 'catcheverest' ); ?></label></th>
                                        <td>
                                            <label title="color-light" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/light.png" alt="color-light" /><br />
                                            <input type="radio" name="catcheverest_options[color_scheme]" id="color-light" <?php checked($options['color_scheme'], 'light') ?> value="light"  />
                                            <?php _e( 'Light', 'catcheverest' ); ?>
                                            </label>
                                            <label title="color-dark" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/dark.png" alt="color-dark" /><br />
                                            <input type="radio" name="catcheverest_options[color_scheme]" id="color-dark" <?php checked($options['color_scheme'], 'dark') ?> value="dark"  />
                                            <?php _e( 'Dark', 'catcheverest' ); ?>
                                            </label>                                     
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="catcheverest_custom_background">
                                                <?php _e( 'Custom Background Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<a class="button" href="<?php echo admin_url('themes.php?page=custom-background'); ?>">
                                            	<?php _e( 'Click Here to change Background Color/Image', 'catcheverest' ); ?>
                                           	</a>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_header_background">
                                                <?php _e( 'Header Background Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_header_background" name="catcheverest_options[header_background]" size="8" value="<?php echo ( isset( $options[ 'header_background' ] ) ) ? esc_attr( $options[ 'header_background' ] ) : '#fff'; ?>"  />
                                            <div id="colorpicker_header_background" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_content_background">
                                                <?php _e( 'Content Background Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_content_background" name="catcheverest_options[content_background]" size="8" value="<?php echo ( isset( $options[ 'content_background' ] ) ) ? esc_attr( $options[ 'content_background' ] ) : '#fff'; ?>"  />
                                            <div id="colorpicker_content_background" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_footer_sidebar_background">
                                                <?php _e( 'Footer Background Sidebar Color: ', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_footer_sidebar_background" name="catcheverest_options[footer_sidebar_background]" size="8" value="<?php echo ( isset( $options[ 'footer_sidebar_background' ] ) ) ? esc_attr( $options[ 'footer_sidebar_background' ] ) : '#fafafa'; ?>"  />
                                            <div id="colorpicker_footer_sidebar_background" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_footer_background">
                                                <?php _e( 'Footer Background Color: ', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_footer_background" name="catcheverest_options[footer_background]" size="8" value="<?php echo ( isset( $options[ 'footer_background' ] ) ) ? esc_attr( $options[ 'footer_background' ] ) : '#3a3d41'; ?>"  />
                                            <div id="colorpicker_footer_background" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_custom_background">
                                                <?php _e( 'Custom Header: ', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                        	<a class="button" href="<?php echo admin_url('themes.php?page=custom-header'); ?>">
                                            	<?php _e( 'Click Here to change Site Title and Tagline Color', 'catcheverest' ); ?>
                                           	</a>
                                        </td>
                                    </tr>
                                    
                                      
                                  	<tr>
                                        <th>
                                            <label for="catcheverest_title">
                                                <?php _e( 'Title Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_title" name="catcheverest_options[title_color]" size="8" value="<?php echo ( isset( $options[ 'title_color' ] ) ) ? esc_attr( $options[ 'title_color' ] ) : '#333'; ?>"  />
                                            <div id="colorpicker_title_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                     
                                     <tr>
                                        <th>
                                            <label for="catcheverest_title_hover">
                                                <?php _e( 'Title Hover Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_title_hover" name="catcheverest_options[title_hover_color]" size="8" value="<?php echo ( isset( $options[ 'title_hover_color' ] ) ) ? esc_attr( $options[ 'title_hover_color' ] ) : '#0088cc'; ?>"  />
                                            <div id="colorpicker_title_hover_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                 	<tr>
                                        <th>
                                            <label for="catcheverest_meta_color">
                                                <?php _e( 'Meta Description Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_meta_color" name="catcheverest_options[meta_color]" size="8" value="<?php echo ( isset( $options[ 'meta_color' ] ) ) ? esc_attr( $options[ 'meta_color' ] ) : '#757575'; ?>"  />
                                            <div id="colorpicker_meta_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_text_color">
                                                <?php _e( 'Text Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_text_color" name="catcheverest_options[text_color]" size="8" value="<?php echo ( isset( $options[ 'text_color' ] ) ) ? esc_attr( $options[ 'text_color' ] ) : '#404040'; ?>"  />
                                            <div id="colorpicker_text_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                  	<tr>
                                        <th>
                                            <label for="catcheverest_link_color">
                                                <?php _e( 'Link Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_link_color" name="catcheverest_options[link_color]" size="8" value="<?php echo ( isset( $options[ 'link_color' ] ) ) ? esc_attr( $options[ 'link_color' ] ) : '#404040'; ?>"  />
                                            <div id="colorpicker_link_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                     
                                 	<tr>
                                        <th>
                                            <label for="catcheverest_widget_title_color">
                                                <?php _e( 'Sidebar Widget Title Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_widget_title_color" name="catcheverest_options[widget_title_color]" size="8" value="<?php echo ( isset( $options[ 'widget_title_color' ] ) ) ? esc_attr( $options[ 'widget_title_color' ] ) : '#404040'; ?>"  />
                                            <div id="colorpicker_widget_title_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_widget_color">
                                                <?php _e( 'Sidebar Widget Text Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_widget_color" name="catcheverest_options[widget_color]" size="8" value="<?php echo ( isset( $options[ 'widget_color' ] ) ) ? esc_attr( $options[ 'widget_color' ] ) : '#404040'; ?>"  />
                                            <div id="colorpicker_widget_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_widget_link_color">
                                                <?php _e( 'Sidebar Widget Link Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_widget_link_color" name="catcheverest_options[widget_link_color]" size="8" value="<?php echo ( isset( $options[ 'widget_link_color' ] ) ) ? esc_attr( $options[ 'widget_link_color' ] ) : '#757575'; ?>"  />
                                            <div id="colorpicker_widget_link_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_home_headline_background">
                                                <?php _e( 'Homepage Headline Background Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_home_headline_background" name="catcheverest_options[home_headline_background]" size="8" value="<?php echo ( isset( $options[ 'home_headline_background' ] ) ) ? esc_attr( $options[ 'home_headline_background' ] ) : '#fafafa'; ?>"  />
                                            <div id="colorpicker_home_headline_background" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="catcheverest_home_headline">
                                                <?php _e( 'Homepage Headline Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_home_headline" name="catcheverest_options[home_headline]" size="8" value="<?php echo ( isset( $options[ 'home_headline' ] ) ) ? esc_attr( $options[ 'home_headline' ] ) : '#404040'; ?>"  />
                                            <div id="colorpicker_home_headline" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_menu_background">
                                                <?php _e( 'Menu Background Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_menu_background" name="catcheverest_options[menu_background]" size="8" value="<?php echo ( isset( $options[ 'menu_background' ] ) ) ? esc_attr( $options[ 'menu_background' ] ) : '#3a3d41'; ?>"  />
                                            <div id="colorpicker_menu_background" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="catcheverest_menu_color">
                                                <?php _e( 'Menu Text Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_menu_color" name="catcheverest_options[menu_color]" size="8" value="<?php echo ( isset( $options[ 'menu_color' ] ) ) ? esc_attr( $options[ 'menu_color' ] ) : '#eee'; ?>"  />
                                            <div id="colorpicker_menu_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_hover_active_color">
                                                <?php _e( 'Menu Hover & Active Background Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_hover_active_color" name="catcheverest_options[hover_active_color]" size="8" value="<?php echo ( isset( $options[ 'hover_active_color' ] ) ) ? esc_attr( $options[ 'hover_active_color' ] ) : '#000'; ?>"  />
                                            <div id="colorpicker_hover_active_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="catcheverest_hover_active_text_color">
                                                <?php _e( 'Menu Hover & Active Text Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_hover_active_text_color" name="catcheverest_options[hover_active_text_color]" size="8" value="<?php echo ( isset( $options[ 'hover_active_text_color' ] ) ) ? esc_attr( $options[ 'hover_active_text_color' ] ) : '#eee'; ?>"  />
                                            <div id="colorpicker_hover_active_text_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="catcheverest_sub_menu_bg_color">
                                                <?php _e( 'Sub-Menu Background Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_sub_menu_bg_color" name="catcheverest_options[sub_menu_bg_color]" size="8" value="<?php echo ( isset( $options[ 'sub_menu_bg_color' ] ) ) ? esc_attr( $options[ 'sub_menu_bg_color' ] ) : '#222'; ?>"  />
                                            <div id="colorpicker_sub_menu_bg_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="catcheverest_sub_menu_text_color">
                                                <?php _e( 'Sub-Menu Text Color:', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <input type="text" id="catcheverest_sub_menu_text_color" name="catcheverest_options[sub_menu_text_color]" size="8" value="<?php echo ( isset( $options[ 'sub_menu_text_color' ] ) ) ? esc_attr( $options[ 'sub_menu_text_color' ] ) : '#fff'; ?>"  />
                                            <div id="colorpicker_sub_menu_text_color" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                                        </td>
                                    </tr>           
                                    
                                    
                                    <?php if( $options[ 'reset_color' ] == "1" ) { $options[ 'reset_color' ] = "0"; } ?>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Reset Color?', 'catcheverest' ); ?></th>
                                        <input type='hidden' value='0' name='catcheverest_options[reset_color]'>
                                        <td>
                                        	<input type="checkbox" id="headerlogo" name="catcheverest_options[reset_color]" value="1" <?php checked( '1', $options['reset_color'] ); ?> /> <?php _e('Check to reset', 'catcheverest'); ?>
                                       	</td>
                                    </tr>
                              </tbody>
                            </table>      
                          <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p>    
                    	</div><!-- .option-content -->
                 	</div><!-- .option-container -->     
                    
                    
					<?php
                    /**
                      * Renders the Font Family Option.
                      *
                      * @since Simple Catch Pro 1.0
                      */
					  
					  //Getting Font Available
					  $fonts = catcheverest_available_fonts();
					  
                    ?>
            		<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Font Family Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside"> 
                        	<table class="form-table">  
                                <tbody>
                                	<tr>
                                        <th>
                                            <label for="catcheverest_default_font_family">
                                                <?php _e( 'Default Font Family', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <select name="catcheverest_options[body_font]">
												<?php foreach( $fonts as $name => $family ) : ?>
                                                    <option value="<?php echo $name; ?>" <?php selected( $name, $options[ 'body_font' ] ); ?>><?php echo str_replace( '"', '', $family ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <th>
                                            <label for="catcheverest_title_font_family">
                                                <?php _e( 'Site Title Font Family', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <select name="catcheverest_options[title_font]">
												<?php foreach( $fonts as $name => $family ) : ?>
                                                    <option value="<?php echo $name; ?>" <?php selected( $name, $options[ 'title_font' ] ); ?>><?php echo str_replace( '"', '', $family ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr> 
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_tagline_font_family">
                                                <?php _e( 'Site Tagline Font Family', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <select name="catcheverest_options[tagline_font]">
												<?php foreach( $fonts as $name => $family ) : ?>
                                                    <option value="<?php echo $name; ?>" <?php selected( $name, $options[ 'tagline_font' ] ); ?>><?php echo str_replace( '"', '', $family ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr> 
                                    
                                    <tr>
                                        <th>
                                            <label for="catcheverest_content_tittle_font_family">
                                                <?php _e( 'Content Title Font Family', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <select name="catcheverest_options[content_tittle_font]">
												<?php foreach( $fonts as $name => $family ) : ?>
                                                    <option value="<?php echo $name; ?>" <?php selected( $name, $options[ 'content_tittle_font' ] ); ?>><?php echo str_replace( '"', '', $family ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="catcheverest_content_font_family">
                                                <?php _e( 'Content Body Font Family', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <select name="catcheverest_options[content_font]">
												<?php foreach( $fonts as $name => $family ) : ?>
                                                    <option value="<?php echo $name; ?>" <?php selected( $name, $options[ 'content_font' ] ); ?>><?php echo str_replace( '"', '', $family ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <th>
                                            <label for="catcheverest_headings_font_family">
                                                <?php _e( 'Headings Tags from h1 to h6 Font Family', 'catcheverest' ); ?>
                                            </label>
                                        </th>
                                        <td>
                                            <select name="catcheverest_options[headings_font]">
												<?php foreach( $fonts as $name => $family ) : ?>
                                                    <option value="<?php echo $name; ?>" <?php selected( $name, $options[ 'headings_font' ] ); ?>><?php echo str_replace( '"', '', $family ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>                                 
                               
                                    <?php if( $options[ 'reset_typography' ] == "1" ) { $options[ 'reset_typography' ] = "0"; } ?>
                                    <tr>
                                        <th scope="row"><?php _e( 'Reset Fonts?', 'catcheverest' ); ?></th>
                                            <input type='hidden' value='0' name='catcheverest_options[reset_typography]'>
                                            <td><input type="checkbox" id="reset_family" name="catcheverest_options[reset_typography]" value="1" <?php checked( '1', $options['reset_typography'] ); ?> /> <?php _e('Check to reset', 'catcheverest'); ?></td>
                                    </tr> 
                               	<tbody>                                 
                            </table>
                   			<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p>	
                    	</div><!-- .option-content -->
                 	</div><!-- .option-container -->    
                     
               
                                                        
 
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Search Text Settings', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>
                                    <tr> 
                                        <th scope="row"><label><?php _e( 'Default Display Text in Search', 'catcheverest' ); ?></label></th>
                                        <td><input type="text" size="45" name="catcheverest_options[search_display_text]" value="<?php echo esc_attr( $options[ 'search_display_text'] ); ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                   
					<div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Layout Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table content-layout">  
                                <tbody>
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Sidebar Layout Options', 'catcheverest' ); ?></label></th>
                                        <td>
                                        	<label title="right-sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/right-sidebar.png" alt="Right Sidebar" /><br />
                                            <input type="radio" name="catcheverest_options[sidebar_layout]" id="right-sidebar" <?php checked($options['sidebar_layout'], 'right-sidebar') ?> value="right-sidebar"  />
                                            <?php _e( 'Right Sidebar', 'catcheverest' ); ?>
                                            </label>  
                                            
                                            <label title="left-Sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/left-sidebar.png" alt="Left Sidebar" /><br />
                                            <input type="radio" name="catcheverest_options[sidebar_layout]" id="left-sidebar" <?php checked($options['sidebar_layout'], 'left-sidebar') ?> value="left-sidebar"  />
                                            <?php _e( 'Left Sidebar', 'catcheverest' ); ?>
                                            </label>   
                                            
                                            <label title="no-sidebar" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/no-sidebar.png" alt="No Sidebar" /><br />
                                            <input type="radio" name="catcheverest_options[sidebar_layout]" id="no-sidebar" <?php checked($options['sidebar_layout'], 'no-sidebar') ?> value="no-sidebar"  />
                                            <?php _e( 'No Sidebar', 'catcheverest' ); ?>
                                            </label>
                                            
                                            
                                            <label title="no-sidebar-full-width" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/no-sidebar-fullwidth.png" alt="No Sidebar, Full Width" /><br />
                                            <input type="radio" name="catcheverest_options[sidebar_layout]" id="no-sidebar-full-width" <?php checked($options['sidebar_layout'], 'no-sidebar-full-width') ?> value="no-sidebar-full-width"  />
                                            <?php _e( 'No Sidebar, Full Width', 'catcheverest' ); ?>
                                            </label>
                                            
                                            <label title="no-sidebar-one-column" class="box"><img src="<?php echo get_template_directory_uri(); ?>/inc/panel/images/one-column.png" alt="No Sidebar, One Column" /><br />
                                            <input type="radio" name="catcheverest_options[sidebar_layout]" id="no-sidebar-one-column" <?php checked($options['sidebar_layout'], 'no-sidebar-one-column') ?> value="no-sidebar-one-column"  />
                                            <?php _e( 'No Sidebar, One Column', 'catcheverest' ); ?>
                                            </label>                                                                                        
                                                                                  
                                        </td>
                                    </tr>  
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Content Layout', 'catcheverest' ); ?></label></th>
                                        <td>
                                        	<label title="content-full" class="box"><input type="radio" name="catcheverest_options[content_layout]" id="content-full" <?php checked($options['content_layout'], 'full') ?> value="full"  />
                                            <?php _e( 'Full Content Display', 'catcheverest' ); ?>
                                            </label>   
                                            
                                        	<label title="content-excerpt" class="box"><input type="radio" name="catcheverest_options[content_layout]" id="content-excerpt" <?php checked($options['content_layout'], 'excerpt') ?> value="excerpt"  />
                                            <?php _e( 'Excerpt/Blog Display', 'catcheverest' ); ?>
                                            </label>                                    
                                        </td>
                                    </tr>  
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Content Featured Image Size', 'catcheverest' ); ?></th>
                                        <td>
                                        	<label title="featured-image" class="box"><input type="radio" name="catcheverest_options[featured_image]" id="image-featured" <?php checked($options['featured_image'], 'featured') ?> value="featured"  />
                                            <?php _e( 'Featured Image', 'catcheverest' ); ?>
                                            </label>  
                                            
                                        	<label title="featured-image" class="box"><input type="radio" name="catcheverest_options[featured_image]" id="image-full" <?php checked($options['featured_image'], 'full') ?> value="full"  />
                                            <?php _e( 'Full Image', 'catcheverest' ); ?>
                                            </label>   
                                            
                                        	<label title="featured-image" class="box"><input type="radio" name="catcheverest_options[featured_image]" id="content-image-slider" <?php checked($options['featured_image'], 'slider') ?> value="slider"  />
                                            <?php _e( 'Slider Image', 'catcheverest' ); ?>
                                            </label>   
                                            
                                        	<label title="featured-image" class="box"><input type="radio" name="catcheverest_options[featured_image]" id="disable-image-slider" <?php checked($options['featured_image'], 'disable') ?> value="disable"  />
                                            <?php _e( 'Disable Image', 'catcheverest' ); ?>
                                            </label>
                                        </td>
                                    </tr>                                     
                                    <?php if( $options[ 'reset_layout' ] == "1" ) { $options[ 'reset_layout' ] = "0"; } ?>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Reset Layout?', 'catcheverest' ); ?></th>
                                        <input type='hidden' value='0' name='catcheverest_options[reset_layout]'>
                                        <td>
                                            <input type="checkbox" id="headerlogo" name="catcheverest_options[reset_layout]" value="1" <?php checked( '1', $options['reset_layout'] ); ?> /> <?php _e('Check to reset', 'catcheverest'); ?>
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->
                                        
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Excerpt / More Tag Settings', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>
									<tr>
                                        <th scope="row"><label><?php _e( 'More Tag Text', 'catcheverest' ); ?></label></th>
                                        <td><input type="text" size="45" name="catcheverest_options[more_tag_text]" value="<?php echo esc_attr( $options[ 'more_tag_text' ] ); ?>" />
                                        </td>
                                    </tr>  
                                     <tr>
                                        <th scope="row"><?php _e( 'Excerpt length(words)', 'catcheverest' ); ?></th>
                                        <td><input type="text" size="3" name="catcheverest_options[excerpt_length]" value="<?php echo intval( $options[ 'excerpt_length' ] ); ?>" /></td>
                                    </tr> 
                                    <?php if( $options[ 'reset_moretag' ] == "1" ) { $options[ 'reset_moretag' ] = "0"; } ?>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Reset Excerpt?', 'catcheverest' ); ?></th>
                                        <input type='hidden' value='0' name='catcheverest_options[reset_moretag]'>
                                        <td>
                                            <input type="checkbox" id="headerlogo" name="catcheverest_options[reset_moretag]" value="1" <?php checked( '1', $options['reset_moretag'] ); ?> /> <?php _e('Check to reset', 'catcheverest'); ?>
                                        </td>
                                    </tr>  
                              	</tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Feed Redirect', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>
									<tr>
                                        <th scope="row"><label><?php _e( 'Feed Redirect URL', 'catcheverest' ); ?></label></th>
                                        <td><input type="text" size="70" name="catcheverest_options[feed_url]" value="<?php echo esc_attr( $options[ 'feed_url' ] ); ?>" /> <?php _e( 'Add in the Feedburner URL', 'catcheverest' ); ?>
                                        </td>
                                    </tr>  
                               	</tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->  
                    
                 	<div class="option-container">
						<h3 class="option-toggle"><a href="#"><?php _e( 'Footer Editor Option', 'catcheverest' ); ?></a></h3>
						<div class="option-content inside">
							<table class="form-table">       	
								<tr>
									<th scope="row">
										<label for="footer-editor"><?php _e( 'Footer Editor', 'catcheverest' ); ?></label>
                                         <p>
											<small><?php _e( 'You can add custom <acronym title="Hypertext Markup Language">HTML</acronym> and/or shortcodes, which will be automatically inserted into your theme.<br />Some shorcodes: [footer-image], [the-year], [site-link], [wp-link] for current year, your site link, wordpress site link respectively.', 'catcheverest' ); ?></small>
										</p>
									</th>
									<td>
										<?php 
                                 		wp_editor( esc_textarea( $options[ 'footer_code' ] ), // Editor content.
                                        	'catcheverest_options[footer_code]', // Editor ID.
                                         	array(
                                            	'wpautop'				=> false,
                                            	'tinymce' 				=> false,  // Don't use TinyMCE in a meta box.
                                             	'media_buttons'			=> false,  // Don't show upload botton  
                                             	'textarea_rows'			=> 2
                                        	)
                                     	); ?>
									</td>
								</tr>  
                                <?php if( $options[ 'reset_footer' ] == "1" ) { $options[ 'reset_footer' ] = "0"; } ?>
                                <tr>                            
                                    <th scope="row"><?php _e( 'Reset Footer?', 'catcheverest' ); ?></th>
                                    <input type='hidden' value='0' name='catcheverest_options[reset_footer]'>
                                    <td>
                                        <input type="checkbox" id="headerlogo" name="catcheverest_options[reset_footer]" value="1" <?php checked( '1', $options['reset_footer'] ); ?> /> <?php _e('Check to reset', 'catcheverest'); ?>
                                    </td>
                                </tr>                           
							</table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
						</div><!-- .option-content -->
          			</div><!-- .option-container -->       
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Custom CSS', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside"> 
                            <table class="form-table">  
                                <tbody>       
                                    <tr>
                                        <th scope="row"><?php _e( 'Enter your custom CSS styles.', 'catcheverest' ); ?></th>
                                        <td>
                                            <textarea name="catcheverest_options[custom_css]" id="custom-css" cols="90" rows="12"><?php echo esc_attr( $options[ 'custom_css' ] ); ?></textarea>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <th scope="row"><?php _e( 'CSS Tutorial from W3Schools.', 'catcheverest' ); ?></th>
                                        <td>
                                            <a class="button" href="<?php echo esc_url( __( 'http://www.w3schools.com/css/default.asp','catcheverest' ) ); ?>" title="<?php esc_attr_e( 'CSS Tutorial', 'catcheverest' ); ?>" target="_blank"><?php _e( 'Click Here to Read', 'catcheverest' );?></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                                       
                </div><!-- #themeoptions -->  

				<!-- Options for Homepage Settings -->
                <div id="homepagesettings">                    
                
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Homepage Headline Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php _e( 'Homepage Headline', 'catcheverest' ); ?>
                                            <p><small><?php _e( 'The appropriate length for Headine is around 10 words.', 'catcheverest' ); ?></small></p>
                                        </th>
                                        <td>
	                                        <textarea class="textarea input-bg" name="catcheverest_options[homepage_headline]" cols="65" rows="3"><?php echo esc_textarea( $options[ 'homepage_headline' ] ); ?></textarea>
	                                    </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Homepage Subheadline Headline', 'catcheverest' ); ?>
                                            <p><small><?php _e( 'The appropriate length for Headine is around 10 words.', 'catcheverest' ); ?></small></p>
                                        </th>
                                        <td>
	                                        <textarea class="textarea input-bg" name="catcheverest_options[homepage_subheadline]" cols="65" rows="3"><?php echo esc_textarea( $options[ 'homepage_subheadline' ] ); ?></textarea>
	                                    </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Disable Homepage Headline?', 'catcheverest' ); ?></th>
                                        <input type='hidden' value='0' name='catcheverest_options[disable_homepage_headline]'>
                                        <td><input type="checkbox" id="favicon" name="catcheverest_options[disable_homepage_headline]" value="1" <?php checked( '1', $options['disable_homepage_headline'] ); ?> /> <?php _e( 'Check to disable', 'catcheverest'); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Disable Homepage Subheadline?', 'catcheverest' ); ?></th>
                                        <input type='hidden' value='0' name='catcheverest_options[disable_homepage_subheadline]'>
                                        <td><input type="checkbox" id="favicon" name="catcheverest_options[disable_homepage_subheadline]" value="1" <?php checked( '1', $options['disable_homepage_subheadline'] ); ?> /> <?php _e( 'Check to disable', 'catcheverest'); ?></td>
                                    </tr>  
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p>
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->   
                    
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Homepage Featured Content Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody>
                                	<tr>
                                        <th scope="row"><?php _e( 'Disable Homepage Featured Content?', 'catcheverest' ); ?></th>
                                        <input type='hidden' value='0' name='catcheverest_options[disable_homepage_featured]'>
                                        <td><input type="checkbox" id="favicon" name="catcheverest_options[disable_homepage_featured]" value="1" <?php checked( '1', $options['disable_homepage_featured'] ); ?> /> <?php _e( 'Check to disable', 'catcheverest'); ?></td>
                                    </tr>  
                                    <tr>
                                        <th scope="row">
											<?php _e( 'Headline', 'catcheverest' ); ?>
                                        </th>
                                        <td>
                                        	<input type="text" size="65" name="catcheverest_options[homepage_featured_headline]" value="<?php echo esc_attr( $options[ 'homepage_featured_headline' ] ); ?>" /> <?php _e( 'Leave empty if you want to remove headline', 'catcheverest' ); ?>
	                                    </td>
                                    </tr>
                                    <tr>
                                    	<th scope="row"><?php _e( 'Number of Featured Content', 'catcheverest' ); ?></th>
                                    	<td>
                                        	<input type="text" size="2" name="catcheverest_options[homepage_featured_qty]" value="<?php echo intval( $options[ 'homepage_featured_qty' ] ); ?>" size="2" />
                                        </td>
                                	</tr>
                                    <tr>
                                    	<th scope="row"><?php _e( 'Featured Content Layout', 'catcheverest' ); ?></th>
                                        <td>
                                        <label title="three-columns" class="box">
                                        <input type="radio" name="catcheverest_options[homepage_featured_layout]" id="three-columns" <?php checked($options['homepage_featured_layout'], 'three-columns') ?> value="three-columns"  />
                                        <?php _e( '3 Columns', 'catcheverest' ); ?>
                                        </label>
                                        
                                        <label title="four-columns" class="box">
                                        <input type="radio" name="catcheverest_options[homepage_featured_layout]" id="four-columns" <?php checked($options['homepage_featured_layout'], 'page-slider') ?> value="four-columns"  />
                                        <?php _e( '4 Columns', 'catcheverest' ); ?>
                                        </label>
                                        </td>
                                	</tr>
                                    <?php for ( $i = 1; $i <= $options[ 'homepage_featured_qty' ]; $i++ ): ?> 
                                    <tr>
                                    	<th scope="row">
											<strong><?php printf( esc_attr__( 'Featured Content #%s', 'catcheverest' ), $i ); ?></strong>
                                        </th>
                                   	</tr>
                                    <tr>
                                        <th scope="row">
											<?php _e( 'Image', 'catcheverest' ); ?>
                                        </th>
                                        <td>
                                        	<input class="upload-url" size="65" type="text" name="catcheverest_options[homepage_featured_image][<?php echo $i; ?>]" value="<?php if( array_key_exists( 'homepage_featured_image', $options ) && array_key_exists( $i, $options[ 'homepage_featured_image' ] ) ) echo esc_url( $options[ 'homepage_featured_image' ][ $i ] ); ?>" />
                                            <input id="st_upload_button" class="st_upload_button button" name="wsl-image-add" type="button" value="<?php if( array_key_exists( 'homepage_featured_image', $options ) && array_key_exists( $i, $options[ 'homepage_featured_image' ] ) ) { esc_attr_e( 'Change Image','catcheverest' ); } else { esc_attr_e( 'Add Image','catcheverest' ); } ?>" />  
                                      	</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Link URL', 'catcheverest' ); ?></label></th>
                                        <td><input type="text" size="65" name="catcheverest_options[homepage_featured_url][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'homepage_featured_url', $options ) && array_key_exists( $i, $options[ 'homepage_featured_url' ] ) ) echo esc_url( $options[ 'homepage_featured_url' ][ $i ] ); ?>" /> <?php _e( 'Add in the Target URL for the content', 'catcheverest' ); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Target. Open Link in New Window?', 'catcheverest' ); ?></label></th>
                                        <input type='hidden' value='0' name='catcheverest_options[homepage_featured_base][<?php echo absint( $i ); ?>]'> 
                                        <td><input type="checkbox" name="catcheverest_options[homepage_featured_base][<?php echo absint( $i ); ?>]" value="1" <?php if( array_key_exists( 'homepage_featured_base', $options ) && array_key_exists( $i, $options[ 'homepage_featured_base' ] ) ) checked( '1', $options[ 'homepage_featured_base' ][ $i ] ); ?> /> <?php _e( 'Check to open in new window', 'catcheverest' ); ?>
                                        </td>
                                    </tr>     
                                    <tr>
                                        <th scope="row">
											<?php _e( 'Title', 'catcheverest' ); ?>
                                        </th>
                                        <td>
                                        	<input type="text" size="65" name="catcheverest_options[homepage_featured_title][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'homepage_featured_title', $options ) && array_key_exists( $i, $options[ 'homepage_featured_title' ] ) ) echo esc_attr( $options[ 'homepage_featured_title' ][ $i ] ); ?>" /> <?php _e( 'Leave empty if you want to remove title', 'catcheverest' ); ?>
	                                    </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Content', 'catcheverest' ); ?>
                                            <p><small><?php _e( 'The appropriate length for Content is around 10 words.', 'catcheverest' ); ?></small></p>
                                        </th>
                                        <td>
	                                        <textarea class="textarea input-bg" name="catcheverest_options[homepage_featured_content][<?php echo absint( $i ); ?>]" cols="80" rows="3"><?php if( array_key_exists( 'homepage_featured_content', $options ) && array_key_exists( $i, $options[ 'homepage_featured_content' ] ) ) echo esc_html( $options[ 'homepage_featured_content' ][ $i ] ); ?></textarea>
	                                    </td>
                                    </tr>
                                    <?php endfor; ?>    
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p>
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->                                     
                
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Homepage / Frontpage Settings', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody>
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Enable Latest Posts or Page?', 'catcheverest' ); ?></th>
                                        <input type='hidden' value='0' name='catcheverest_options[enable_posts_home]'>
                                        <td><input type="checkbox" id="headerlogo" name="catcheverest_options[enable_posts_home]" value="1" <?php checked( '1', $options['enable_posts_home'] ); ?> /> <?php _e( 'Check to Enable', 'catcheverest'); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Add Page instead of Latest Posts', 'catcheverest' ); ?></th>
                                        <td><a class="button" href="<?php echo esc_url( admin_url( 'options-reading.php' ) ) ; ?>" title="<?php esc_attr_e( 'Click Here to Set Static Front Page Instead of Latest Posts', 'catcheverest' ); ?>" target="_blank"><?php _e( 'Click Here to Set Static Front Page Instead of Latest Posts', 'catcheverest' );?></a></td>
                                    </tr>                                
                                    <tr>
                                        <th scope="row">
                                            <?php _e( 'Homepage posts categories:', 'catcheverest' ); ?>
                                            <p>
                                                <small><?php _e( 'Only posts that belong to the categories selected here will be displayed on the front page.', 'catcheverest' ); ?></small>
                                            </p>
                                        </th>
                                        <td>
                                            <select name="catcheverest_options[front_page_category][]" id="frontpage_posts_cats" multiple="multiple" class="select-multiple">
                                                <option value="0" <?php if ( empty( $options['front_page_category'] ) ) { echo 'selected="selected"'; } ?>><?php _e( '--Disabled--', 'catcheverest' ); ?></option>
                                                <?php /* Get the list of categories */  
                                                    $categories = get_categories();
                                                    if( empty( $options[ 'front_page_category' ] ) ) {
                                                        $options[ 'front_page_category' ] = array();
                                                    }
                                                    foreach ( $categories as $category) :
                                                ?>
                                                <option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID, $options['front_page_category'] ) ) {echo 'selected="selected"';}?>><?php echo $category->cat_name; ?></option>
                                                <?php endforeach; ?>
                                            </select><br />
                                            <span class="description"><?php _e( 'You may select multiple categories by holding down the CTRL key.', 'catcheverest' ); ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                  	</div><!-- .option-container --> 
                                  
            	</div><!-- #homepagesettings -->       
                
                <!-- Options for Slider Settings -->
                <div id="slidersettings">
           			<div class="option-container">
                		<h3 class="option-toggle"><a href="#"><?php _e( 'Slider Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tr>
                                    <th scope="row"><label><?php _e( 'Select Slider Type', 'catcheverest' ); ?></label></th>
                                    <td>
                                        <label title="post-slider" class="box">
                                        <input type="radio" name="catcheverest_options[select_slider_type]" id="post-slider" <?php checked($options['select_slider_type'], 'post-slider') ?> value="post-slider"  />
                                        <?php _e( 'Post Slider', 'catcheverest' ); ?>
                                        </label>
                                        
                                        <label title="page-slider" class="box">
                                        <input type="radio" name="catcheverest_options[select_slider_type]" id="page-slider" <?php checked($options['select_slider_type'], 'page-slider') ?> value="page-slider"  />
                                        <?php _e( 'Page Slider', 'catcheverest' ); ?>
                                        </label>
                                        
                                        <label title="category-slider" class="box">
                                        <input type="radio" name="catcheverest_options[select_slider_type]" id="category-slider" <?php checked($options['select_slider_type'], 'category-slider') ?> value="category-slider"  />
                                        <?php _e( 'Category Slider', 'catcheverest' ); ?>
                                        </label>
                                        
                                        <label title="image-slider" class="box">
                                        <input type="radio" name="catcheverest_options[select_slider_type]" id="image-slider" <?php checked($options['select_slider_type'], 'image-slider') ?> value="image-slider"  />
                                        <?php _e( 'Image Slider', 'catcheverest' ); ?>
                                        </label>
                                    </td>
                                </tr>                            
                            
                                <tr>
                                    <th scope="row"><label><?php _e( 'Enable Slider', 'catcheverest' ); ?></label></th>
                                    <td>
                                        <label title="enable-slider-homepager" class="box">
                                        <input type="radio" name="catcheverest_options[enable_slider]" id="enable-slider-homepage" <?php checked($options['enable_slider'], 'enable-slider-homepage') ?> value="enable-slider-homepage"  />
                                        <?php _e( 'Homepage', 'catcheverest' ); ?>
                                        </label>
                                        <label title="enable-slider-allpage" class="box">
                                        <input type="radio" name="catcheverest_options[enable_slider]" id="enable-slider-allpage" <?php checked($options['enable_slider'], 'enable-slider-allpage') ?> value="enable-slider-allpage"  />
                                         <?php _e( 'Entire Site', 'catcheverest' ); ?>
                                        </label>
                                        <label title="disable-slider" class="box">
                                        <input type="radio" name="catcheverest_options[enable_slider]" id="disable-slider" <?php checked($options['enable_slider'], 'disable-slider') ?> value="disable-slider"  />
                                         <?php _e( 'Disable', 'catcheverest' ); ?>
                                        </label>                                
                                    </td>
                                </tr>                        
                                <tr>
                                    <th scope="row"><?php _e( 'Number of Slides', 'catcheverest' ); ?></th>
                                    <td><input type="text" name="catcheverest_options[slider_qty]" value="<?php echo intval( $options[ 'slider_qty' ] ); ?>" size="2" /></td>
                                </tr> 
                                <tr>
                                    <th>
                                        <label for="catcheverest_cycle_style"><?php _e( 'Transition Effect:', 'catcheverest' ); ?></label>
                                    </th>
                                    <td>
                                        <select id="catcheverest_cycle_style" name="catcheverest_options[transition_effect]">
                                            <option value="fade" <?php selected('fade', $options['transition_effect']); ?>><?php _e( 'fade', 'catcheverest' ); ?></option>
                                            <option value="wipe" <?php selected('wipe', $options['transition_effect']); ?>><?php _e( 'wipe', 'catcheverest' ); ?></option>
                                            <option value="scrollUp" <?php selected('scrollUp', $options['transition_effect']); ?>><?php _e( 'scrollUp', 'catcheverest' ); ?></option>
                                            <option value="scrollDown" <?php selected('scrollDown', $options['transition_effect']); ?>><?php _e( 'scrollDown', 'catcheverest' ); ?></option>
                                            <option value="scrollLeft" <?php selected('scrollLeft', $options['transition_effect']); ?>><?php _e( 'scrollLeft', 'catcheverest' ); ?></option>
                                            <option value="scrollRight" <?php selected('scrollRight', $options['transition_effect']); ?>><?php _e( 'scrollRight', 'catcheverest' ); ?></option>
                                            <option value="blindX" <?php selected('blindX', $options['transition_effect']); ?>><?php _e( 'blindX', 'catcheverest' ); ?></option>
                                            <option value="blindY" <?php selected('blindY', $options['transition_effect']); ?>><?php _e( 'blindY', 'catcheverest' ); ?></option>
                                            <option value="blindZ" <?php selected('blindZ', $options['transition_effect']); ?>><?php _e( 'blindZ', 'catcheverest' ); ?></option>
                                            <option value="cover" <?php selected('cover', $options['transition_effect']); ?>><?php _e( 'cover', 'catcheverest' ); ?></option>
                                            <option value="shuffle" <?php selected('shuffle', $options['transition_effect']); ?>><?php _e( 'shuffle', 'catcheverest' ); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e( 'Transition Delay', 'catcheverest' ); ?></th>
                                    <td>
                                        <input type="text" name="catcheverest_options[transition_delay]" value="<?php echo $options[ 'transition_delay' ]; ?>" size="2" />
                                       <span class="description"><?php _e( 'second(s)', 'catcheverest' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e( 'Transition Length', 'catcheverest' ); ?></th>
                                    <td>
                                        <input type="text" name="catcheverest_options[transition_duration]" value="<?php echo $options[ 'transition_duration' ]; ?>" size="2" />
                                        <span class="description"><?php _e( 'second(s)', 'catcheverest' ); ?></span>
                                    </td>
                                </tr>                      
        
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
            		</div><!-- .option-container --> 
              
            
            		<div class="option-container post-slider">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Featured Post Slider Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tr>                            
                                    <th scope="row"><?php _e( 'Exclude Slider post from Homepage posts?', 'catcheverest' ); ?></th>
                                     <input type='hidden' value='0' name='catcheverest_options[exclude_slider_post]'>
                                    <td><input type="checkbox" id="headerlogo" name="catcheverest_options[exclude_slider_post]" value="1" <?php checked( '1', $options['exclude_slider_post'] ); ?> /> <?php _e('Check to exclude', 'catcheverest'); ?></td>
                                </tr>
                                <tbody class="sortable">
                                    <?php for ( $i = 1; $i <= $options[ 'slider_qty' ]; $i++ ): ?>
                                    <tr>
                                        <th scope="row"><label class="handle"><?php _e( 'Featured Slider Post #', 'catcheverest' ); ?><span class="count"><?php echo absint( $i ); ?></span></label></th>
                                        <td><input type="text" name="catcheverest_options[featured_slider][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'featured_slider', $options ) && array_key_exists( $i, $options[ 'featured_slider' ] ) ) echo absint( $options[ 'featured_slider' ][ $i ] ); ?>" />
                                        <a href="<?php bloginfo ( 'url' );?>/wp-admin/post.php?post=<?php if( array_key_exists ( 'featured_slider', $options ) && array_key_exists ( $i, $options[ 'featured_slider' ] ) ) echo absint( $options[ 'featured_slider' ][ $i ] ); ?>&action=edit" class="button" title="<?php esc_attr_e('Click Here To Edit'); ?>" target="_blank"><?php _e( 'Click Here To Edit', 'catcheverest' ); ?></a>
                                        </td>
                                    </tr>                           
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                            <p><?php _e( 'Note: Here You can put your Post IDs which displays on Homepage as slider.', 'catcheverest' ); ?> </p>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                    
            		<div class="option-container page-slider">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Featured Page Slider Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">
                                <tbody class="sortable">
                                    <?php for ( $i = 1; $i <= $options[ 'slider_qty' ]; $i++ ): ?>
                                    <tr>
                                        <th scope="row"><label class="handle"><?php _e( 'Featured Slider Page #', 'catcheverest' ); ?><span class="count"><?php echo absint( $i ); ?></span></label></th>
                                        <td><input type="text" name="catcheverest_options[featured_slider_page][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'featured_slider_page', $options ) && array_key_exists( $i, $options[ 'featured_slider_page' ] ) ) echo absint( $options[ 'featured_slider_page' ][ $i ] ); ?>" />
                                        <a href="<?php bloginfo ( 'url' );?>/wp-admin/post.php?post=<?php if( array_key_exists ( 'featured_slider_page', $options ) && array_key_exists ( $i, $options[ 'featured_slider_page' ] ) ) echo absint( $options[ 'featured_slider_page' ][ $i ] ); ?>&action=edit" class="button" title="<?php esc_attr_e('Click Here To Edit'); ?>" target="_blank"><?php _e( 'Click Here To Edit', 'catcheverest' ); ?></a>
                                        </td>
                                    </tr>                           
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                            <p><?php _e( 'Note: Here You can put your Page IDs which displays on Homepage as slider.', 'catcheverest' ); ?> </p>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->   
                    
                    <div class="option-container category-slider">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Featured Category Slider Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>     	
                                    <tr>
                                        <th scope="row">
                                            <label for="layouts"><?php _e( 'Select Slider Categories', 'catcheverest' ); ?></label>
                                            <p><small><?php _e( 'Use this only is you want to display posts from Specific Categories in Featured Slider', 'catcheverest' ); ?></small></p>
                                        </th> 
                                        <td>
                                            <select name="catcheverest_options[slider_category][]" id="frontpage_posts_cats" multiple="multiple" class="select-multiple">
                                                <option value="0" <?php if ( empty( $options['slider_category'] ) ) { selected( true, true ); } ?>><?php _e( '--Disabled--', 'catcheverest' ); ?></option>
                                                <?php /* Get the list of categories */ 
                                                    if( empty( $options[ 'slider_category' ] ) ) {
                                                        $options[ 'slider_category' ] = array();
                                                    }
                                                    $categories = get_categories();
                                                    foreach ( $categories as $category) :
                                                ?>
                                                <option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID, $options['slider_category'] ) ) {echo 'selected="selected"';}?>><?php echo $category->cat_name; ?></option>
                                                <?php endforeach; ?>
                                            </select><br />
                                            <span class="description"><?php _e( 'You may select multiple categories by holding down the CTRL key.', 'catcheverest' ); ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p><?php _e( 'Note: Here you can select the categories from which latest posts will display on Featured Slider.', 'catcheverest' ); ?> </p>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                	</div><!-- .option-container -->                       
                    
            		<div class="option-container image-slider">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Featured Image Slider Options', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <div id="featured-image-slider">
                                <?php for ( $i = 1; $i <= $options[ 'slider_qty' ]; $i++ ): ?>
                                    <div class="slides slides-<?php echo $i; ?>"> 
                                        <h3>Featued Slide #<?php echo $i; ?></h3>      	
                                        <div class="row">
                                            <div class="col col1">
                                                Image
                                            </div>
                                            <div class="col col2">
                                                <input size="90" type="text" class="upload-url" name="catcheverest_options[featured_image_slider_image][<?php echo $i; ?>]" value="<?php if( array_key_exists( 'featured_image_slider_image', $options ) && array_key_exists( $i, $options[ 'featured_image_slider_image' ] ) ) echo esc_url( $options[ 'featured_image_slider_image' ][ $i ] ); ?>" />
                                                <input id="st_upload_button" class="st_upload_button button" name="upload_button" type="button" value="<?php esc_attr_e( 'Upload','catcheverest' ); ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col1">
                                                Link
                                            </div>
                                            <div class="col col2">
                                                <input size="90" type="text" name="catcheverest_options[featured_image_slider_link][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'featured_image_slider_link', $options ) && array_key_exists( $i, $options[ 'featured_image_slider_link' ] ) ) echo esc_url( $options[ 'featured_image_slider_link' ][ $i ] ); ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col1">
                                                <?php _e( 'Target. Open Link in New Window?', 'catcheverest' ); ?>
                                                <input type='hidden' value='0' name='catcheverest_options[featured_image_slider_base][<?php echo absint( $i ); ?>]'> 
                                            </div>
                                            <div class="col col2">
                                                <input type="checkbox" name="catcheverest_options[featured_image_slider_base][<?php echo absint( $i ); ?>]" value="1" <?php if( array_key_exists( 'featured_image_slider_base', $options ) && array_key_exists( $i, $options[ 'featured_image_slider_base' ] ) ) checked( '1', $options[ 'featured_image_slider_base' ][ $i ] ); ?> /> <?php _e( 'Check to open in new window', 'catcheverest' ); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col1">
                                                Title
                                            </div>
                                            <div class="col col2">
                                                <input size="90" type="text" name="catcheverest_options[featured_image_slider_title][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'featured_image_slider_title', $options ) && array_key_exists( $i, $options[ 'featured_image_slider_title' ] ) ) echo esc_attr( $options[ 'featured_image_slider_title' ][ $i ] ); ?>" />
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col col1">
                                                Content
                                            </div>
                                            <div class="col col2"><textarea name="catcheverest_options[featured_image_slider_content][<?php echo absint( $i ); ?>]" cols="100" rows="3"><?php if( array_key_exists( 'featured_image_slider_content', $options ) && array_key_exists( $i, $options[ 'featured_image_slider_content' ] ) ) echo esc_html( $options[ 'featured_image_slider_content' ][ $i ] ); ?></textarea></div>
                                        </div> 
                                        <div class="clear"></div> 
                                    </div> <!-- .slides -->
                                <?php endfor; ?>
                            </div> <!-- .featured-image-slider -->
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                                   
				</div><!-- #slidersettings -->
                
  
                <!-- Options for Social Links -->
                <div id="sociallinks">
                	<div class="option-container">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Facebook', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_facebook]" value="<?php echo esc_url( $options[ 'social_facebook' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Twitter', 'catcheverest' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_twitter]" value="<?php echo esc_url( $options[ 'social_twitter'] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Google+', 'catcheverest' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_googleplus]" value="<?php echo esc_url( $options[ 'social_googleplus'] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Pinterest', 'catcheverest' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_pinterest]" value="<?php echo esc_url( $options[ 'social_pinterest'] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Youtube', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_youtube]" value="<?php echo esc_url( $options[ 'social_youtube' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Vimeo', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_vimeo]" value="<?php echo esc_url( $options[ 'social_vimeo' ] ); ?>" />
                                    </td>
                                </tr>
                                
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Linkedin', 'catcheverest' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_linkedin]" value="<?php echo esc_url( $options[ 'social_linkedin'] ); ?>" />
                                    </td>
                                </tr>
                                <tr> 
                                    <th scope="row"><h4><?php _e( 'Slideshare', 'catcheverest' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_slideshare]" value="<?php echo esc_url( $options[ 'social_slideshare'] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Foursquare', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_foursquare]" value="<?php echo esc_url( $options[ 'social_foursquare' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Flickr', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_flickr]" value="<?php echo esc_url( $options[ 'social_flickr' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Tumblr', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_tumblr]" value="<?php echo esc_url( $options[ 'social_tumblr' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'deviantART', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_deviantart]" value="<?php echo esc_url( $options[ 'social_deviantart' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Dribbble', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_dribbble]" value="<?php echo esc_url( $options[ 'social_dribbble' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'MySpace', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_myspace]" value="<?php echo esc_url( $options[ 'social_myspace' ] ); ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <th scope="row"><h4><?php _e( 'WordPress', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_wordpress]" value="<?php echo esc_url( $options[ 'social_wordpress' ] ); ?>" />
                                    </td>
                                </tr>                           
                                <tr>
                                    <th scope="row"><h4><?php _e( 'RSS', 'catcheverest' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_rss]" value="<?php echo esc_url( $options[ 'social_rss' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Delicious', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_delicious]" value="<?php echo esc_url( $options[ 'social_delicious' ] ); ?>" />
                                    </td>
                                </tr>                           
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Last.fm', 'catcheverest' ); ?> </h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_lastfm]" value="<?php echo esc_url( $options[ 'social_lastfm' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'Instagram', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_instagram]" value="<?php echo esc_url( $options[ 'social_instagram' ] ); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><h4><?php _e( 'GitHub', 'catcheverest' ); ?></h4></th>
                                    <td><input type="text" size="45" name="catcheverest_options[social_github]" value="<?php echo esc_url( $options[ 'social_github' ] ); ?>" />
                                    </td>
                                </tr> 
                            </tbody>
                        </table>                           
            			<p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p>                    
                    </div><!-- .option-container -->
                </div><!-- #sociallinks -->
                
                
                <!-- Options for Webmaster Tools -->
                <div id="webmaster">
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Site Verification', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Google Site Verification ID', 'catcheverest' ); ?></label></th>
                                        <td><input type="text" size="45" name="catcheverest_options[google_verification]" value="<?php echo esc_attr( $options[ 'google_verification' ] ); ?>" /> <?php _e('Enter your Google ID number only', 'catcheverest'); ?>
                                        </td>
                                    </tr>
                                    
                                    <tr> 
                                        <th scope="row"><label><?php _e( 'Yahoo Site Verification ID', 'catcheverest' ); ?></label></th>
                                        <td><input type="text" size="45" name="catcheverest_options[yahoo_verification]" value="<?php echo esc_attr( $options[ 'yahoo_verification'] ); ?>" /> <?php _e('Enter your Yahoo ID number only', 'catcheverest'); ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Bing Site Verification ID', 'catcheverest' ); ?></label></th>
                                        <td><input type="text" size="45" name="catcheverest_options[bing_verification]" value="<?php echo esc_attr( $options[ 'bing_verification' ] ); ?>" /> <?php _e('Enter your Bing ID number only', 'catcheverest'); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container --> 
                
                    <div class="option-container">
                        <h3 class="option-toggle"><a href="#"><?php _e( 'Header and Footer Codes', 'catcheverest' ); ?></a></h3>
                        <div class="option-content inside">
                            <table class="form-table">  
                                <tbody>       
                                    <tr>
                                        <th scope="row"><?php _e( 'Code to display on Header', 'catcheverest' ); ?></th>
                                        <td>
                                        <textarea name="catcheverest_options[analytic_header]" id="analytics" rows="7" cols="80" ><?php echo esc_html( $options[ 'analytic_header' ] ); ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td><td><?php _e('Note: Note: Here you can put scripts from Google, Facebook, Twitter, Add This etc. which will load on Header', 'catcheverest' ); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e('Code to display on Footer', 'catcheverest' ); ?></th>
                                        <td>
                                         <textarea name="catcheverest_options[analytic_footer]" id="analytics" rows="7" cols="80" ><?php echo esc_html( $options[ 'analytic_footer' ] ); ?></textarea>
                             
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td><td><?php _e( 'Note: Here you can put scripts from Google, Facebook, Twitter, Add This etc. which will load on footer', 'catcheverest' ); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'catcheverest' ); ?>" /></p> 
                        </div><!-- .option-content -->
                    </div><!-- .option-container -->  
                </div><!-- #webmaster -->

            </div><!-- #catcheverest_ad_tabs -->
		</form>
	</div><!-- .wrap -->
<?php
}


/**
 * Validate content options
 * @param array $options
 * @uses esc_url_raw, absint, esc_textarea, sanitize_text_field, catcheverest_invalidate_caches
 * @return array
 */
function catcheverest_theme_options_validate( $options ) {
	global $catcheverest_options_settings, $catcheverest_options_defaults;
    $input_validated = $catcheverest_options_settings;	
	
	$defaults = $catcheverest_options_defaults;
	
	$fonts = catcheverest_available_fonts();
	
    $input = array();
    $input = $options;
	
	// Data Validation for Resonsive Design	
	if ( isset( $input['disable_responsive'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'disable_responsive' ] = $input[ 'disable_responsive' ];
	}
	
	// Data Validation for Header Sidebar	
	if ( isset( $input[ 'disable_header_right_sidebar' ] ) ) {
		$input_validated[ 'disable_header_right_sidebar' ] = $input[ 'disable_header_right_sidebar' ];
	}	
	
	// Data validation for Move Site Title above Header Image
	if ( isset( $input['site_title_above'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'site_title_above' ] = $input[ 'site_title_above' ];
	}
	// Data validation for Large Header Image
	if ( isset( $input[ 'featured_header_image' ] ) ) {
		$input_validated[ 'featured_header_image' ] = esc_url_raw( $input[ 'featured_header_image' ] ) ? $input [ 'featured_header_image' ] : $defaults[ 'featured_header_image' ];
	}	
	if ( isset( $input[ 'featured_header_image_alt' ] ) ) {
		$input_validated[ 'featured_header_image_alt' ] = sanitize_text_field( $input[ 'featured_header_image_alt' ] );
	}	
	if ( isset( $input[ 'featured_header_image_url' ] ) ) {
		$input_validated[ 'featured_header_image_url' ] = esc_url_raw( $input[ 'featured_header_image_url' ] );
	}	
	if ( isset( $input['featured_header_image_base'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'featured_header_image_base' ] = $input[ 'featured_header_image_base' ];
	}	
	
	if ( isset( $input[ 'featured_header_image_position' ] ) ) {
		$input_validated[ 'featured_header_image_position' ] = $input[ 'featured_header_image_position' ];
	}	
	if ( isset( $input[ 'enable_featured_header_image' ] ) ) {
		$input_validated[ 'enable_featured_header_image' ] = $input[ 'enable_featured_header_image' ];
	}		
	
	// Data Validation for Favicon		
	if ( isset( $input[ 'fav_icon' ] ) ) {
		$input_validated[ 'fav_icon' ] = esc_url_raw( $input[ 'fav_icon' ] );
	}
	if ( isset( $input['remove_favicon'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'remove_favicon' ] = $input[ 'remove_favicon' ];
	}
	
	// data validation for Color Scheme
	if ( isset( $input['color_scheme'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'color_scheme' ] = $input[ 'color_scheme' ];
	}	
	
	// data validation for Color Options
	if( isset( $input[ 'header_background' ] ) ) {
		$input_validated[ 'header_background' ] = wp_filter_nohtml_kses( $input[ 'header_background' ] );
	}
	if( isset( $input[ 'content_background' ] ) ) {
		$input_validated[ 'content_background' ] = wp_filter_nohtml_kses( $input[ 'content_background' ] );
	}
	if( isset( $input[ 'footer_sidebar_background' ] ) ) {
		$input_validated[ 'footer_sidebar_background' ] = wp_filter_nohtml_kses( $input[ 'footer_sidebar_background' ] );
	}
	if( isset( $input[ 'footer_background' ] ) ) {
		$input_validated[ 'footer_background' ] = wp_filter_nohtml_kses( $input[ 'footer_background' ] );
	}	
	if( isset( $input[ 'title_color' ] ) ) {
		$input_validated[ 'title_color' ] = wp_filter_nohtml_kses( $input[ 'title_color' ] );
	}
	if( isset( $input[ 'title_hover_color' ] ) ) {
		$input_validated[ 'title_hover_color' ] = wp_filter_nohtml_kses( $input[ 'title_hover_color' ] );
	}
	if( isset( $input[ 'meta_color' ] ) ) {
		$input_validated[ 'meta_color' ] = wp_filter_nohtml_kses( $input[ 'meta_color' ] );
	}
	if( isset( $input[ 'text_color' ] ) ) {
		$input_validated[ 'text_color' ] = wp_filter_nohtml_kses( $input[ 'text_color' ] );
	}
	if( isset( $input[ 'link_color' ] ) ) {
		$input_validated[ 'link_color' ] = wp_filter_nohtml_kses( $input[ 'link_color' ] );
	}
	if( isset( $input[ 'widget_title_color' ] ) ) {
		$input_validated[ 'widget_title_color' ] = wp_filter_nohtml_kses( $input[ 'widget_title_color' ] );
	}	
	if( isset( $input[ 'widget_color' ] ) ) {
		$input_validated[ 'widget_color' ] = wp_filter_nohtml_kses( $input[ 'widget_color' ] );
	}	
	if( isset( $input[ 'widget_link_color' ] ) ) {
		$input_validated[ 'widget_link_color' ] = wp_filter_nohtml_kses( $input[ 'widget_link_color' ] );
	}		
	if( isset( $input[ 'home_headline_background' ] ) ) {
		$input_validated[ 'home_headline_background' ] = wp_filter_nohtml_kses( $input[ 'home_headline_background' ] );
	}	
	if( isset( $input[ 'home_headline' ] ) ) {
		$input_validated[ 'home_headline' ] = wp_filter_nohtml_kses( $input[ 'home_headline' ] );
	}	
	if( isset( $input[ 'menu_background' ] ) ) {
		$input_validated[ 'menu_background' ] = wp_filter_nohtml_kses( $input[ 'menu_background' ] );
	}	
	if( isset( $input[ 'menu_color' ] ) ) {
		$input_validated[ 'menu_color' ] = wp_filter_nohtml_kses( $input[ 'menu_color' ] );
	}	
	if( isset( $input[ 'hover_active_color' ] ) ) {
		$input_validated[ 'hover_active_color' ] = wp_filter_nohtml_kses( $input[ 'hover_active_color' ] );
	}		
	if( isset( $input[ 'hover_active_text_color' ] ) ) {
		$input_validated[ 'hover_active_text_color' ] = wp_filter_nohtml_kses( $input[ 'hover_active_text_color' ] );
	}	
	if( isset( $input[ 'sub_menu_bg_color' ] ) ) {
		$input_validated[ 'sub_menu_bg_color' ] = wp_filter_nohtml_kses( $input[ 'sub_menu_bg_color' ] );
	}	
	if( isset( $input[ 'sub_menu_text_color' ] ) ) {
		$input_validated[ 'sub_menu_text_color' ] = wp_filter_nohtml_kses( $input[ 'sub_menu_text_color' ] );
	}		
	
	if ( isset( $input['reset_color'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_color' ] = $input[ 'reset_color' ];
	}	

	//Reset Color Options
	if( $input[ 'reset_color' ] == 1 ) {
		$input_validated[ 'color_scheme' ] = $defaults[ 'color_scheme' ];
		$input_validated[ 'header_background' ] = $defaults[ 'header_background' ];
		$input_validated[ 'content_background' ] = $defaults[ 'content_background' ];
		$input_validated[ 'footer_sidebar_background' ] = $defaults[ 'footer_sidebar_background' ];
		$input_validated[ 'footer_background' ] = $defaults[ 'footer_background' ];
		$input_validated[ 'title_color' ] = $defaults[ 'title_color' ];
		$input_validated[ 'title_hover_color' ] = $defaults[ 'title_hover_color' ];
		$input_validated[ 'meta_color' ] = $defaults[ 'meta_color' ]; 
		$input_validated[ 'text_color' ] = $defaults[ 'text_color' ]; 
		$input_validated[ 'link_color' ] = $defaults[ 'link_color' ]; 
		$input_validated[ 'widget_title_color' ] = $defaults[ 'widget_title_color' ]; 
		$input_validated[ 'widget_color' ] = $defaults[ 'widget_color' ]; 
		$input_validated[ 'widget_link_color' ] = $defaults[ 'widget_link_color' ]; 
		$input_validated[ 'home_headline_background' ] = $defaults[ 'home_headline_background' ];
		$input_validated[ 'home_headline' ] = $defaults[ 'home_headline' ];
		$input_validated[ 'menu_background' ] = $defaults[ 'menu_background' ]; 
		$input_validated[ 'menu_color' ] = $defaults[ 'menu_color' ]; 
		$input_validated[ 'hover_active_color' ] = $defaults[ 'hover_active_color' ];
		$input_validated[ 'hover_active_text_color' ] = $defaults[ 'hover_active_text_color' ]; 
		$input_validated[ 'sub_menu_bg_color' ] = $defaults[ 'sub_menu_bg_color' ];	
		$input_validated[ 'sub_menu_text_color' ] = $defaults[ 'sub_menu_text_color' ]; 
	}
	
	// data validation for Font Family Options
	if( isset( $input[ 'reset_typography'] ) ) {  
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_typography' ] = $input[ 'reset_typography' ];
		$input_validated['body_font'] = ( array_key_exists( $input['body_font'], $fonts ) ? $input['body_font'] : $defaults[ 'body_font' ] );
		$input_validated['title_font'] = ( array_key_exists( $input['title_font'], $fonts ) ? $input['title_font'] : $defaults[ 'title_font' ] );
		$input_validated['tagline_font'] = ( array_key_exists( $input['title_font'], $fonts ) ? $input['tagline_font'] : $defaults[ 'tagline_font' ] );
		$input_validated['content_tittle_font'] = ( array_key_exists( $input['content_tittle_font'], $fonts ) ? $input['content_tittle_font'] : $defaults[ 'content_tittle_font' ] );
		$input_validated['content_font'] = ( array_key_exists( $input['content_font'], $fonts ) ? $input['content_font'] : $defaults[ 'content_font' ] );
		$input_validated['headings_font'] = ( array_key_exists( $input['headings_font'], $fonts ) ? $input['headings_font'] : $defaults[ 'headings_font' ] );
		
		if( $input[ 'reset_typography'] == '1' ) {
			$input_validated['body_font'] = $defaults[ 'body_font' ];
			$input_validated['title_font'] = $defaults[ 'title_font' ];
			$input_validated['tagline_font'] = $defaults[ 'tagline_font' ];
			$input_validated['content_tittle_font'] = $defaults[ 'content_tittle_font' ];		
			$input_validated['content_font'] = $defaults[ 'content_font' ];
			$input_validated['headings_font'] = $defaults[ 'headings_font' ];
		}
	}	

	
	// Data Validation for Custom CSS Style
	if ( isset( $input['custom_css'] ) ) {
		$input_validated['custom_css'] = wp_kses_stripslashes($input['custom_css']);
	}
	
	// Data Validation for Homepage Headline Message
	if( isset( $input[ 'homepage_headline' ] ) ) {
		$input_validated['homepage_headline'] =  sanitize_text_field( $input[ 'homepage_headline' ] ) ? $input [ 'homepage_headline' ] : $defaults[ 'homepage_headline' ];
	}
	if( isset( $input[ 'homepage_subheadline' ] ) ) {
		$input_validated['homepage_subheadline'] =  sanitize_text_field( $input[ 'homepage_subheadline' ] ) ? $input [ 'homepage_subheadline' ] : $defaults[ 'homepage_subheadline' ];
	}	
	if ( isset( $input[ 'disable_homepage_headline' ] ) ) {
		$input_validated[ 'disable_homepage_headline' ] = $input[ 'disable_homepage_headline' ];
	}
	if ( isset( $input[ 'disable_homepage_subheadline' ] ) ) {
		$input_validated[ 'disable_homepage_subheadline' ] = $input[ 'disable_homepage_subheadline' ];
	}	
	

	// Data Validation for Homepage Featured Content 
	if ( isset( $input[ 'disable_homepage_featured' ] ) ) {
		$input_validated[ 'disable_homepage_featured' ] = $input[ 'disable_homepage_featured' ];
	}	
	if( isset( $input[ 'homepage_featured_headline' ] ) ) {
		$input_validated['homepage_featured_headline'] =  sanitize_text_field( $input[ 'homepage_featured_headline' ] ) ? $input [ 'homepage_featured_headline' ] : $defaults[ 'homepage_featured_headline' ];
	}	
	if ( isset( $input[ 'homepage_featured_image' ] ) ) {
		$input_validated[ 'homepage_featured_image' ] = array();
	}
	if ( isset( $input[ 'homepage_featured_url' ] ) ) {
		$input_validated[ 'homepage_featured_url' ] = array();
	}
	if ( isset( $input[ 'homepage_featured_base' ] ) ) {
		$input_validated[ 'homepage_featured_base' ] = array();
	}	
	if ( isset( $input[ 'homepage_featured_title' ] ) ) {
		$input_validated[ 'homepage_featured_title' ] = array();
	}
	if ( isset( $input[ 'homepage_featured_content' ] ) ) {
		$input_validated[ 'homepage_featured_content' ] = array();
	}
	if( isset( $input[ 'homepage_featured_layout' ] ) ) {
		$input_validated[ 'homepage_featured_layout' ] = $input[ 'homepage_featured_layout' ];
	}	
	if ( isset( $input[ 'homepage_featured_qty' ] ) ) {
		$input_validated[ 'homepage_featured_qty' ] = absint( $input[ 'homepage_featured_qty' ] ) ? $input [ 'homepage_featured_qty' ] : $defaults[ 'homepage_featured_qty' ];
		for ( $i = 1; $i <= $input [ 'homepage_featured_qty' ]; $i++ ) {
			if ( !empty( $input[ 'homepage_featured_image' ][ $i ] ) ) {
				$input_validated[ 'homepage_featured_image' ][ $i ] = esc_url_raw($input[ 'homepage_featured_image' ][ $i ] );
			}
			if ( !empty( $input[ 'homepage_featured_url' ][ $i ] ) ) {
				$input_validated[ 'homepage_featured_url'][ $i ] = esc_url_raw($input[ 'homepage_featured_url'][ $i ]);
			}
			if ( !empty( $input[ 'homepage_featured_base' ][ $i ] ) ) {
				$input_validated[ 'homepage_featured_base'][ $i ] = $input[ 'homepage_featured_base'][ $i ];
			}
			if ( !empty( $input[ 'homepage_featured_title' ][ $i ] ) ) {
				$input_validated[ 'homepage_featured_title'][ $i ] = sanitize_text_field($input[ 'homepage_featured_title'][ $i ]);
			}
			if ( !empty( $input[ 'homepage_featured_content' ][ $i ] ) ) {
				$input_validated[ 'homepage_featured_content'][ $i ] = wp_kses_stripslashes($input[ 'homepage_featured_content'][ $i ]);
			}	
		}
	}	
	
	// Data Validation for Homepage
	if ( isset( $input[ 'enable_posts_home' ] ) ) {
		$input_validated[ 'enable_posts_home' ] = $input[ 'enable_posts_home' ];
	}	
	

    if ( isset( $input['exclude_slider_post'] ) ) {
        // Our checkbox value is either 0 or 1 
   		$input_validated[ 'exclude_slider_post' ] = $input[ 'exclude_slider_post' ];	
	
    }
	// Front page posts categories
    if( isset( $input['front_page_category' ] ) ) {
		$input_validated['front_page_category'] = $input['front_page_category'];
    }	

	// data validation for Slider Type
	if( isset( $input[ 'select_slider_type' ] ) ) {
		$input_validated[ 'select_slider_type' ] = $input[ 'select_slider_type' ];
	}
	// data validation for Enable Slider
	if( isset( $input[ 'enable_slider' ] ) ) {
		$input_validated[ 'enable_slider' ] = $input[ 'enable_slider' ];
	}	
    // data validation for number of slides
	if ( isset( $input[ 'slider_qty' ] ) ) {
		$input_validated[ 'slider_qty' ] = absint( $input[ 'slider_qty' ] ) ? $input [ 'slider_qty' ] : 4;
	}	
    // data validation for transition effect
    if( isset( $input[ 'transition_effect' ] ) ) {
        $input_validated['transition_effect'] = wp_filter_nohtml_kses( $input['transition_effect'] );
    }
    // data validation for transition delay
    if ( isset( $input[ 'transition_delay' ] ) && is_numeric( $input[ 'transition_delay' ] ) ) {
        $input_validated[ 'transition_delay' ] = $input[ 'transition_delay' ];
    }
    // data validation for transition length
    if ( isset( $input[ 'transition_duration' ] ) && is_numeric( $input[ 'transition_duration' ] ) ) {
        $input_validated[ 'transition_duration' ] = $input[ 'transition_duration' ];
    }	
	
	// data validation for Featured Post and Page Slider
	if ( isset( $input[ 'featured_slider' ] ) ) {
		$input_validated[ 'featured_slider' ] = array();
	}
	if ( isset( $input[ 'featured_slider_page' ] ) ) {
		$input_validated[ 'featured_slider_page' ] = array();
	}		
 	if ( isset( $input[ 'slider_qty' ] ) )	{	
		for ( $i = 1; $i <= $input [ 'slider_qty' ]; $i++ ) {
			if ( !empty( $input[ 'featured_slider' ][ $i ] ) && intval( $input[ 'featured_slider' ][ $i ] ) ) {
				$input_validated[ 'featured_slider' ][ $i ] = absint($input[ 'featured_slider' ][ $i ] );
			}
			if ( !empty( $input[ 'featured_slider_page' ][ $i ] ) && intval( $input[ 'featured_slider_page' ][ $i ] ) ) {
				$input_validated[ 'featured_slider_page' ][ $i ] = absint($input[ 'featured_slider_page' ][ $i ] );
			}			
		}
	}	
	
	//Featured Catgory Slider
	if ( isset( $input['slider_category'] ) ) {
		$input_validated[ 'slider_category' ] = $input[ 'slider_category' ];
	}		
	
	// data validation for Featured Image SLider 
	if ( isset( $input[ 'featured_image_slider_image' ] ) ) {
		$input_validated[ 'featured_image_slider_image' ] = array();
	}
	if ( isset( $input[ 'featured_image_slider_link' ] ) ) {
		$input_validated[ 'featured_image_slider_link' ] = array();
	}
	if ( isset( $input[ 'featured_image_slider_base' ] ) ) {
		$input_validated[ 'featured_image_slider_base' ] = array();
	}		
	if ( isset( $input[ 'featured_image_slider_title' ] ) ) {
		$input_validated[ 'featured_image_slider_title' ] = array();
	}
	if ( isset( $input[ 'featured_image_slider_content' ] ) ) {
		$input_validated[ 'featured_image_slider_content' ] = array();
	}	
 	if ( isset( $input[ 'slider_qty' ] ) )	{	
		for ( $i = 1; $i <= $input [ 'slider_qty' ]; $i++ ) {
			if ( !empty( $input[ 'featured_image_slider_image' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_image' ][ $i ] = esc_url_raw($input[ 'featured_image_slider_image' ][ $i ] );
			}
			if ( !empty( $input[ 'featured_image_slider_link' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_link'][ $i ] = esc_url_raw($input[ 'featured_image_slider_link'][ $i ]);
			}
			if ( !empty( $input[ 'featured_image_slider_base' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_base'][ $i ] = $input[ 'featured_image_slider_base'][ $i ];
			}
			if ( !empty( $input[ 'featured_image_slider_title' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_title'][ $i ] = sanitize_text_field($input[ 'featured_image_slider_title'][ $i ]);
			}
			if ( !empty( $input[ 'featured_image_slider_content' ][ $i ] ) ) {
				$input_validated[ 'featured_image_slider_content'][ $i ] = wp_kses_stripslashes($input[ 'featured_image_slider_content'][ $i ]);
			}			
		}
	}	
	
	// data validation for Social Icons
	if( isset( $input[ 'social_facebook' ] ) ) {
		$input_validated[ 'social_facebook' ] = esc_url_raw( $input[ 'social_facebook' ] );
	}
	if( isset( $input[ 'social_twitter' ] ) ) {
		$input_validated[ 'social_twitter' ] = esc_url_raw( $input[ 'social_twitter' ] );
	}
	if( isset( $input[ 'social_googleplus' ] ) ) {
		$input_validated[ 'social_googleplus' ] = esc_url_raw( $input[ 'social_googleplus' ] );
	}
	if( isset( $input[ 'social_pinterest' ] ) ) {
		$input_validated[ 'social_pinterest' ] = esc_url_raw( $input[ 'social_pinterest' ] );
	}	
	if( isset( $input[ 'social_youtube' ] ) ) {
		$input_validated[ 'social_youtube' ] = esc_url_raw( $input[ 'social_youtube' ] );
	}
	if( isset( $input[ 'social_vimeo' ] ) ) {
		$input_validated[ 'social_vimeo' ] = esc_url_raw( $input[ 'social_vimeo' ] );
	}	
	if( isset( $input[ 'social_linkedin' ] ) ) {
		$input_validated[ 'social_linkedin' ] = esc_url_raw( $input[ 'social_linkedin' ] );
	}
	if( isset( $input[ 'social_slideshare' ] ) ) {
		$input_validated[ 'social_slideshare' ] = esc_url_raw( $input[ 'social_slideshare' ] );
	}	
	if( isset( $input[ 'social_foursquare' ] ) ) {
		$input_validated[ 'social_foursquare' ] = esc_url_raw( $input[ 'social_foursquare' ] );
	}
	if( isset( $input[ 'social_flickr' ] ) ) {
		$input_validated[ 'social_flickr' ] = esc_url_raw( $input[ 'social_flickr' ] );
	}
	if( isset( $input[ 'social_tumblr' ] ) ) {
		$input_validated[ 'social_tumblr' ] = esc_url_raw( $input[ 'social_tumblr' ] );
	}	
	if( isset( $input[ 'social_deviantart' ] ) ) {
		$input_validated[ 'social_deviantart' ] = esc_url_raw( $input[ 'social_deviantart' ] );
	}
	if( isset( $input[ 'social_dribbble' ] ) ) {
		$input_validated[ 'social_dribbble' ] = esc_url_raw( $input[ 'social_dribbble' ] );
	}	
	if( isset( $input[ 'social_myspace' ] ) ) {
		$input_validated[ 'social_myspace' ] = esc_url_raw( $input[ 'social_myspace' ] );
	}
	if( isset( $input[ 'social_wordpress' ] ) ) {
		$input_validated[ 'social_wordpress' ] = esc_url_raw( $input[ 'social_wordpress' ] );
	}	
	if( isset( $input[ 'social_rss' ] ) ) {
		$input_validated[ 'social_rss' ] = esc_url_raw( $input[ 'social_rss' ] );
	}
	if( isset( $input[ 'social_delicious' ] ) ) {
		$input_validated[ 'social_delicious' ] = esc_url_raw( $input[ 'social_delicious' ] );
	}	
	if( isset( $input[ 'social_lastfm' ] ) ) {
		$input_validated[ 'social_lastfm' ] = esc_url_raw( $input[ 'social_lastfm' ] );
	}
	if( isset( $input[ 'social_instagram' ] ) ) {
		$input_validated[ 'social_instagram' ] = esc_url_raw( $input[ 'social_instagram' ] );
	}	
	if( isset( $input[ 'social_github' ] ) ) {
		$input_validated[ 'social_github' ] = esc_url_raw( $input[ 'social_github' ] );
	}		
		
	//Webmaster Tool Verification
	if( isset( $input[ 'google_verification' ] ) ) {
		$input_validated[ 'google_verification' ] = wp_filter_post_kses( $input[ 'google_verification' ] );
	}
	if( isset( $input[ 'yahoo_verification' ] ) ) {
		$input_validated[ 'yahoo_verification' ] = wp_filter_post_kses( $input[ 'yahoo_verification' ] );
	}
	if( isset( $input[ 'bing_verification' ] ) ) {
		$input_validated[ 'bing_verification' ] = wp_filter_post_kses( $input[ 'bing_verification' ] );
	}	
	if( isset( $input[ 'analytic_header' ] ) ) {
		$input_validated[ 'analytic_header' ] = wp_kses_stripslashes( $input[ 'analytic_header' ] );
	}
	if( isset( $input[ 'analytic_footer' ] ) ) {
		$input_validated[ 'analytic_footer' ] = wp_kses_stripslashes( $input[ 'analytic_footer' ] );	
	}		
	
    // Layout settings verification
	if( isset( $input[ 'sidebar_layout' ] ) ) {
		$input_validated[ 'sidebar_layout' ] = $input[ 'sidebar_layout' ];
	}
	if( isset( $input[ 'content_layout' ] ) ) {
		$input_validated[ 'content_layout' ] = $input[ 'content_layout' ];
	}
	
	//data validation for more text
    if( isset( $input[ 'more_tag_text' ] ) ) {
        $input_validated[ 'more_tag_text' ] = htmlentities( sanitize_text_field ( $input[ 'more_tag_text' ] ), ENT_QUOTES, 'UTF-8' );
    }
    //data validation for excerpt length
    if ( isset( $input[ 'excerpt_length' ] ) ) {
        $input_validated[ 'excerpt_length' ] = absint( $input[ 'excerpt_length' ] ) ? $input [ 'excerpt_length' ] : $defaults[ 'excerpt_length' ];
    }
	if ( isset( $input['reset_moretag'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_moretag' ] = $input[ 'reset_moretag' ];
	}	
	
	//Reset Color Options
	if( $input[ 'reset_moretag' ] == 1 ) {
		$input_validated[ 'more_tag_text' ] = $defaults[ 'more_tag_text' ];
		$input_validated[ 'excerpt_length' ] = $defaults[ 'excerpt_length' ];
	}			
	
	
    if( isset( $input[ 'search_display_text' ] ) ) {
        $input_validated[ 'search_display_text' ] = sanitize_text_field( $input[ 'search_display_text' ] ) ? $input [ 'search_display_text' ] : $defaults[ 'search_display_text' ];
    }
	
	// Data Validation for Featured Image
	if ( isset( $input['featured_image'] ) ) {
		$input_validated[ 'featured_image' ] = $input[ 'featured_image' ];
	}
	
	if ( isset( $input['reset_layout'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_layout' ] = $input[ 'reset_layout' ];
	}	
	
	//Reset Color Options
	if( $input[ 'reset_layout' ] == 1 ) {
		$input_validated[ 'sidebar_layout' ] = $defaults[ 'sidebar_layout' ];
		$input_validated[ 'content_layout' ] = $defaults[ 'content_layout' ];
		$input_validated[ 'featured_image' ] = $defaults[ 'featured_image' ];
	}		
	


	//Feed Redirect
	if ( isset( $input[ 'feed_url' ] ) ) {
		$input_validated['feed_url'] = esc_url_raw($input['feed_url']);
	}
	
	//footer text	
	if( isset( $input[ 'footer_code' ] ) ) {
		$input_validated['footer_code'] =  stripslashes( wp_filter_post_kses( addslashes ( $input['footer_code'] ) ) );	
	}
	if ( isset( $input['reset_footer'] ) ) {
		// Our checkbox value is either 0 or 1 
		$input_validated[ 'reset_footer' ] = $input[ 'reset_footer' ];
	}	
	
	//Reset Color Options
	if ( $input[ 'reset_footer' ] == 1 ) {
		$input_validated[ 'footer_code' ] = $defaults[ 'footer_code' ];
	}	
	
	//Clearing the theme option cache
	if( function_exists( 'catcheverest_themeoption_invalidate_caches' ) ) catcheverest_themeoption_invalidate_caches();
	
	return $input_validated;
}


/*
 * Clearing the cache if any changes in Admin Theme Option
 */
function catcheverest_themeoption_invalidate_caches() {
	delete_transient( 'catcheverest_favicon' );	 // favicon on cpanel/ backend and frontend
	delete_transient( 'catcheverest_featured_image' ); // featured header image	
	delete_transient( 'catcheverest_inline_css' ); // Custom Inline CSS
	delete_transient( 'catcheverest_post_sliders' ); // featured post slider
	delete_transient( 'catcheverest_page_sliders' ); // featured page slider
	delete_transient( 'catcheverest_category_sliders' ); // featured category slider
	delete_transient( 'catcheverest_image_sliders' ); // featured image slider
	delete_transient( 'catcheverest_homepage_headline' ); // Homepage Headline Message
	delete_transient( 'catcheverest_homepage_featured_content' ); // Homepage Featured Content
	delete_transient( 'catcheverest_footer_content' ); // Footer Content
	delete_transient( 'catcheverest_social_networks' ); // Social Networks
	delete_transient( 'catcheverest_webmaster' ); // scripts which loads on header	
	delete_transient( 'catcheverest_footercode' ); // scripts which loads on footer
}


/*
 * Clearing the cache if any changes in post or page
 */
function catcheverest_post_invalidate_caches(){
	delete_transient( 'catcheverest_post_sliders' ); // featured post slider
	delete_transient( 'catcheverest_page_sliders' ); // featured page slider
	delete_transient( 'catcheverest_category_sliders' ); // featured category slider
}
//Add action hook here save post
add_action( 'save_post', 'catcheverest_post_invalidate_caches' );


/**
 * Creates new shortcodes for use in any shortcode-ready area.  This function uses the add_shortcode() 
 * function to register new shortcodes with WordPress.
 *
 * @uses add_shortcode() to create new shortcodes.
 */
function catcheverest_add_shortcodes() {
	/* Add theme-specific shortcodes. */
	add_shortcode( 'footer-image', 'catcheverest_footer_image_shortcode' );
	add_shortcode( 'the-year', 'catcheverest_the_year_shortcode' );
	add_shortcode( 'site-link', 'catcheverest_site_link_shortcode' );
	add_shortcode( 'wp-link', 'catcheverest_wp_link_shortcode' );
	add_shortcode( 'theme-link', 'catcheverest_theme_link_shortcode' );
	
}
/* Register shortcodes. */
add_action( 'init', 'catcheverest_add_shortcodes' );


/**
 * Shortcode to display Footer Image.
 *
 * @uses date() Gets the current year.
 * @return string
 */
function catcheverest_footer_image_shortcode() {
	if( function_exists( 'catcheverest_footerlogo' ) ) :
    	return catcheverest_footerlogo(); 
    endif;
}


/**
 * Shortcode to display the current year.
 *
 * @uses date() Gets the current year.
 * @return string
 */
function catcheverest_the_year_shortcode() {
	return date( __( 'Y', 'catcheverest' ) );
}


/**
 * Shortcode to display a link back to the site.
 *
 * @uses get_bloginfo() Gets the site link
 * @return string
 */
function catcheverest_site_link_shortcode() {
	return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
}


/**
 * Shortcode to display a link to WordPress.org.
 *
 * @return string
 */
function catcheverest_wp_link_shortcode() {
	return '<a href="http://wordpress.org" target="_blank" title="' . esc_attr__( 'WordPress', 'catcheverest' ) . '"><span>' . __( 'WordPress', 'catcheverest' ) . '</span></a>';
}


/**
 * Shortcode to display a link to Theme Link.
 *
 * @return string
 */
function catcheverest_theme_link_shortcode() {
	return '<a href="http://catchthemes.com/themes/catch-everest-pro" target="_blank" title="' . esc_attr__( 'Catch Everest Pro', 'catcheverest' ) . '"><span>' . __( 'Catch Everest Pro', 'catcheverest' ) . '</span></a>';
}