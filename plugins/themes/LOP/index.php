	<?php get_header(); ?>
    
        <div id="content">
            <div id="content-left">
                <div id="main-content" role="main">
                    <h1 class="replace">Latest News</h1>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix post'); ?> role="article">
                        
                        <header>               
                            <h2 class="line"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                        </header> <!-- end article header -->
                        
                        <section class="post_content clearfix">	   	 	
                            <?php the_post_thumbnail(); ?>
                            <?php the_excerpt(); ?>
                        </section> <!-- end article section -->
            
                        <footer>
                            <p class="meta"><time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time> <?php _e('by', 'lop'); ?> <?php the_author_posts_link(); ?> <?php _e('in', 'lop'); ?> <?php the_category(', '); ?></p>
                            <p class="meta"><?php comments_popup_link('No comments yet', '1 comment', '% comments', '', 'Comments are disabled for this post'); ?></p>	
                        </footer> <!-- end article footer -->
                        
                    </article>    
                
                    <?php endwhile; else: ?>
                    
                    <article id="post-not-found">
                        <header>
                            <h1><?php _e('Not Found', 'lop') ?></h1>
                        </header>
                        <section class="post_content">
                            <p><?php _e('Sorry, but the requested resource was not found on this site.', 'lop'); ?></p>
                        </section>
                        <footer>
                        </footer>
                    </article>
                             
                    <?php endif; ?>
                    <nav id="page-nav">
                        <?php next_posts_link(__('&laquo; Previous Entries','lop')) ?>
                        <?php previous_posts_link(__('Next Entries &raquo;','lop')) ?>
                    </nav>
                                    
                </div>
                <!-- end #main-content -->
            </div>
            <!-- end #content-left -->
        
            <div id="content-right"><?php get_sidebar(); ?></div>
        </div>
        <!-- end #content -->
    
    </div>
    <!--main end-->
</div>
<!--wrapper end-->
<div class="clear"></div>		
<?php get_footer(); ?>