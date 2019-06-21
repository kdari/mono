			<div id="right">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar") ) : ?>

							

				<div class="sidemenu">	

					<h3>Categories</h3>

					<ul>				

						<?php wp_list_categories('title_li=&depth=1'); ?>	

					</ul>	

				</div>



				<div class="sidemenu">	

					<h3>Archives</h3>

					<ul>				

						<?php wp_get_archives(); ?>	

					</ul>	

				</div>



<?php wp_list_bookmarks('title_before=<h3>&title_after=</h3>&category_before=<div class="sidemenu">&category_after=</div>'); ?>



<h3>Search</h3>

<?php get_search_form(); ?>



<?php endif; ?>				

					

			</div>	