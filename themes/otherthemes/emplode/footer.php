			<div class="clearer">&nbsp;</div>

		</div>
	</div>
</div>

<div id="dashboard">
	<div id="dashboard_content">
		<div class="center_wrapper">

			<div class="col3 left">
				<div class="col3_content">

					<h4>Blogroll</h4>
					<ul>
						<?php wp_list_bookmarks('title_li=&categorize=0&limit=5'); ?>
					</ul>

				</div>
			</div>

			<div class="col3mid left">
				<div class="col3_content">

					<h4>Tags</h4>
					<p><?php wp_tag_cloud('number=28&smallest=8&largest=14'); ?></p>

				</div>
			</div>

			<div class="col3 right">
				<div class="col3_content">
                                           <?php dynamic_sidebar('footer');  ?>
				
				</div>
			</div>

			<div class="clearer">&nbsp;</div>

		</div>
	</div>
</div>

<div id="footer">
	<div class="center_wrapper">

		<div class="left">
			&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
		</div>
		<div class="right">
			<a href="http://templates.arcsin.se/">Theme</a> by <a href="http://arcsin.se/">Arcsin</a> 
		</div>
		
		<div class="clearer">&nbsp;</div>

	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
