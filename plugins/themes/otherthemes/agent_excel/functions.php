<?php
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'left_sidebar',
'before_widget' => '<div class="box"><div class="boxInner">',
'after_widget' => '</div></div>',
'before_title' => '<h3 class="bTitle">',
'after_title' => '</h3>',
));

register_sidebar(array('name'=>'extra_widget',
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
?>