<?php
/**
 * @package Quintus
 */

if ( post_password_required() )
	return;
?>

<div id="comments">

	<?php if ( have_comments() ) : ?>
		<h2 id="comments-title">
			<?php printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'quintus' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments(); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="section-heading"><?php _e( 'Comment navigation', 'quintus' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'quintus' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'quintus' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'quintus' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->