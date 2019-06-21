<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<div>
	<table class="search">
	<tr>
		<td>
			<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
		</td>
		<td style="padding-left: 10px">
			<input type="image" src="<?php bloginfo('template_directory') ?>/img/button_go.gif" />
		</td>
	</tr>
	</table>
</div>
</form>
