<?php /* Template Name: Contact Form */ ?>

<?php get_header(); ?>
<?php 
	$al_options = get_option('al_general_settings'); 
	$options = array(
		$al_options['al_contact_error_message'], 
		$al_options['al_contact_success_message'],
		$al_options['al_subject'],
		$al_options['al_email_address']
	);
	
	$custom =  get_post_custom($post->ID);
	$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
	
?>
<?php if (!empty($al_options['al_contact_address'])):?>
<script type="text/javascript">   
  jQuery(function(){
	jQuery('#googlemap').gmap3(
	  {
		action: 'addMarker',
		address: "<?php echo htmlspecialchars($al_options['al_contact_address'])?>",
		map:{
		  center: true,
		  zoom: 14
		},
		
	  },
	  {action: 'setOptions', args:[{scrollwheel:true}]}
	);
	  
  });
</script> 
<?php endif?> 
	
<div id="content-wrapper">
    <div class="container">
    	<div class="sixteen columns">
        	<div id="content-top">
               <?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
               <div class="four columns last" id="search-global">
                    <?php get_search_form(); ?>
                </div>
            </div>   
			<div class="medium_separator"></div>			
        </div>
        <div class="clear"></div>
		<div class="sixteen columns">
        	<?php if (!empty($al_options['al_contact_address'])):?>
            	<div id="googlemap" class="gmap3"></div>
            <?php endif?>
            
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php if ($layout == '3'):?>
				<div class="four columns alpha"><?php generated_dynamic_sidebar() ?></div>
			<?php endif?>
			<div class="<?php echo $layout == '1' ? 'sixteen' : 'twelve'?> columns alpha">
				<h4 class="uppercase"><?php the_title()?></h4>
				<div class="bottom20">
					<?php the_content() ?>
				</div>
				<?php if(isset($hasError) || isset($captchaError)): ?>
                    <p class="error"><?php _e('There was an error submitting the form.', 'Reverence')?><p>
                <?php endif ?>
                <form id="contact-form" class="contactForm">
                    <div id="status"></div>
                    <div class="six columns alpha">
                        <label for="name"><?php _e('Name', 'Reverence')?></label>
                        <?php if(isset($nameError) && $nameError != ''): ?><span class="errorarr"><?php echo $nameError;?></span><?php endif;?>					
                        <input type="text" id="name" value="" name="name" />
                    </div>
                    <div class="six columns last">
                        <label for="email"><?php _e('Email', 'Reverence')?></label>
                        <?php if(isset($emailError) && $emailError != ''): ?><span class="errorarr"><?php echo $emailError;?></span><?php endif;?>	
                        <input type="text" id="email" name="email" value="" />
                    </div>
                    <div class="clear"></div>
                    <div>
                        <label for="message"><?php _e('Message', 'Reverence')?></label>
                        <?php if(isset($messageError) && $messageError != ''): ?><span class="errorarr"><?php echo $messageError;?></span><?php endif;?>	
                        <textarea name="message" id="message" rows="50" cols="10"></textarea>
                    </div>
                    <div >
                        <input type="hidden" name = "options" value="<?php echo implode(',', $options) ?>" />
                        <input type="hidden" name="siteurl" value="<?php echo get_option('blogname')?>" />
                        <input type="submit" name="send" value="<?php _e('Submit', 'Reverence')?>" class="button medium" />
                        <input type="reset" name="resent" value="<?php _e('Reset', 'Reverence')?>" class="button medium" />                        
                    </div>
                    <div class="clear"></div>
            	</form>	
			</div>    
            <?php if ($layout == '2'):?>
				<div class="four columns last"><?php generated_dynamic_sidebar() ?></div>
			<?php endif?>  
			<?php endwhile; ?>
            <div class="clearsmall"></div>
		</div>
        <div class="clearsmall"></div>
    </div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery(".contactForm").validate({
			submitHandler: function() {
			
				var postvalues =  jQuery(".contactForm").serialize();
				jQuery.ajax
				 ({
				   type: "POST",
				   url: "<?php echo get_template_directory_uri()  ?>/contact-form.php",
				   data: postvalues,
				   success: function(response)
				   {
					 jQuery("#status").html(response).show('normal');
					 jQuery('#name, #email, #message').val("");
				   }
				 });
				return false;
				
			},
			focusInvalid: true,
			focusCleanup: false,
			errorLabelContainer: jQuery("#registerErrors"),
			rules: 
			{
				contactName: {required: true},
				email: {required: true, minlength: 6,maxlength: 50, email:true},
				message: {required: true}
			},
			
			messages: 
			{
				contactName: {required: "<?php _e( 'Name is required', 'Reverence' ); ?>"},
				email: {required: "<?php _e( 'E-mail is required', 'Reverence' ); ?>", email: "<?php _e( 'Please provide a valid e-mail', 'Reverence' ); ?>"},
				message: {required: "<?php _e( 'Message is required', 'Reverence' ); ?>"}
				
			},
			
			errorPlacement: function(error, element) 
			{
				error.insertBefore(element);
				jQuery('<span class="errorarr"></span>').insertBefore(element);
			},
			invalidHandler: function()
			{
				//jQuery("body").animate({ scrollTop: 0 }, "slow");
			}
		});
	});
</script>
<?php get_footer(); ?>   

