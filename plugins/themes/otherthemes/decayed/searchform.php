<h2 class="decay">Search</h2>
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<div><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" size="12" class="sfield" />
<input type="submit" id="searchsubmit" value="Search" style="font-size: 10px" />
</div>
</form>