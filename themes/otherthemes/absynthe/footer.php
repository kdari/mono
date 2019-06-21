	</div>		
	<div id="footer">
	  <div class="inner">
		  <div class="lastfm">
		  <h4>What I'm rocking out to on <img src="<?php bloginfo('template_url') ?>/images/ico-last-fm-trans.png" alt="last.fm" /></h4>
			<?php
				if (function_exists('lastfmrecords_display')) {
					lastfmrecords_display();
				}
			?>
	  	</div>
			<div class="recentcomments">
				<h4>What are people saying?</h4>
				<?php
				if (function_exists('recent_comments')) {
					recent_comments();
				}
				?>
			</div>
      <div class="credits">
       		<p><a href="http://page.ly" title="Wordpress Hosting">WordPress Website</a> Powered by Page.ly</p>

      </div>
		</div>
	</div>

  <?php wp_footer() ?>
  	
</body>
</html>