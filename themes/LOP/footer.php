<footer id="footer-wrapper" role="contentinfo">
    <div id="footer">
        <div class="left-col left">
            <?php	get_sidebar( 'footer' ); ?>
        </div>
        <div class="right-col left">
        	<?php global $data; ?>
			<a href="<?php echo home_url(); ?>" title="Home"><img src="<?php if ( $data['lop_logo_footer']) : echo $data['lop_logo_footer']; else: bloginfo('stylesheet_directory');?>/img/footer-logo.png<?php endif; ?>" alt="Home" /></a>
			<address>
			<?php echo $data['lop_footer_text']; ?>
			</address>
        </div>
        <div class="clear"></div>
    </div>
</footer>
<!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->
<?php wp_footer(); ?>
<?php 
global $data;    
if ( $data['lop_popup_menu'] == 1 ) { 
	include(TEMPLATEPATH.'/library/popup.php'); 
}?>
</body>
</html>