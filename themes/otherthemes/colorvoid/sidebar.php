			</div>

		</div>

		<div class="right" id="main_right">
	
			<div id="sidebar">
<?php 	/* Widgetized sidebar, if you have the plugin installed. */
if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

				<?php cdt_subpages() ?>

				<div class="box">
					<div class="box_title">Search</div>
					<div class="box_body">
						<?php include (TEMPLATEPATH . '/searchform.php'); ?>
					</div>
					<div class="box_bottom"></div>
				</div>

				<div class="box">
					<div class="box_title">Archives</div>
					<div class="box_body">
						<ul>
							<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
						</ul>
					</div>
					<div class="box_bottom"></div>
				</div>

				<div class="box">
					<div class="box_title">Categories</div>
					<div class="box_body">
						<ul>
							<?php wp_list_categories('show_count=1&title_li='); ?>
						</ul>
					</div>
					<div class="box_bottom"></div>
				</div>				

				<?php /* If this is the frontpage */ if ( is_home() || is_page() ) : ?>
				
				<div class="box">
					<div class="box_title">Blogroll</div>
					<div class="box_body">
						<ul>
							<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
						</ul>
					</div>
					<div class="box_bottom"></div>
				</div>

				<div class="box">
					<div class="box_title">Meta</div>
					<div class="box_body">
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					</div>
					<div class="box_bottom"></div>
				</div>

				<?php endif; ?>
<?php endif; ?>

			</div>
		</div>
