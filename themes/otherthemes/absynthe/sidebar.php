			<div id="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
      
      <div class="main">
        <div class="middle">
          <div class="bottom">
            <h2>Categories</h2>
             <ul>
              <? wp_list_cats(); ?>
            </ul>
          </div>
        </div>
      </div>
      
      <? endif; ?>
			</div>