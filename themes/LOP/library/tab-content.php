<?php 
if ( $tab_content == 'full' ) { ?>
    <li>
        <h4 class="post-title-full replace"><?php the_title(); ?></h4>
        <?php the_content(); ?>
        <div class="clear"></div>
    </li>
                            
                            
<?php } elseif ( $tab_content == 'title' ) { ?>

    <li>
        <div class="post-date left"> <?php the_time('M j'); ?></div>
        <h4 class="post-title event-post left"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
        <div class="clear"></div>
    </li>
                            
<?php } elseif ( $tab_content == 'thumbnail' ) { ?>

    <li>
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="tab-thumbnail left"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'tab-thumb', array('class' => 'img-border') ); ?> </a></div>
        <?php } ?>
        <div class="tab-post-content">
            <h4 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
            <?php the_excerpt(); ?>
            <div class="clear"></div>
        </div>
    </li>                   

<?php } else { ?>

    <li>
        <h4 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
        <?php the_excerpt(); ?>
        <div class="clear"></div>
    </li>                   

<?php } ?>
