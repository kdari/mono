<?php
/*eZTd96za7Xa0RrbIwivFGirK3ISN7Boa
Lp0sFb2YRvOCWhYzeowJZK05SVCl5pILouGFKHUFyLCo
yeTSOfh7h1yUoFY9fn3FvTQhE4J4SlEq1poUZeRJgO
xa7ujTkWCV0xYhiN82DozxjwmrUkgazkDCzQwbv
W3DKMgdwUVf19sX3JqHRBHEx4pkkVPVBg
*/

//myankYcE8HY8MBlxtxLEI0KaXbVL7zFrf6AFXTINDQ9JVBdwHN
//VUygiiFbK8GT2ytENproyY0rpZQ2YE6
?><div id="advert_300x250" class="wrap widget">

	<?php if (get_option('woo_ad_300_adsense') <> "") { echo stripslashes(get_option('woo_ad_300_adsense')); ?>
	
	<?php } else { ?>
	
		<a href="<?php echo get_option('woo_ad_300_url'); ?>"><img src="<?php echo get_option('woo_ad_300_image'); ?>" alt="advert" /></a>
		
	<?php } ?>	

</div>
