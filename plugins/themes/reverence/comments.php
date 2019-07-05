<?php
 
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) : ?>
	<p class="nocomment"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'Reverence' ); ?></p>
</div>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
<!-- You can start editing here. -->
 
<?php if ( have_comments() ) : ?>
<h4 id="comments" class="uppercase">
	<?php printf( _n( 'Comments <sup>(%1$s)</sup>', 'Comments <sup>(%1$s)</sup>', get_comments_number(), 'Reverence' ),
		number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
	?>
</h4>
 

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<div class="navigation">
		<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Reverence' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Reverence' ) ); ?></div>
	</div> <!-- .navigation -->
<?php endif; ?>
 
<ol class="commentlist">
<?php wp_list_comments('callback=Reverence_comment'); ?>
</ol>
 
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Reverence' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Reverence' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>
<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
 
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"><?php _e( 'Comments are closed.', 'Reverence' ); ?></p>
 
<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
 
<div id="respond" class="bottom20">
    <h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>
    <p class="bottom10"><?php _e('Your email address will not be shared or published.', 'Reverence');?></p>
    <div class="cancel-comment-reply bottom10">
        <small><?php cancel_comment_reply_link(); ?></small>
    </div>
 
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p class="bottom20">
            You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> 
            to post a comment.
        </p>
    <?php else : ?> 
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">     
            <?php if ( $user_ID ) : ?>
                <p class="bottom10">
                    <?php _e('Logged in as', 'Reverence')?> 
                    <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. 
                    <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out', 'Reverence')?> &raquo;</a>
                </p>
            <?php else : ?>
             
                <p>
                    <input type="text" name="author" id="author" title="<?php _e('Name', 'Reverence')?>" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                </p>
                 
                <p>
                    <input type="text" name="email" id="email" title="<?php _e('Email', 'Reverence')?>" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                </p>
                 
                <p>
                    <input type="text" name="url" id="url" title="<?php _e('Website', 'Reverence')?>" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
                </p>
             
            <?php endif; ?>
             
            <p>
                <textarea name="comment" title="<?php _e('Comment', 'Reverence')?>" id="comment" cols="100" rows="10" tabindex="4"></textarea>
            </p>
             
            <p>
                <input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit', 'Reverence')?>" style="margin-left:0" class="button medium"  />
                <input name="reset" type="reset" id="reset" tabindex="6" value="<?php _e('Reset', 'Reverence')?>" class="button medium" />
                <?php comment_id_fields(); ?>
            </p>
            <?php do_action('comment_form', $post->ID); ?>
         
        </form>
 
	<?php endif; // If registration required and not logged in ?>
</div>
 
<?php endif;  ?>

