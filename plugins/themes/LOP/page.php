<?php get_header(); ?>
    	<div id="content">
    		<div id="content-left">
				<?php include (TEMPLATEPATH . '/library/header-images.php'); ?>
    			<div id="main-content"  role="main">
    				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix post'); ?> role="article">

                            <header>
                                <h1 class="page-title replace" itemprop="headline"><?php the_title(); ?></h1>
                            </header> <!-- end article header -->

                            <section class="post_content clearfix" itemprop="articleBody">
                                <?php the_content(); ?>
                            </section> <!-- end article section -->

                            <footer>
                            </footer> <!-- end article footer -->

                        </article> <!-- end article -->

    				<?php endwhile; else : ?>

                        <article id="post-not-found post">
                            <header>
                                <h1><?php __('Not Found', 'lop') ?></h1>
                            </header>
                            <section class="post_content">
                                <p><?php __('Sorry, but the requested resource was not found on this site.','lop') ?></p>
                            </section>
                            <footer>
                            </footer>
                        </article>

                    <?php endif; ?>
    			</div>
    		</div>
    		<div id="content-right">
        		<?php get_sidebar(); ?>
    		</div>
    	</div>
    	<!--content end-->
    </div>
    <!--main end-->
</div>
<!--wrapper end-->
<div class="clear"></div>
<?php get_footer(); ?>