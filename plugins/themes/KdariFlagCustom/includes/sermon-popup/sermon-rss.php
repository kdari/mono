<?php
/*  Copyright 2008  Phil Johnston  (email : info@ideacreations.ca)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



function audiofeed() {
	
	
	$pid = $_GET['pid'];
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array('paged' => $paged, 'post_type' => 'sermons', 'p' => $pid);
	query_posts($args);		
//////////////////////////////////////////////
	$a = 1;
///////////////////////////////

header('Content-type: text/xml; charset=utf-8');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; 
echo '<player>'; 

//while ( have_posts() ) : the_post();
                
echo ('<song name="' . get_the_title($pid) . '" oga="'. get_post_meta($pid, "sermonogg", $single = true) . '" m4a="' . get_post_meta($pid, "sermonmp3", $single = true) . '" />"');
        
//endwhile; 
	
echo '</player>';

}

function add_audio_feed() {
	// echo 'test';
	add_feed('audio', 'audiofeed');
}

add_action('init','add_audio_feed');

?>