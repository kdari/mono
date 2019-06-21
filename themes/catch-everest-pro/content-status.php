<?php
/**
 * The template for displaying posts in the Status post format
 *
 * @package Catch Themes
 * @subpackage Catch Everest
 * @since Catch Everest 1.0
 */
//Getting data from Theme Options Panel and Meta Box 
global $catcheverest_options_settings;
$options = $catcheverest_options_settings; 

//More Tag
$moretag = $options[ 'more_tag_text' ];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( function_exists( 'catcheverest_content_image' ) ) : catcheverest_content_image(); endif; ?>
    
	<div class="entry-container post-format">
    
		<div class="entry-header">
            <header>
                <?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'catcheverest_status_avatar', '60' ) ); ?>
                <h1 class="entry-title"><?php the_author(); ?></h1>
            </header>
            <h2 class="entry-format"><a href="<?php echo get_post_format_link( 'status' ); ?>" title="<?php _e( 'All Status Posts', 'catcheverest' ); ?>"><?php _e( 'Status', 'catcheverest' ); ?></a></h2>
		</div><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content( $moretag ); ?>
			<?php wp_link_pages( array( 
                'before'		=> '<div class="page-link"><span class="pages">' . __( 'Pages:', 'catcheverest' ) . '</span>',
                'after'			=> '</div>',
                'link_before' 	=> '<span>',
                'link_after'   	=> '</span>',
            ) ); 
            ?>
		</div><!-- .entry-content -->

        <footer class="entry-meta">
            <?php catcheverest_post_format_meta(); ?>   
            <?php if ( comments_open() ) : ?>
            	<span class="sep"> | </span>
            	<span class="comments-link"><?php comments_popup_link(__('Leave a reply', 'catcheverest'), __('1 Reply', 'catcheverest'), __('% Replies;', 'catcheverest')); ?></span>
            <?php endif; ?>
            <?php edit_post_link( __( 'Edit', 'catcheverest' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
        </footer><!-- .entry-meta -->
        
   	</div><!-- .entry-container -->
         
</article><!-- #post-<?php the_ID(); ?> -->