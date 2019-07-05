	<div class="homesidebar">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
		<div class="item">
			<h3>Categories:</h3>
			<ul>
				<?php wp_list_categories('show_count=1&title_li='); ?>
			</ul>
		</div>
		<div class="item">
			<h3>Blogroll:</h3>
			<ul>
				<?php wp_list_bookmarks('categorize=0&title_li'); ?>
			</ul>
		</div>
	<?php endif; ?>
		<?php 
		$eadv = get_option("eadv"); 
		if ($eadv !== "disable") { ?>
		<div class="item">
			<span class="smalltitle">Advertising:</span>
			<?php
				$small_ad = get_option("small_ad");
				$small_ad = stripslashes($small_ad);

				if($small_ad == "") {
					echo "Go to Wordpress Dashboard &raquo; Design Tab &raquo; Brightness Settings and add advertising codes!";
				}
				else {
					echo $small_ad;
				}
				?>
		</div>
		<?php } ?>
	</div>