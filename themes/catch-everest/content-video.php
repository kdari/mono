<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package Catch Themes
 * @subpackage Catch Everest
 * @since Catch Everest 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>  
    
	<div class="entry-container post-format">
    
        <header class="entry-header">
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            <h3 class="entry-format"><a href="<?php echo esc_url( get_post_format_link( 'video' ) ); ?>" title="<?php esc_attr_e( 'All Video Posts', 'catch-everest' ); ?>"><?php esc_attr_e( 'Video', 'catch-everest' ); ?></a></h3>
    	</header><!-- .entry-header -->  
    
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
		<?php else : ?>
            <div class="entry-content">
                <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'catch-everest' ) ); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'catch-everest' ), 'after' => '</div>' ) ); ?>
            </div><!-- .entry-content -->
        <?php endif; ?>

        <footer class="entry-meta">
            <?php catcheverest_post_format_meta(); ?>   
            <?php if ( comments_open() ) : ?>
            	<span class="sep"> | </span>
            	<span class="comments-link"><?php comments_popup_link(__('Leave a reply', 'catch-everest'), __('1 Reply', 'catch-everest'), __('% Replies;', 'catch-everest')); ?></span>
            <?php endif; ?>
            <?php edit_post_link( __( 'Edit', 'catch-everest' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
        </footer><!-- .entry-meta -->
        
  	</div><!-- .entry-container -->
    
</article><!-- #post-<?php the_ID(); ?> -->