<?php

/**
 * AIT WordPress Framework
 *
 * Copyright (c) 2011, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */
?>



<?php
aitAddDashboardWidgets(array(
	array('about-us', __('About us', THEME_CODE_NAME), 'aitAboutUsWidget'),
	array('latest-theme', __('Latest / Featured WordPress theme from AIT Themes', THEME_CODE_NAME), 'aitLatestThemeWidget'),
	array('themeforest', __('Awesome WordPress themes from AIT Themes', THEME_CODE_NAME), 'aitThemesWidget'),
	array('twitter', __('Twitter', THEME_CODE_NAME), 'aitTwitterWidget'),
));
?>



<?php function aitAboutUsWidget(){ ?>
				<div class="ait-about">
					<div class="ait-box">

						<div class="ait-logo">
							<div class="ait-wrap">
								<a class="ait" href="http://www.ait-themes.com" target="_blank">ait-themes.com</a>
								<p>tools for your<br /><strong>professional theme</strong><br />administration</p>
							</div>
						</div>

						<div class="ait-links">
							<div class="ait-wrap">
								<a class="ait-button themeforest" href="http://themeforest.net/user/ait/follow" target="_blank">
									<span class="ait-butwrap">
										<span class="subtitle">Follow Us on</span>
										<span class="title">ThemeForest</span>
									</span>
								</a>
								<a class="ait-button facebook" href="http://www.facebook.com/AitThemes" target="_blank">
									<span class="ait-butwrap">
										<span class="subtitle">Follow Us on</span>
										<span class="title">Facebook</span>
									</span>
								</a>
							</div>
						</div>

					</div>
				</div>

<?php } ?>



<?php
/**
 * Twitter widget
 */
function aitTwitterWidget(){

require_once dirname(__FILE__) . '/../libs/simple-twitter.php';
?>
<div class="ait-twitter">

	<div class="ait-box ait-twheader">
		<div class="ait-wrap">
			<a href="http://twitter.com/AitThemes" target="_blank" class="tw-logo">twitter.com</a>
			<a class="ait-button twitter" href="http://twitter.com/AitThemes" target="_blank">
				<span class="ait-butwrap">
					<span class="title">follow us</span>
					<span class="subtitle">and get the news about our products</span>
				</span>
			</a>
		</div>
		<div class="ait-separator"></div>
	</div>

	<div class="ait-box ait-twbody">
		<div class="ait-wrap">

			<?php try{
				$twitter = new SimpleTwitter('AitThemes');
				$channel = $twitter->load(SimpleTwitter::ME, 8);
			?>
			<div id="the-comment-list">
				<?php foreach ($channel as $status): ?>

					<div class="comment-item">
						<img alt="" src="<?php echo $status->user->profile_image_url; ?>" class="avatar" height="50" width="50">
						<div class="dashboard-comment-wrap">
						<h4 class="comment-meta">
							<cite class="comment-author"><strong><?php echo $status->user->screen_name; ?></strong></cite> &nbsp; | &nbsp;
							<small><?php $d = new DateTime($status->created_at); echo $d->format('j.n.Y, H:i:s'); ?></small>
						</h4>
						<blockquote>
							<p>
								<?php echo SimpleTwitter::clickable($status->text); ?>
							</p>
						</blockquote>
						</div>
					</div>
			<?php endforeach;

			}catch(TwitterException $e){
				?><p style="padding:15px;color:#C00;font-style:italic;"><?php echo $e->getMessage(); ?> You can view our tweets directly on Twitter: <a href="http://twitter.com/AitThemes">@AitThemes</a>.</p><?php
			}
			?>
			</div>
		</div>
	</div>
</div>
<?php } ?>



<?php function aitThemesWidget(){

	$url = 'http://www.ait-themes.com/json-export.php?ref=' . urlencode($_SERVER['SERVER_NAME']) . '&from=dashboard';

	$themes = aitCachedRemoteRequest('ait-themes', $url, 1 * 24 * 60 * 60);

	if($themes !== false):
	?>
	<div class="ait-themes">
	<ul class="themes">
	<?php foreach($themes as $theme): ?>
		<?php if($theme->inThemeBox): ?>
		<li>
			<a href="<?php echo $theme->url ?>" target="_blank">
				<img src="<?php echo $theme->thumbnail ?>" class="thumb">
				<img src="<?php echo $theme->preview ?>" class="preview">
			</a>
		</li>
		<?php endif; ?>
	<?php endforeach; ?>
	</ul>
	</div>
	<?php
	endif;
	?>
	<p>You can buy these themes on <a href="http://themeforest.net/user/ait/portfolio">themeforest.net</a>.</p>
<?php
}
?>


<?php function aitLatestThemeWidget(){

	$url = 'http://www.ait-themes.com/json-export.php?ref=' . urlencode($_SERVER['SERVER_NAME']) . '&from=dashboard-latest-theme-widget';

	$themes = aitCachedRemoteRequest('ait-themes', $url, 1 * 24 * 60 * 60);

	if($themes !== false and !empty($themes)):
		$latest = reset($themes);
		if($latest->codeName == THEME_CODE_NAME){
			$latest = next($themes);
		}
		if($latest->inThemeBox): ?>
		<div style="text-align:center;">
			<a href="<?php echo $latest->url ?>" target="_blank">
				<img src="<?php echo $latest->preview ?>" style="max-width:100%">
			</a>
		</div>
		<?php endif; ?>

	<?php
	endif;
}
?>


<div class="wrap">
			<div id="icon-ait" class="icon32"><img src="<?php echo AIT_ADMIN_URL?>/gui/img/ait-logo.png" width="32" height="32"></div>

	<h2 class="nav-tab-wrapper"><a href="http://ait-themes.com" target="_blank">AIT-Themes.com</a>
		<?php echo aitDashboardTabs(); ?>
	</h2>

	<?php if(aitIsDashboardHome()): ?>

	<div id="dashboard-widgets-wrap">
		<div id="dashboard-widgets" class="metabox-holder">

			<?php aitDashboard() ; ?>

		</div> <!-- /#dashboard-widgets -->
		<div class="clear"></div>
	</div> <!-- /#dashboard-widgets-wrap -->
	<?php else: ?>
	<div id="ait-dashboard-page">
		<?php aitDashboardPages(); ?>
	</div>
	 <?php endif; ?>
</div> <!-- /.wrap -->

