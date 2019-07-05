			<div class="header span-24">
				<div class="intro span-18">
					<div class="intro-wrapper paddings">
						<?php if (is_home()) { ?>
							<h1 class="logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
						<?php } else { ?>
							<span class="logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></span>
						<?php } ?>
						<span class="slogan"><?php bloginfo('description'); ?></span>
					</div>
				</div>

				<div class="icons span-6 last">
					<div class="paddings">
						<div class="icons-wrapper">
							<a href="<?php bloginfo('rss2_url'); ?>" title="RSS link"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/ico/rss.gif" alt="<?php _e('RSS icon', 'default'); ?>" /></a>
							<?php if ($gear_email_visibility == "on") { ?>
							<a href="mailto:<?php echo antispambot(get_option('admin_email')); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/ico/mail.gif" alt="<?php _e('Email icon', 'default'); ?>" /></a>
							<?php } ?>
							<a href="<?php echo get_option('home'); ?>/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/ico/home.gif" alt="<?php _e('Home icon', 'default'); ?>" /></a>
						</div>
						
						<?php if ($gear_search_visibility == "on") { ?>
						<div class="search fr">
							<?php include (TEMPLATEPATH . "/searchform.php"); ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="menu span-24">
				<ul class="menu-wrapper">
										
					<?php if ($gear_pages_visibility == "on") { ?>
					<?php $exclude_pages = get_option('gear_pages_to_exclude'); ?>
					<?php wp_list_pages('sort_column=menu_order&depth=1&title_li=&exclude=' . $exclude_pages);?>
					<?php } ?>
					
					<?php if ($gear_cats_menu_visibility == "on") { ?>
					<?php $exclude_cats = get_option('gear_cats_to_exclude'); ?>
					<?php wp_list_categories('orderby=name&depth=1&title_li=0&show_count=1&exclude=' . $exclude_cats); ?>
					<?php } ?>
				</ul>
			</div>