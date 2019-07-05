<?php
wp_head(); ?>
<div id='page'> <?php
while ( have_posts() ) : the_post();
       the_content();
endwhile;
?> </div>
<?php
wp_footer();