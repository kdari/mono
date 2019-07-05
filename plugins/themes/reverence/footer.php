<!-- BEGIN FOOTER -->
<?php $al_options = isset($_POST['options']) ? $_POST['options'] : get_option('al_general_settings');?>
<div id="footer-wrapper">
	<footer class="container">
		<?php
            $footer_widget_count = isset($al_options['al_footer_widgets_count']) ? $al_options['al_footer_widgets_count']:4;
          	for($i = 1; $i<= $footer_widget_count; $i++){
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Widget ".$i) ) :endif;
			}			
        ?>
        <div class="clear"></div>
        
		<div id="footer-bottom-divider">
        	<a href="#" id="toTop"><img src="<?php echo get_template_directory_uri() ?>/images/back-top.png" width="49" height="49" alt="Back to top" /></a>
        </div>
        
		<div id="footer-bottom">
            <div id="copyright"><?php echo $al_options['al_copyright']?></div>
            <div id="footer-menu">
                <?php  echo do_shortcode($al_options['al_footerinfo']);?>
            </div>        
        </div>
    	<div class="clear"></div>
		
	</footer>        
</div> 
<?php if (isset ($al_options['al_footer_social']) && $al_options['al_footer_social'] !=''):?>
	<div class="bottom-wrapper">
		<div class="container">
			<div id="bottombar">       
				<div id="social">
					<?php echo do_shortcode ($al_options['al_footer_social']) ?>
				</div>
				<div class="clear"></div>
			 </div>
		</div>
	</div>
<?php endif?>
<!-- END FOOTER -->

<?php wp_footer()?>

</body>
</html>