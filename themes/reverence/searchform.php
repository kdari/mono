<form action="<?php echo site_url() ?>" method="get" id="search-global-form">   
   	 <div>
		<input type="text" name="s" id="search" title="<?php _e('Search terms', 'Reverence');?>" value="<?php the_search_query(); ?>" />
   		<input type="submit" value="" name="search" />
	</div>
    <div class="clear"></div>
</form>