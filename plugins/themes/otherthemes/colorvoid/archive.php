<?php get_header(); ?>

		<?php if (have_posts()) : $post = $posts[0]; $odd = 'class="alt" '; ?>

			<?php if ( is_paged() || count($posts) >= get_option('posts_per_page') ) : ?>

		<div class="pagenavigation">
			<div class="pagenav">
				<div class="left"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				<div class="clearer">&nbsp;</div>
			</div>
			<div class="pagenav_bottom"></div>
		</div>

			<?php endif;?>

		<div class="post">
			<div class="post_title">
				<h1>
		<?php /* If this is a category archive */ if (is_category()) { ?>
				Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				Archive for <?php the_time('F jS, Y'); ?>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				Archive for <?php the_time('F, Y'); ?>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				Archive for <?php the_time('Y'); ?>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				Author Archive
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				Blog Archives
		<?php } ?>
				</h1>
			</div>

			<div class="post_body nicelist">

				<ol>
		<?php while (have_posts()) : the_post(); ?>
					<li <?php echo $odd; ?> id="post-<?php the_ID(); ?>">

						<div class="archive_title">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</div>

						<div class="archive_postinfo">
							<div class="date"><?php the_date('l jS F, Y') ?> in <?php the_category(', ') ?> - <?php comments_popup_link('No Comments', '1 comment', '% comments'); ?><?php edit_post_link('Edit post', ' | ', ''); ?></div>
						</div>

					</li>
			<?php $odd = ( empty( $odd ) ) ? 'class="alt" ' : ''; ?>
		<?php endwhile; ?>
				</ol>

			</div>

		</div>

		<?php if ( count($posts) >= get_option('posts_per_page') ) : ?>

		<div class="pagenavigation">
			<div class="pagenav">
				<div class="left"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				<div class="clearer">&nbsp;</div>
			</div>
			<div class="pagenav_bottom"></div>
		</div>

		<?php endif;?>

	<?php else : ?>

		<div class="post">

			<div class="post_title"><h1>Not Found</h1></div>

			<div class="post_body">
				<p>Sorry, but you are looking for something that isn't here.</p>
			</div>

			<div class="post_bottom"></div>

		</div>		

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
