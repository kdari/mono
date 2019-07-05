<?php
/*
Campaign JS
Code and stuff you need for the Campaign theme
*/
?>
<script type="text/javascript">
			/* <![CDATA[  */ 
			jQuery(document).ready(function($){
			
				// load mobile menu
				$('#main_menu ul.menu').mobileMenu();
				
				if (!$.browser.opera) {
			        $('select.select-menu').each(function(){
			            var title = $(this).attr('title');
			            if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
			            $(this)
			                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
			                .after('<span class="select">' + title + '</span>')
			                .change(function(){
			                    val = $('option:selected',this).text();
			                    $(this).next().text(val);
			                    })
			        });
			    };
				
				
				// Children Flyout on Menu
				$("#main_menu ul li ul").css({display: "none"}); // Opera Fix
				$("#main_menu ul li").hover(function(){
					$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(300);
					},function(){
					$(this).find('ul:first').css({visibility: "hidden"});
				});
				
				<?php if (is_front_page()) { ?>
				// The Slider
				$(function(){
					$('#slides').slides({
						preload: true,
						preloadImage: '<?php echo get_template_directory_uri('template_url'); ?>/images/loading.gif',
						play: <?php echo stripslashes(of_get_option('slider_time')); ?>000,
						pause: 10000,
						hoverPause: true,
						effect: '<?php echo stripslashes(of_get_option('slider_fx')); ?>'
					});
				});
				<?php } if ((of_get_option('sticky_header') == 'yes') && (of_get_option('body_display') == 'body_span')) { ?>
				$("#header").sticky({topSpacing:0});
				<?php } ?>
				
				// Turn on that SlabText
        		function slabTextHeadlines() {
        			$('.slabload').fadeIn(1000); // fade in after it's loaded
                	$(".slabwrap h1").slabText({
                		// Don't slabtext the headers if the viewport is under 380px
                		"viewportBreakpoint":380
                	});
        		};
        
        		// give it a second to load fonts
        		$(window).load(function() {
         	       setTimeout(slabTextHeadlines, 1000);
       			});
			
				// Adds class to commenters
				$("ul.commentlist li:not(.bypostauthor)").children(".the_comment").addClass("not_author");
				
				
				// Fancybox
				$(".lightbox").attr('rel', 'gallery').fancybox({
					'transitionIn'		: 'fade',
					'transitionOut'		: 'fade'
				});
				
				//Animates comment links, the logo and toggles on hover, no IE
				if(!$.browser.msie){
					// Animates the soc nets on hover
					$("#socnets").delegate("img", "mouseover mouseout", function(e) {
						if (e.type == 'mouseover') {
							$("#socnets a img").not(this).dequeue().animate({opacity: "0.3"}, 300);
    					} else {
							$("#socnets a img").not(this).dequeue().animate({opacity: "1"}, 300);
   						}
					});
					
					$("#the_logo").hover(function(){
						$(this).fadeTo(100, 0.8); 
					},function(){
						$(this).fadeTo(100, 1);
					});
					
					<?php if (is_front_page()) { ?>
					// Recent Blog Post hovers
					$('.single_latest img').hover(function(){
						$(this).stop().fadeTo(200, .8);
					},function(){
						$(this).stop().fadeTo(200, 1);
					});
					<?php } if (is_home()) { ?>
					// Blog Post hovers
					$('.attachment-blog_image').hover(function(){
						$(this).stop().fadeTo(200, .8);
					},function(){
						$(this).stop().fadeTo(200, 1);
					});
					<?php } ?>
				};
				
				// place a break in the event lists
				$('.when').each(function() {
					$(this).html($(this).html().replace('-','-<br/>'));
				});
				
				// clean up the WP Email Capture widget
				$('#wp_email_capture').parent().addClass('wp_email_capture_wrap');
				$('#wp_email_capture').parent().parent().parent().addClass('wp_email_slide');
				$('#wp_email_capture').find('br').remove();

				// put title in fields
				$("input[type='text']").focus(function(srcc) {
					if ($(this).val() == $(this)[0].title) {
						$(this).removeClass("wp-email-capture-active");
						$(this).val("");
					}
				});
    			$("input[type='text']").blur(function() {
					if ($(this).val() == "") {
						$(this).addClass("wp-email-capture-active");
						$(this).val($(this)[0].title);
					}
				});
				$("input[type='text']").blur();
				
				$('#slide_widget').fadeIn(1000); // fade in after it's loaded
				 		
				// Adds clear after overflow widgets
				$('<div class="clear"></div>').insertAfter('.footer_widget_overflow .footer_widget:nth-child(3n), .banner_widget_overflow .widget:nth-child(3n), #home_latest_posts .single_latest:nth-child(3n+1)');

			});			
			/* ]]> */
		</script>