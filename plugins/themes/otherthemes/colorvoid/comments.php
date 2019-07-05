<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<!-- You can start editing here. -->

	<div class="post" id="comments">
		<div class="post_title">
			<h1><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h1>
		</div>

		<div class="post_body nicelist">

<?php if ($comments) : ?>

			<ol>

	<?php foreach ($comments as $comment) : ?>

				<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
					<div class="comment_gravatar left"><?php echo get_avatar( $comment, 32 ); ?></div>
					<div class="comment_author left">
						<span class="comment"><?php comment_author_link() ?></span>
						<div class="date"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> at <?php comment_time() ?></a> <?php edit_comment_link('Edit  comment',' | ',''); ?></div>
					</div>
					<div class="clearer">&nbsp;</div>
					
					<div class="body">

						<?php if ($comment->comment_approved == '0') : ?>
						<p><em>Your comment is awaiting moderation.</em></p>
						<?php endif; ?>

						<?php comment_text() ?>
					</div>
	
				</li>

	<?php $oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : ''; ?>

	<?php endforeach; /* end for each comment */ ?>

			</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<p class="p10 small">&nbsp;</p>
	 <?php else : // comments are closed ?>
		<p class="p10 small">Comments are closed.</p>
	<?php endif; ?>

<?php endif; ?>

<?php if (!$comments) : ?>
			<div class="post_bottom"></div>
<?php endif;?>

		</div>

	</div>

	<div class="post" id="respond">

		<div class="post_title"><h1>Leave a Reply</h1></div>

		<div class="post_body">

<?php if ($post->comment_status == 'open') : ?>

	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>

			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( $user_ID ) : ?>

				<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>

	<?php else : ?>

				<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" class="styled" />
				
				<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>

				<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" class="styled" />
				
				<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>

				<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" class="styled" />
				
				<label for="url"><small>Website</small></label></p>

	<?php endif; ?>

				<p><textarea name="comment" id="comment" cols="100%" rows="6" tabindex="4"></textarea></p>

				<p>
					<input type="image" src="<?php bloginfo('template_directory') ?>/img/button_submit.gif" tabindex="5" />
					<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
				</p>
	<?php do_action('comment_form', $post->ID); ?>

			</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

		</div>

		<div class="post_bottom"></div>

	</div>
