<?php

global $wp_query;

$thePostID = $wp_query->post->ID;

$meta = get_post_meta($thePostID, "_ait_page_slider" , TRUE);

echo $meta['slider'];

