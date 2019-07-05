								<h2>
									<?php if (is_page() || is_single()) { ?>
										<?php the_title(); ?>
									<?php } else { ?>
										<a href="<?php the_permalink() ?>" title="<?php _e('Permanent Link to', 'default'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									<?php } ?>
								</h2>
								<div class="info">
									<?php if (!is_page()) { ?>
									<span class="date"><?php _e('Posted on', 'default'); ?> <?php the_time(__('F jS, Y', 'default')) ?></span>
									<span class="author"><?php the_author() ?></span>
									<span class="comment">
										<a href="<?php comments_link(); ?>"><?php comments_number( __( 'No comments', 'default' ), __( '1 comment', 'default' ), __( '% comments', 'default' ),  __( 'comments', 'default' )); ?></a>

									</span>
									<?php } ?>
								</div>

								<?php the_content(__('Read the rest of this entry &raquo;', 'default')); ?>
								<div class="clear"></div>

								
								<div class="info">
									<?php if (!is_page()) { ?>
										<?php if ($gear_cat_visibility == "on") { ?>
									<span class="cat block"><?php the_category(', ') ?></span>
										<?php } ?>

									<?php the_tags('<span class="tag block">', ', ', '</span>'); ?>
									<?php } ?>
									
									<?php edit_post_link(__('Edit', 'default'), '<span class="edit block">', '</span>'); ?>
								</div>
								