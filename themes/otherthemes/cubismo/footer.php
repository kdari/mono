<div id="footer">
<ul>
<?php if (is_page()) { $highlight = "page_item"; } else {$highlight = "page_item current_page_item"; } ?>
<li class="<?php echo $highlight; ?>"><a href="<?php bloginfo('url'); ?>">Home</a></li>
<?php wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>
</ul>
<p><a href="#header">Back on top</a></p>
</div>
</div>
</div>
<div id="copyright">
<p>Copyright <?=date('Y')?>.</p>
<p><a href="http://page.ly" title="Wordpress Hosting">WordPress Hosting</a> by Page.ly.</p>
</div>
<?php wp_footer(); ?>
</body>
</html>