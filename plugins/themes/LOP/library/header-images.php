<?php if ( (has_post_thumbnail() && function_exists('has_post_thumbnail'))) { //Display the Featured Image ?>
    <div id="header-img"><?php the_post_thumbnail( 'header-image', array('class' => 'image-border') ); ?></div> 
<?php } else { //Display the images in img/header folder in random order ?>
     <div id="header-img"><img src="<?php bloginfo('template_url'); ?>/library/rotating.php?image=<?php echo mt_rand(0,100); ?>" width="640" alt="<?php bloginfo('name'); __('Rotating Header Image','lop') ?>" title="<?php bloginfo('name'); __('Random Header Image','lop')?>" /></div>
<?php } ?>