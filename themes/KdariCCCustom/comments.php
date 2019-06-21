<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to ezekiel_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Ezekiel
 * @since Ezekiel 3.0
 */
?>
<section id="page"> 
<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'ezekiel' ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>

            
            <article class="comment-list"> 
            <header> 
				<h2><?php
			printf( _n( 'One Response to "%2$s"', '%1$s Responses to "%2$s"', get_comments_number(), 'ezekiel' ),
			number_format_i18n( get_comments_number() ), '' . get_the_title() . '' );
			?></h2> 
			</header> 
            <section> 
           

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<?php previous_comments_link( __( '&larr; Older Comments', 'ezekiel' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'ezekiel' ) ); ?>
<?php endif; // check for comment navigation ?>
			
			 <ul id="comments"> 
                        <?php
                             $num = 0;
							foreach ($comments as $comment) : ?>
							
								<li class="comment"> 
               
                             
                                        <?php 
										$fb_image_array = get_comment_meta(get_comment_ID(),"fbimage");
										$fb_image = $fb_image_array[0];?>
																			
                                        
                                      
                                        <?php if ($fb_image){?>
                                        <img class="comment-author" src="<?php echo $fb_image; ?>" width="66px" height="66px"/>
                                        <?php }else {echo get_avatar( $comment, 66 );} ?>
                                       
                                        
                                        <aside> 
                                        <span class="meta"> 
                                            <a href="#" class="author"><?php comment_author_link(); ?></a> 
                                            <span class="date-time"><?php comment_date('n-j-Y'); ?></span> 
                                        </span> 

                                        <?php strip_tags(comment_text()); ?>
                                        </aside>		
                                        
                                        <?php if ( $comment->comment_approved == '0' ) : ?>
                                        <em><?php _e( 'Your comment is awaiting moderation.', 'faded' ); ?></em>
                                        
                                        <?php endif; ?>
                                        
                  
              					</li> 
							
							<?php endforeach; ?> 
							
                    </ul>
			</section>
            
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<?php previous_comments_link( __( '&larr; Older Comments', 'ezekiel' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'ezekiel' ) ); ?>
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p><?php //_e( 'Comments are closed.', 'ezekiel' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php
global $cookie;


if (comments_open() == false) {
//comments are closed
?></article><?php
 } else { ?>
            <!-- Leave a Comment -->
			<footer> 
            <?php global $current_user;
				  get_currentuserinfo();
			
				 // echo 'Username: ' . $current_user->user_login . "\n";
				 //echo 'User email: ' . $current_user->user_email . "\n";
				 //echo 'User first name: ' . $current_user->user_firstname . "\n";
				 //echo 'User last name: ' . $current_user->user_lastname . "\n";
				 //echo 'User display name: ' . $current_user->display_name . "\n";
				 //echo 'User ID: ' . $current_user->ID . "\n";
			?>
						 
            <?php 
			
			if ($cookie) { 
     		$user = json_decode(file_get_contents(
			'https://graph.facebook.com/me?access_token=' .
			$cookie['access_token']));
			?>
             
             
             <form name="comment-form" action="<?php bloginfo('url'); ?>/wp-comments-post.php" method="post"> 
					<fieldset> 
						<h3>You are signed in using Facebook. Leave a Comment</h3> 
             <legend class="hide">Comments</legend> 
             <ul>
             <li class="textarea"> 
									<p><textarea name="comment" id="comment_body" rows="12" cols="50"></textarea></p> 
			 </li>	
             <li class="inputs">
            						<p><input type="text" name="author" id="name-input" value="<?php echo $user->first_name. " ". $user->last_name; ?>" /></p> 
									<p><input type="text" name="email" id="email-input" value="<?php echo $user->email; ?>" /></p> 
									<p><input type="text" name="url" id="web-input" value="Your Website"/></p> 
                                    <input type="hidden" name="fbimage" id="fbimage" value="http://graph.facebook.com/<?php echo $user->id; ?>/picture" />
                                    <input type='hidden' name='comment_post_ID' value='<?php the_ID(); ?>' id='comment_post_ID' />
               						<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
                                    <p><input type="submit" id="submit-comment" value="Send us your comment" /></p> 
                                    </li> 
							</ul> 
					</fieldset> 
				</form>	
			
             
           
    		<?php } else { ?>
            
            
     		  <form name="comment-form" action="<?php bloginfo('url'); ?>/wp-comments-post.php" method="post"> 
					<fieldset> 
						<h3>Leave a Comment</h3> 
						<legend class="hide">Comments</legend> 
							<ul> 
								<li class="textarea"> 
									<p><textarea name="comment" id="comment-text"></textarea></p> 
								</li>							
								<li class="inputs"> 
                                 <?php if ( is_user_logged_in() ) {  ?> 
									<input type="hidden" id="name-input" name="author" value="<?php echo $current_user->user_login; ?>" />
                                    <input type="hidden" id="email-input" name="email" value="<?php echo $current_user->user_email; ?>" />
                                 <?php } else{ ?>
                                 	<p><input type="text" id="name-input" name="author" /></p> 
                                    <p><input type="text" id="email-input" name="email"/></p>
                                 <?php } ?>
									
                                    <input type='hidden' name='comment_post_ID' value='<?php the_ID(); ?>' id='comment_post_ID' />
                					<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
                                     <p><input type="submit" id="submit-comment" value="Send us your comment" /></p> 
								</li> 
							</ul> 
                           
           		<?php if (get_option('cap_facebook_comments') == "true"){?>
                <h3>Or comment using your Facebook account:</h3><br /><fb:login-button perms="email" style="float:left;"></fb:login-button>
                <?php } ?>
					</fieldset> 
				</form>	
               </footer> 
               </article>
			
<?php } } ?>

</section>