<?php
/* ***************************************************** 
 * File Description: Contains all theme's shortcodes
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */


/***************** BUTTONS ********************/

function al_button($atts, $content = null) {

	extract(shortcode_atts(array(
		"id"	=> '',
		"url"  => '#', 
		"size" => 'small',
		"bg" => '',
	), $atts));
	
	$id = isset($id) && $id != '' ? 'id="'.$id.'"' : '';
	$class = ($size !== 'action') ? 'button '.$size : 'slider_button';
	
	return '<a href="'.$url.'" '.$id.' class="'.$class.' '.$bg.'">'.$content.'</a>';
	
}
add_shortcode('button', 'al_button');

/************************************************/


/*********** SINGLE ARTICLE BY ID ***************/

function sc_article($atts, $content = null) {

	extract(shortcode_atts(array(
		"id"=> '',
	), $atts));
	
	$post = get_post($id);
	$url = get_permalink($id);
	return '<h2><a href="'.$url.'">'.$post->post_title.'</a></h2><div>'.do_shortcode($post->post_content).'</div>';
	
}
add_shortcode('article', 'sc_article');

/************************************************/

function parse_shortcode_content( $content ) {

   /* Parse nested shortcodes and add formatting. */
    $content = trim( do_shortcode( shortcode_unautop( $content ) ) );

    /* Remove '' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '' )
        $content = substr( $content, 4 );

    /* Remove '' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of ''. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    $content = str_replace( array( '<p>  </p>' ), '', $content );

    return $content;
}

/*************** SOCIAL BUTTONS *****************/

function al_socialbutton($atts, $content = null) {

	extract(shortcode_atts(array(
		"name"	=> '',
		"url" 	=> '#', 
		"icon"	=> '',
		"title"	=> '',
		"target" => '_blank',
		"bg" => ''
	), $atts));
	
	$title = isset($title) && $title != '' ? $title : $name;
	$bg = (isset($bg) && $bg != '') ? 'style="background-color:'.$bg.'"' : '';
	$predefined = array('facebook', 'twitter', 'rss', 'linkedin', 'flickr', 'vimeo', 'mail', 'myspace', 'skype', 'youtube');
	$icon = in_array($name, $predefined) ? get_template_directory_uri().'/images/social_icons/'.$name.'.png' : $icon.'' ;
	
	$return = '<a href="'.$url.'" class="tooltip" target="'.$target.'" title="'.$title.'" '.$bg.'><span class="social-icon fade" style="background-image:url('.$icon.')"></span></a>';
	//return do_shortcode ('[raw]'.$return.'[/raw]');
	return $return;
}
add_shortcode('social_button', 'al_socialbutton');

/************************************************/


/************** TEXT HIGLIGHTING ****************/

function al_highlight($atts, $content = null) {

	extract(shortcode_atts(array(
		"color"			=> '#fff',
	), $atts));	
	
	return '<span class="highlight" style="color:'.$color.'">'.$content.'</span>';
}
add_shortcode('highlight', 'al_highlight');

/************************************************/


/*************** RELATED POSTS ******************/

function al_related_posts( $atts ) {
	extract(shortcode_atts(array(
	   'limit' => '4',
	    'title' => 'Related Posts'
	), $atts));
	global $post;
	$return = '';
	if ($post->ID) {
		
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {
			$tag_ids = array();
			foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			$args=array('tag__in' => $tag_ids,'post__not_in' => array($post->ID),'showposts'=> $limit,  'ignore_sticky_posts'=>1);
			$my_query = new wp_query($args);
			if( $my_query->have_posts() ) {
				$return.= '<div id="related-posts"><h4 class="uppercase">'.$title.'</h4><ul>';
				while ($my_query->have_posts()) {
					$my_query->the_post();
					if ( has_post_thumbnail($post->ID) ) {
						$thumbnail = get_the_post_thumbnail($post->ID, array(130,81));
						$return.= 
						'<li>
							<a href="'.get_permalink($post->ID).'" rel="bookmark">'.$thumbnail.'</a>
							<p><a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></p>
						</li>';
					} 
					else { 
						$return.= 
						'<li>
								<a href="'.get_permalink($post->ID).'" rel="bookmark">
									<img src="'.get_template_directory_uri().'/images/picture.jpg" class="related-image" alt="" />
									<p>'.get_the_title($post->ID).'</p>
								</a>
						</li>';
					}
				}
				$return.= '</ul>';
			}
		}
		else 
		{
			$return.='<p>No related posts found</p>';
		}
		
		wp_reset_query();
	}
	else
	{
		$return.='<p>No related posts found</p>';
	}
	$return.='<div class="clear"></div></div>';
	return $return;
	
}
add_shortcode('related_posts', 'al_related_posts');

/************************************************/


/***************** LIST PAGES *******************/

function al_list_pages($atts, $content, $tag) {
	global $post;
		
	// set defaults
	$defaults = array(
	    'class'       => $tag,
	    'depth'       => 0,
	    'show_date'   => '',
	    'date_format' => get_option('date_format'),
	    'exclude'     => '',
	    'child_of'    => 0,
	    'title_li'    => '',
	    'authors'     => '',
	    'sort_column' => 'menu_order, post_title',
	    'link_before' => '',
	    'link_after'  => '',
	    'exclude_tree'=> ''
	);
	
	
	$atts = shortcode_atts($defaults, $atts);
	
	
	$atts['echo'] = 0;
	if($tag == 'child-pages')
		$atts['child_of'] = $post->ID;	

	// create output
	$out = wp_list_pages($atts);
	if(!empty($out))
		$out = '<ul class="'.$atts['class'].'">' . $out . '</ul>';
	
  return $out;
}

add_shortcode('child-pages', 'al_list_pages');
add_shortcode('list-pages', 'al_list_pages');

/************************************************/


/*************** DIVIDER LINE ******************/

function al_divider($atts, $content = null) {
	  extract(shortcode_atts(array(
        'type' => '',      
		'class' => ''
    ), $atts));
	  
	if ($type==1)
	{
		return '<div class="divider '.$class.'"></div>';
	}
	elseif($type==2)
	{
   		return '<div class="central-divider '.$class.'"></div>';
	}
	else
	{
   		return '<div class="big_separator '.$class.'"></div>';
	}
	
}
add_shortcode('divider', 'al_divider');

/***********************************************/



/****************** SPACING ********************/

function al_spacing($atts, $content = null) {
  extract(shortcode_atts(array(
        'type' => 'top',
        'amount' => '10',
   ), $atts));
   return '<div class="'.$type.$amount.'"></div>';
}
add_shortcode('spacing', 'al_spacing');

/************************************************/


/************* VIMEO EMBED (VIA ID) *************/

function al_vimeo($atts, $content=null) {
	
	   extract(shortcode_atts(array(
            "id" => '',
            "width" => '100%',
            "height" => '300px',
			"class" => 'vimeo-frame'
        ), $atts));
    $data = '<iframe src="http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0&amp;color=00adef" width="'.$width.'" height="'.$height.'" class="'.$class.'"></iframe>';
	
    return $data;
}
add_shortcode('vimeo', 'al_vimeo');

/************************************************/


/************** YOUTUBE EMBED (VIA ID) **********/ 
$youtube_nr = 0;
function al_youtube($atts, $content=null) {
	 extract(shortcode_atts(array(
			'id'  => '',
			'width'  => '600',
			'height' => '340',
			"class" => 'frame'
			), $atts));

		return '<div class="youtube_video"><object class="'.$class.'" type="application/x-shockwave-flash" style="width:'.$width.'px; height:'.$height.'px;" data="http://www.youtube.com/v/'.$id.'&amp;hl=en_US&amp;fs=1&amp;"><param name="movie" value="http://www.youtube.com/v/'.$id.'&amp;hl=en_US&amp;fs=1&amp;" /></object></div>';

}
add_shortcode('youtube', 'al_youtube');
/************************************************/


/***************** CLEAR ************************/

function al_clear($atts, $content = null) {	
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'al_clear');

/************************************************/


/********* STANDARD UNORDERED LISTS *************/

function al_list($atts, $content = null) {
	extract(shortcode_atts(array(
		'type' 	=> '1',	
		'split' => ''
	), $atts));
	
	if (empty($split))
	{
		return '<div class="list type'.$type.'">'.$content.'</div>';
	}
	else
	{
		return '<div class="list type'.$type.' split-list regular-size">'.$content.'</div>';
	}
}
add_shortcode('list', 'al_list');

/************************************************/

/********* STANDARD ORDERED LISTS *************/

function al_olist($atts, $content = null) {
	extract(shortcode_atts(array(
		'type' 	=> '',	
	), $atts));

	return '<div class="olist type'.$type.'">'.$content.'</div>';
}
add_shortcode('olist', 'al_olist');

/************************************************/


/************ CONTACT INFORMATION ***************/

function al_contactinfo($atts, $content = null) {
	extract(shortcode_atts(array(
		'address' 	=> '',	
		'phone' 	=> '',	
		'fax' 		=> '',	
		'email' 	=> '',	
	), $atts));
	
	$address = ($address !== '') ? '<span>Address:</span><p>'.$address.'</p>' : '';
	$phone = ($phone !== '') ? '<span>Phone:</span><p>'.$phone.'</p>' : '';
	$fax = ($fax !== '') ? '<span>Fax:</span><p>'.$fax.'</p>' : '';
	$email = ($email !== '') ? '<span>E-mail:</span><p>'.$email.'</p>' : '';
	
	$return = '<div class="contact-details">'.$address.$phone.$fax.$email.'<div class="clear"></div></div>'.$content;
	return $return;//do_shortcode ('[raw]'.$return.'[/raw]');
}
add_shortcode('contactinfo', 'al_contactinfo');

/************************************************/


/****************** COLUMNS *********************/

function al_column( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'size'	=> '',
		'type' 	=> '',
		'class' => ''
	), $atts));
	
	$fullsize = '';
	
	switch ($size)
	{
		case 'full':
		$fullsize = 'sixteen columns';
		break;
		
		case 'one half':
		$fullsize = 'eight columns';
		break;
		
		case 'one third':
		$fullsize = 'one-third column';
		break;
		
		case 'two third':
		$fullsize = 'two-thirds column';
		break;
		
		case 'one fourth':
		$fullsize = 'four columns';
		break;
		
		case 'three fourth':
		$fullsize = 'twelve columns';
		break;
		
		case 'one eighth':
		$fullsize = 'two columns';
		break;
		
		case 'three eighth':
		$fullsize = 'six columns';
		break;
		
		case 'sixteen fifth':
		$fullsize = 'five columns';
		break;
		
		case 'five eighth':
		$fullsize = 'ten columns';
		break;
		
		case 'sixteen ninth':
		$fullsize = 'nine columns';
		break;
		
		case 'sixteen seventh':
		$fullsize = 'seven columns';
		break;
	}
	
	return '<div class="'.$fullsize.' '.$type.' '.$class.'">' . do_shortcode($content) . '</div>'; 
}
add_shortcode('column', 'al_column');

/************************************************/


/**************** TESTIMONIALS ******************/

function al_testimonial( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'author' => '',
	), $atts));

	return '<div class="blockquote"><p class="author">'.$author.'</p><blockquote><p>'.do_shortcode($content).'</p></blockquote></div>';
}
add_shortcode('testimonial', 'al_testimonial');

/************************************************/


/*****************  TABS *******************/

add_shortcode( 'tabgroup', 'al_tab_group' );
function al_tab_group( $atts, $content ){
	extract(shortcode_atts(array(
		'type' => ''
	), $atts));
	$GLOBALS['tab_count'] = 0;
	$randomId = mt_rand(0, 100000);
	$type = empty($type) ? '' : ' type2';
	do_shortcode( $content );
	$tabDesc = '';
	if( is_array( $GLOBALS['tabs'] ) ){
	foreach( $GLOBALS['tabs'] as $tab ){
	if (!empty ($tab ['desc']))
	$tabDesc = '<span>'.$tab['desc'].'</span>';
	$tabs[] = '<li><a class="" href="#">'.$tab['title'].'<span>'.$tabDesc.'</span></a></li>';
	$panes[] = '<div class="pane'.$type.'">'.do_shortcode($tab['content']).'</div>';
	}
	$return = "\n".'<ul class="tabs tab-'.$randomId.' '.$type.'">'.implode( "\n", $tabs ).'</ul><div class="clear"></div>'."\n".'<div class="panes pane-'.$randomId.'">'.implode( "\n", $panes ).'</div>'."\n".
	'<script>jQuery(function() {jQuery("ul.tabs.tab-'.$randomId.'").tabs("div.panes.pane-'.$randomId.' > div", {effect:"fade"});});</script>';
	}
	return $return;
}

add_shortcode( 'tab', 'al_tab' );

function al_tab( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'Tab %d',
	'desc'	=> ''
	), $atts));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'desc' =>  $desc, 'content' =>  $content );
	
	$GLOBALS['tab_count']++;
}

/************************************************/


/**************** TEXT SLIDER *******************/

function al_textslider( $atts, $content ){
	extract(shortcode_atts(array(
	'type' => ''
	), $atts));
	$GLOBALS['tsitem_count'] = 0;
	do_shortcode( $content );
	
	$count = 0;
	$return = '';
	if(is_array($GLOBALS['tsitem']))
	{
		foreach($GLOBALS['tsitem'] as $tab ){		
			$panes[] = '<li>'.do_shortcode($tab['content']).'</li>';		
			$count++;
		}
		
		if ($type == 'mini')
		{
			$randomId = mt_rand(0, 100000);
			$return = '
			<div class="slide-text mini slide-minitext-'.$randomId.'">
				<a href="#" class="ts-link ts-prev-link"><span class="ts-prev"></span></a> 
				<a href="#" class="ts-link"><span class="ts-next"></span></a>
				<div class="mini-slider">
					<ul>'.implode( "\n", $panes ).''."\n".'</ul>
				</div>
				<div class="clear"></div>
			</div>
			<script>
			jQuery(function() {
				jQuery(".slide-minitext-'.$randomId.' ul").carouFredSel({
					responsive : true,
					items : {visible:1},
					scroll :1,
					width:"100%",
					next : ".slide-minitext-'.$randomId.' .ts-next",
					prev : ".slide-minitext-'.$randomId.' .ts-prev",
					auto: false
				});		
			});
			</script>
			';		
		}
		else
		{
			$randomId = mt_rand(0, 100000);
			$return = '
			 <div class="slide-text full slide-text-'.$randomId.'">
            	<a href="#" class="ts-prev" title="Prev"></a> 
                <div class="textSlider">
					 <ul>'.implode( "\n", $panes ).''."\n".'</ul>
                </div>
                <a href="#" class="ts-next" title="Next"></a> 
                <div class="clear"></div>
            </div>
			<script>
			jQuery(function() {
				jQuery(".slide-text-'.$randomId.' ul").carouFredSel({
					responsive : true,
					width:"100%",
					items : 1,
					scroll: 1,
					items: {visible:1},
					next : ".slide-text-'.$randomId.' .ts-next",
					prev : ".slide-text-'.$randomId.' .ts-prev",
					auto: false,
					scroll : {	            
						items         : 1,
						easing        : "easeInExpo",
						duration      : 700,
						pauseDuration : 3000,                     
						pauseOnHover  : true
					} 
				});
			});
			</script>
			';
		}
	}
	return $return;
}
add_shortcode( 'textslider', 'al_textslider' );

function al_tsitem( $atts, $content ){
	
	$x = $GLOBALS['tsitem_count'];
	$GLOBALS['tsitem'][$x] = array('content' =>  $content );
	
	$GLOBALS['tsitem_count']++;
}
add_shortcode( 'tsitem', 'al_tsitem');

/************************************************/


/****************** CAROUSEL ********************/

add_shortcode( 'carousel', 'al_carousel' );
function al_carousel( $atts, $content ){
	extract(shortcode_atts(array(
		'class' => '',
		), $atts));
	$count = 0;
	$GLOBALS['caritem_count'] = 0;
	do_shortcode( $content );

	if( is_array( $GLOBALS['caritem'] ) )
	{
		foreach( $GLOBALS['caritem'] as $tab )
		{
			
			$panes[] ='<li>'.do_shortcode ($tab['content']).'</li>';	
			$count++;
		}
		$return = "\n".'  
				<div class="carousel-wrapper '.$class.'">
                	<a href="#" class="car-prev">Prev</a>
					<ul class="carousel">'.implode( "\n", $panes ).'</ul>
				 	<a href="#" class="car-next">Next</a>                      
            		<div class="clear"></div>
            	</div>            
            	<div class="clear"></div>';		
	}
	return $return;
}

function al_caritem( $atts, $content )
{
	
	$x = $GLOBALS['caritem_count'];
	$GLOBALS['caritem'][$x] = array('content' =>  $content);
	
	$GLOBALS['caritem_count']++;
}
add_shortcode( 'caritem', 'al_caritem' );
/************************************************/


/****************** SLIDER ********************/

add_shortcode('slider', 'al_slider' );
function al_slider( $atts, $content ){
	$GLOBALS['slideritem_count'] = 0;
	extract(shortcode_atts(array(
		'interval' => '4000'
	), $atts));
	do_shortcode( $content );
		
	if( is_array( $GLOBALS['sitems'] ) ){
		$icount = 0;
		foreach( $GLOBALS['sitems'] as $item ){
			$panes[] = '<li><img src="'.$item['image'].'" alt="'.$item['title'].'"/></li>';   		
			$icount ++ ;
		}
		
		$randomId = mt_rand(0, 100000);
		$return ='
		<div class="flexslider-container">
			<div class="flexslider" id="flex-'.$randomId.'">
				<ul class="slides">'.implode( "\n", $panes ).'</ul>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(window).load(function() {
				jQuery("#flex-'.$randomId.'").fitVids().flexslider({slideshowSpeed: '.$interval.'});
			});
		</script>';	
	}
	return $return;
}


add_shortcode( 'slideritem', 'al_slideritem' );

function al_slideritem( $atts, $content ){
	extract(shortcode_atts(array(
		'image' => '',
		'title' => '',
	), $atts));
	
	$x = $GLOBALS['slideritem_count'];
	$GLOBALS['sitems'][$x] = array( 'image' => $image, 'title' => $title, 'content' =>  $content );
	
	$GLOBALS['slideritem_count']++;
	
}
/************************************************/


/***************** TOGGLES **********************/

function al_toggle($atts, $content = null ) {
	extract(shortcode_atts(array(
		'class'	=> '',
		'title'	=> '',
	), $atts));
		
	return '<div class="toggle-trigger">
				<a href="#" class="tr'.$class.'">'.$title.'</a>
			</div> 
			<div class="toggle-container"> 
				<div class="toggle-block">'.do_shortcode($content).'</div>
			</div>'; 
}
add_shortcode('toggle', 'al_toggle');

/************************************************/


/**************** ALIGNED IMAGES ****************/

function al_alimage( $atts, $content = null)
{
   extract(shortcode_atts(array(
		'align'	=> 'left',	
	), $atts));	
   return '<div class="align'.$align.'">'. do_shortcode($content) . '</div>';
}
add_shortcode('alimage', 'al_alimage');

/************************************************/



/************* IMAGE IN LIGHTBOX ****************/

function al_featimage( $atts, $content = null)
{
   extract(shortcode_atts(array(
		'image'	=> '',
		'url'	=> '#',
		'title' => '',
		'width' => '160',
		'height' => '160',
		'class' => ''
	), $atts));	
	
	$return = '<div class="content-block featured-image '.$class.'" style="width:'.$width.'px; height:'.$height.'px">';
	
	$return.='<a title="'.$title.'" data-rel="prettyPhoto" href="'.$url.'"><img alt="'.$title.'" src="'.$image.'"></a>';
	
	$return.= '</div>';
	
   return $return;
}
add_shortcode('featimage', 'al_featimage');

/************************************************/


/**************** PROMO BLOCK *******************/

function al_promo( $atts, $content = null)
{
	extract(shortcode_atts(array(
		'class' => '',
	), $atts));	
	
	$return = '<div class="'.$class.'"><div class="sixteen columns alpha omega"><div class="big_separator"></div><div class="outer-text-wrapper"><div class="promo-text"><p>'.$content.'</p></div></div><div class="big_separator"></div>	</div></div><div class="clear"></div>';
	
	return $return;
}
add_shortcode('promo', 'al_promo');

/************************************************/


/************** NEWSLETTER SIGNUP ***************/

function al_newsletter( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'buttonLabel' => 'Subscribe',
		'localization' => 'en_US',
		'title'	=> 'Newsletter',
		'desc'	=> ''
	), $atts));
	
	$return = '
	<div class="container container_split">
		<div class="sixteen columns">
			<div class="newsletter">
				<div class="newsletter-wrapper">
					<div class="promo-text sixteen columns">
						<div class="divider bottom20"></div>
							<div class="one-third column alpha">
								<h3 class="newsletter-title">'.$title.'</h3>
							</div>
							<div class="one-third column">
								<p class="newsletter-text">'.$desc.'</p>
							</div>
							<div class="one-third column last">
								<form id="newsletter-form" method="post" action="http://feedburner.google.com/fb/a/mailverify" onsubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri=http://feedburner.com\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return true">
									<div>
										<input type="text" name="email" value="" id="feedburn-email" />
										<input type="submit" name="subscribe" value="'.$buttonLabel.'" />
										<input type="hidden" value="http://feedburner.com" name="uri" />
										<input type="hidden" name="loc" value="'.$localization.'"/>
									</div>
								</form>
							</div>
							<div class="clear"></div>
						<div class="divider bottom0"></div>	
					</div>
				</div>
			</div>
			<div class="clear"></div>
	   
		</div>
	</div>
	<div class="white_space20"></div>';
	
	return $return; 
}
add_shortcode('newsletter', 'al_newsletter');

/************************************************/	


/************* SITEMAP GENERATOR ****************/

function al_sitemap($atts, $content = null) {
	extract(shortcode_atts(array(  
		'menu'            => 'primary_nav', 
		'container'       => 'div', 
		'container_class' => 'sitemap', 
		'container_id'    => '', 
		'menu_class'      => 'primary-navigation', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 0,
		'walker'          => '',
		'theme_location'  => ''), 
		$atts));
 
 
	return wp_nav_menu( array( 
		'menu'            => $menu, 
		'container'       => $container, 
		'container_class' => $container_class, 
		'container_id'    => $container_id, 
		'menu_class'      => $menu_class, 
		'menu_id'         => $menu_id,
		'echo'            => false,
		'fallback_cb'     => $fallback_cb,
		'before'          => $before,
		'after'           => $after,
		'link_before'     => $link_before,
		'link_after'      => $link_after,
		'depth'           => $depth,
		'walker'          => $walker,
		'theme_location'  => $theme_location));
}
add_shortcode('sitemap', 'al_sitemap');

/************************************************/


/******** SHORTCODE SUPPORT FOR WIDGETS *********/

if (function_exists ('shortcode_unautop')) {
	add_filter ('widget_text', 'shortcode_unautop');
}
add_filter ('widget_text', 'do_shortcode');

/************************************************/


/************* PORTFOLIO WORKS ***************/

function al_list_portfolio($atts, $content = null) {
    extract(shortcode_atts(array(
            "title" => '',
			"category" => '',
			"limit"		=> 3,
			"featured" => '1'
    ), $atts));
	
	global $post;
    $counter = 1; 
	$return = '';
	$args = array('post_type' => 'portfolio', 'taxonomy'=> 'portfolio_category', 'showposts' => $limit, 'posts_per_page' => $limit, 'orderby' => 'date','order' => 'DESC');
	if ($featured)
	{
		$args['meta_key'] = '_portfolio_featured'; 
		$args['meta_value'] = '1';
	}
	if (!empty($category))
	$args['term'] = $category; 
	
   	$query = new WP_Query($args);
	
	if (!empty($content)):
		$return.='
		<div class="four columns alpha"><h4>'.$title.'</h4>'.do_shortcode($content).'</div>';
	endif;
	$return.='<div class="twelve columns last">';
	$return.= '<ul class="recent-works" id="portfolio-list">';
	while ($query->have_posts())  : $query->the_post(); 
		$custom = get_post_custom($post->ID);  	
		$thumbnail = get_the_post_thumbnail($post->ID, 'portfolio-4-col', array('class' => 'cover'));
		$link = '';
		$return.='
		<li class="four columns">';
			if (has_post_thumbnail() && !empty($thumbnail)):
				$return.= $thumbnail; 
			else:
				$return.='<img src="'.get_template_directory_uri().'/images/picture.jpg" width="201" height="188" alt="No Image" />';
			endif;
			
			$return.='<div class="overlay">';
				if( !empty ( $custom['_portfolio_video'][0])) : 
					$link = $custom['_portfolio_video'][0]; 
					$return.='<a href="'.$link.'" class="video-icon" title="'.get_the_title().'" data-rel="prettyPhoto"></a>';
				elseif( isset($custom['_portfolio_link'][0]) && $custom['_portfolio_link'][0] != '' ) : 
					$link = $custom['_portfolio_link'][0]; 
					$return.='<a href="'.$link.'" class="external-icon" title="'.get_the_title().'"></a>';
				elseif(  isset( $custom['_portfolio_no_lightbox'][0] )  &&  $custom['_portfolio_no_lightbox'][0] !='' ) :
					$link = get_permalink($post->ID);
					$return.='<a href="'.$link.'" class="internal-icon"></a>';
				else : 
					$full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false); 
					$link = $full_image[0];
					
					$argsThumb = array(
						'order'          => 'ASC',
						'post_type'      => 'attachment',
						'post_parent'    => $post->ID,
						'post_mime_type' => 'image',
						'post_status'    => null,
						'exclude' => get_post_thumbnail_id()
					);
					
					$return.='<a href="'.$link.'" title="'.get_the_title().'"  class="gallery-icon" data-rel="prettyPhoto[ppgal'.$post->ID.']"></a>
					<div class="hover_slideshow">';
						$attachments = get_posts($argsThumb);
						if ($attachments) {
							foreach ($attachments as $attachment) {
								$return.='<a href="'.wp_get_attachment_url($attachment->ID, 'full', false, false).'"  class="gallery-hidden" data-rel="prettyPhoto[ppgal'.$post->ID.']" title="'.get_the_title($post->ID).'"></a>';
							}
						}
					$return.='</div>';
				endif;
			$return.='</div>';
			$return.='<a href="'.$link.'" class="item-title">'.get_the_title().'</a>';
			$return.='</li>';  
		$counter++;  
	endwhile; wp_reset_query();
	
	$return.='</ul><div class="clear"></div></div><div class="clear"></div>';
	//$return.='<script>jQuery(function(){jQuery.fn.css = jQuery.fn.cssOriginal;});</script>';
	return $return;
	
}
add_shortcode("list_portfolio", "al_list_portfolio"); 


/************* RELATED WORKS ***************/

function al_portfolio_related($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',	
		'desc' => '',
		'limit' => 2
	  ), $atts));
 	global $post;
    $counter = 1; 
	$return = '';
	$wp_query = get_taxonomy_related_posts($post->ID, 'portfolio_category', $limit);
	
	$return.= '
			<div class="four columns">
				<h4>'.$title.'</h4>
				<p>'.$desc.'</p>
			</div>';
	$return.= '<ul class="portfolio-content" id="portfolio-list">';
	
	while ($wp_query->have_posts())  : $wp_query->the_post(); 
		$custom = get_post_custom($post->ID); 
		$thumbnail = get_the_post_thumbnail($post->ID, 'portfolio-thumb-3cols', array('class' => 'cover')); 
		$return.='<li class="four columns">';
					if (has_post_thumbnail() && !empty ($thumbnail)):
						$return.= $thumbnail; 
                    else:
					    $return.='<img src="'.get_template_directory_uri().'/images/picture.jpg" width="200" height="176" alt="No Image" />';
                    endif;
                	$return.='<a href="'.get_permalink($post->ID).'" class="item-title">'.get_the_title().'</a>';
                	
					$return.='<div class="overlay">';
						if( !empty ( $custom['_portfolio_video'][0])) : 
							$return.='<a href="'.$custom['_portfolio_video'][0].'" class="video-icon" title="'.get_the_title().'" data-rel="prettyPhoto">';
						elseif( isset($custom['_portfolio_link'][0]) && $custom['_portfolio_link'][0] != '' ) : 
							$return.='<a href="'.$custom['_portfolio_link'][0].'" class="external-icon" title="'.get_the_title().'">';
						elseif(  isset( $custom['_portfolio_no_lightbox'][0] )  &&  $custom['_portfolio_no_lightbox'][0] !='' ) :
							$return.='<a href="'.get_permalink($post->ID).'" class="internal-icon">';
						else : 
							$full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false); 
							$return.='<a href="'.$full_image[0].'" class="zoom-icon" title="'.get_the_title().'" data-rel="prettyPhoto">';
						endif;
					$return.='</a>';     
				$return.='</div>';
            $return.='</li>';  
		
		$counter++;  
	endwhile; wp_reset_query();
	
	$return.='
		</ul>
		<div class="clear"></div>  ';  
    	
	return $return;
}
add_shortcode("portfolio_related", "al_portfolio_related"); 


/************* BLOG POSTS ***************/

function al_listposts($atts, $content = null) {
    extract(shortcode_atts(array(
            "title" => '',
			"category" => '',
			"limit"		=> 3
    ), $atts));
 	global $post;
    $counter = 1; 
	$return = '';
	$args = array('post_type' => 'post', 'showposts' => $limit, 'posts_per_page' => 9);
	if (!empty($category))
	$args['term'] = $category; 
   	$query = new WP_Query($args);
	
	if (!empty($content)):
		$return.='
		<div class="four columns alpha">
			<h4>'.$title.'</h4>
			'.do_shortcode($content).'
		</div>';
	endif;
	
	$return.='<div class="twelve columns last">';
	$return.= '<ul id="blogposts-list" class="recent-works">';
	while ($query->have_posts())  : $query->the_post(); 
		$custom = get_post_custom($post->ID);  	
		$thumbnail = get_the_post_thumbnail($post->ID, 'portfolio-4-col', array('class' => 'cover'));
		$return.='<li>';
			$return.='<a href="'.get_permalink($post->ID).'">';
		 	if(has_post_thumbnail() && !empty ($thumbnail))
			{
				$return.= $thumbnail; 
			}
			else
			{
				if ($custom && !has_post_thumbnail())
				{
            		$return.= '<img src = "'.get_template_directory_uri().'/images/video_medium.jpg" alt="Video" style="width:200px; height:154px" />';
				}
				else
				{
					$return.= '<img src = "'.get_template_directory_uri().'/images/picture.jpg" alt="No Image" />';
				}
			}
			$return.='</a>';
			$return.='<a href="'.get_permalink($post->ID).'" class="item-title">'.get_the_title().'</a>';
	    $return.='</li>';  
		
		$counter++;  
	endwhile; wp_reset_query();
	
	$return.='</ul><div class="clear"></div></div><div class="clear"></div>';
	//$return = str_replace ('<div class="clear"></div></p>', '<div class="clear"></div>', $return);
	return $return;

}
add_shortcode("list_posts", "al_listposts"); 


/*************** STEP BLOCK ******************/

function al_stepbox($atts, $content = null) {
	  extract(shortcode_atts(array(
        'step' => '1', 
		'title' => ''		
    ), $atts));
	
	$return = '<div class="step-box"><span>'.$step.'</span><h4 class="stepbox-title">'.$title.'</h4><div>'.do_shortcode($content).'</div></div>';	
	
   	return $return;
}
add_shortcode('stepbox', 'al_stepbox');

/***********************************************/

/*************** LOCAL VIDEO (HTML 5) ****************/
function al_audio($atts, $content = null) {
    extract(shortcode_atts(array(
            "title" => '',
			"poster" => '',
			"m4a"  => '',
			"oga"	=> ''			
    ), $atts));
 	
	$poster = ($poster == '') ? get_template_directory_uri().'/images/music.jpg' : $poster;
	$randomId = mt_rand(0, 100000);  
	$return = '	
	<script type="text/javascript">
			jQuery(document).ready(function($){

				$("#jquery_jplayer_'.$randomId.'").jPlayer({
					ready: function () {
						$(this).jPlayer("setMedia", {
							m4a: "'.$m4a.'",
							oga: "'.$oga.'",
							poster: "'.$poster.'"
						});
					},
					play: function() { // To avoid both jPlayers playing together.
						$(this).jPlayer("pauseOthers");
					},
					repeat: function(event) { // Override the default jPlayer repeat event handler
						if(event.jPlayer.options.loop) {
							$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
							$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerRepeat", function() {
								$(this).jPlayer("play");
							});
						} else {
							$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
							$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerNext", function() {
								$("#jquery_jplayer_'.$randomId.'").jPlayer("play", 0);
							});
						}
					},
					swfPath: "'.get_template_directory_uri().'/js/jplayer",
					supplied: "m4a, oga",
					wmode: "window",
					size: {width: "450px",height: "220px",cssClass: "jp-video-standard"},
					cssSelectorAncestor: "#jp_container_'.$randomId.'"
				});
			});
		</script>';
		
		$return.= '	
		<div class="singlesong featured-image">     
			<div id="jquery_jplayer_'.$randomId.'" class="jp-jplayer"></div>           
			<div id="jp_container_'.$randomId.'" class="jp-audio jp-video-standard">
				<div class="jp-type-single">
					<div class="jp-gui jp-interface">
						<ul class="jp-controls">
							<li><a href="javascript:;" class="jp-play" tabindex="1">play></a></li>
							<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
							<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
							<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
							<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
							<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
						</ul>
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"></div>
							</div>
						</div>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
						<div class="jp-time-holder">
							<div class="jp-current-time"></div>
							<div class="jp-duration"></div>
	
							<ul class="jp-toggles">
								<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
								<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
							</ul>
						</div>
					</div>
					<div class="jp-title">
						<ul>
							<li>'.$title.'</li>
						</ul>
					</div>
				   
					<div class="jp-no-solution">
						<span>Update Required</span>
						To play the media you will need to either update your browser to a recent version or update your Flash plugin.
					</div>
				</div>
			</div>
			
		</div>';
	
	
	return do_shortcode ('[raw]'.$return.'[/raw]');
	
}
add_shortcode("audio", "al_audio"); 

/****************************************************/

function al_video($atts, $content = null) {
    extract(shortcode_atts(array(
            "title" => '',
			"poster" => '',
			"m4v"  => '',
			"ogv"	=> ''			
    ), $atts));
 	
	$poster = ($poster == '') ? get_template_directory_uri().'/images/video.jpg' : $poster;
	$randomId = mt_rand(0, 100000);  
	$return = '	
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$("#jquery_jplayer_'.$randomId.'").jPlayer({
				option: {"fullscreen": true},
				ready: function () {
					$(this).jPlayer("setMedia", {
						m4v: "'.$m4v.'",
						ogv: "'.$ogv.'",
						poster: "'.$poster.'"
					});
				},
				play: function() { // To avoid both jPlayers playing together.
					$(this).jPlayer("pauseOthers");
				},
				repeat: function(event) { // Override the default jPlayer repeat event handler
					if(event.jPlayer.options.loop) {
						$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
						$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerRepeat", function() {
							$(this).jPlayer("play");
						});
					} else {
						$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
						$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerNext", function() {
							$("#jquery_jplayer_'.$randomId.'").jPlayer("play", 0);
						});
					}
				},
				swfPath: "'.get_template_directory_uri().'/js/jplayer",
				supplied: "ogv, m4v",
				size: {width: "450px",height: "220px",cssClass: "jp-video-standard"},
				cssSelectorAncestor: "#jp_container_'.$randomId.'"
			});
		});
	</script>';
	
	$return.= '	
	<div class="singlesong featured-image">
		<div id="jp_container_'.$randomId.'" class="jp-video jp-video-standard">
			<div class="jp-type-single">
				<div id="jquery_jplayer_'.$randomId.'" class="jp-jplayer"></div>
				<div class="jp-gui">
					<div class="jp-video-play">
						<a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>
					</div>
					<div class="jp-interface">
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"></div>
							</div>
						</div>
						<div class="jp-current-time"></div>
						<div class="jp-duration"></div>
						<div class="jp-controls-holder">
							<ul class="jp-controls">
								<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
								<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
								<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
								<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
								<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
								<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
							</ul>
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
							<ul class="jp-toggles">
								<li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>
								<li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a></li>
								<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat"><repeat</a></li>
								<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
							</ul>
						</div>
						<div class="jp-title">
							<ul>
								<li>'.$title.'</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your Flash plugin.
				</div>
			</div>
		</div>
	</div>';
	return do_shortcode ('[raw]'.$return.'[/raw]');	
}
add_shortcode("video", "al_video"); 


/* ****** Display number of comments for specific post ****** */
function al_comments_count($atts) {
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );

	$num = 0;
	$post_id = $id;
	$queried_post = get_post($post_id);
	$cc = $queried_post->comment_count;
		if( $cc == $num || $cc > 1 ) : $cc = $cc.' Comments';
		else : $cc = $cc.' Comment';
		endif;
	$permalink = get_permalink($post_id);

	return '<a href="'. $permalink . '" class="comments_link">' . $cc . '</a>';

}
add_shortcode('comments_count', 'al_comments_count');
	
?>