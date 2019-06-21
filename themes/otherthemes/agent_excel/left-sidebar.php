
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('left_sidebar') ) : ?>
            	<div class="box">
					<div class="boxInner">
						<h3 class="bTitle"><?php _e('Categories'); ?></h3>
						<ul>
							<?php wp_list_cats('sort_column=name&children=1'); ?>
						</ul>
					</div>
				</div>
				<?php endif; ?>
				
