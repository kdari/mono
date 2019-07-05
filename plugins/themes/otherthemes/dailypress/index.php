<?php get_header(); ?>
<div id="left">
<div id="content">
<?php if ( $paged < 2 ) { // Do stuff specific to first page?>

<?php $my_query = new WP_Query('showposts=1');
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID; ?>
<div class="entry">
<h2 class="sectionhead"><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.gif" alt="Main Content RSS Feed" title="Main Content RSS Feed" style="float:right; margin-left:5px;" /></a>Latest Entry</h2>
	
<div class="post" id="post-<?php the_ID(); ?>">
						
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

<p class="postinfo"><span class="upper"><?php the_time('M j, Y') ?></span> <span class="category"><?php the_category(', ') ?></span> <span class="comment"><?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?><?php edit_post_link('Edit', ' | ', ''); ?></span></p>


						<?php the_content('<strong>Read More..</strong>'); ?>
<div class="socials" style="margin-top:0px;">
<a class="btn_email" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink() ?>">E-mail</a>
<a class="btn_comment"  href="#respond">Comment</a>
<a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>" title="Submit to Del.icio.us" target="_blank" class="btn_delicious">Del.icio.us</a>
<a href="http://www.digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>" title="Submit Post to Digg" target="_blank" class="btn_digg">Digg</a>
<a href="http://reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>" title="Submit Reddit" target="_blank" class="btn_reddit">Reddit</a>
<a href="http://technorati.com/faves?add=<?php the_permalink() ?>" title="Submit to Technorati" target="_blank" class="btn_technorati">Technorati</a>
<a href="http://furl.net/storeIt.jsp?t=<?php the_title() ?>&amp;u=<?php the_permalink() ?>" title="Submit to Furl" target="_blank" class="btn_furl">Furl</a>
</div>

</div></div>
  	
<?php endwhile; ?>

<div class="entry">	
<h2 class="sectionhead">Recent Entries</h2>

<?php if (have_posts()) : while (have_posts()) : the_post();
if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>

				<div class="post" id="post-<?php the_ID(); ?>">

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

<p class="postinfo"><span class="upper"><?php the_time('M j, Y') ?></span> <span class="category"><?php the_category(', ') ?></span> <span class="comment"><?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?><?php edit_post_link('Edit', ' | ', ''); ?></span></p>


						<?php the_content('<strong>Read More..</strong>'); ?>

				</div>

<?php endwhile; endif; ?>
</div>
<div class="entry">	
<?php } else { // Do stuff specific to non-first page ?>
	<div class="entry">	
<h2 class="sectionhead">Recent Articles</h2>
<?php if (have_posts()) : while (have_posts()) : the_post();
if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>

<div class="post" id="post-<?php the_ID(); ?>">

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

<p class="postinfo"><span class="upper"><?php the_time('M j, Y') ?></span> <span class="category"><?php the_category(', ') ?></span> <span class="comment"><?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?><?php edit_post_link('Edit', ' | ', ''); ?></span></p>

						<?php the_content('<strong>Read More..</strong>'); ?>

				</div>

<?php endwhile; endif; ?>

<?php } ?>

<div class="navigation">	

					<div class="alignleft">
						<?php next_posts_link('<span class=\'older\'>Older Entries</span>') ?>
					</div>

					<div class="alignright">
						<?php previous_posts_link('<span class=\'newer\'>Newer Entries</span>') ?>
					</div>

                		</div>

</div>
<div class="clear"></div>
</div></div>



<?php get_sidebar(); ?>

<?php get_footer(); ?>
