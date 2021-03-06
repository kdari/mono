<?php
/**
 * @package Quintus
 */

get_header(); ?>

		<section id="primary">
			<div class="content" id="content" role="main">

				<header class="page-header">
					<h1 class="page-title">
						<?php
							if ( is_author() ) :
								printf( __( 'Author Archives: %s', 'quintus' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
							elseif ( is_category() ) :
								printf( __( 'Category Archives: %s', 'quintus' ), '<span>' . single_cat_title( '', false ) . '</span>' );
							elseif ( is_tag() ) :
								printf( __( 'Tag Archives: %s', 'quintus' ), '<span>' . single_tag_title( '', false ) . '</span>' );
							elseif ( is_day() ) :
								printf( __( 'Daily Archives: %s', 'quintus' ), '<span>' . get_the_date() . '</span>' );
							elseif ( is_month() ) :
								printf( __( 'Monthly Archives: %s', 'quintus' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
							elseif ( is_year() ) :
								printf( __( 'Yearly Archives: %s', 'quintus' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
							else :
								_e( 'Archives', 'quintus' );
							endif;
						?>
					</h1>
					<?php
						if ( is_category() ) :
							$categorydesc = category_description();
							if ( ! empty( $categorydesc ) )
								echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' );
						endif;
					?>
				</header>

				<?php rewind_posts(); ?>

				<?php /* Display navigation to next/previous pages when applicable */ ?>
				<?php if ( $wp_query->max_num_pages > 1 ) : ?>
					<nav id="nav-above">
						<h1 class="section-heading"><?php _e( 'Post navigation', 'quintus' ); ?></h1>
						<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'quintus' ) ); ?></div>
						<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'quintus' ) ); ?></div>
					</nav><!-- #nav-above -->
				<?php endif; ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php /* Display navigation to next/previous pages when applicable */ ?>
				<?php if ( $wp_query->max_num_pages > 1 ) : ?>
					<nav id="nav-below">
						<h1 class="section-heading"><?php _e( 'Post navigation', 'quintus' ); ?></h1>
						<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'quintus' ) ); ?></div>
						<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'quintus' ) ); ?></div>
					</nav><!-- #nav-below -->
				<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>