<?php

/**
 * AIT WordPress Framework
 *
 * Copyright (c) 2011, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

?>

<style type="text/css">
.postbox h3{cursor:default;}
#ait-twitter .inside	{margin-top:0; padding:0.5px 0 0 0;}
#ait-twitter #the-comment-list .comment-item{margin:0;min-height:50px;border-top:1px solid #fff;border-bottom:1px solid #DFDFDF;}
#ait-twitter #the-comment-list .comment-item:last-child{border-bottom:none;}
#ait-twitter #the-comment-list .comment-item .avatar{border:3px solid #fff;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;}
.ait-box				{ font-family: arial; font-size: 12px; color: #666666; padding: 15px 15px 5px 15px; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; }
.ait-box:after 			{ content: "."; display: block; height: 0; overflow:hidden; clear: both; visibility: hidden; }
.ait-box p				{ margin: 0px; padding: 0px; margin-bottom: 15px; line-height: 18px; }
.ait-box strong			{ color: #333333; }

.ait-separator			{ width: 100%; height: 10px; line-height: 0px; font-size: 0px; background: url('<?php echo AIT_ADMIN_URL;?>/dashboard/img/separator.png') top center repeat-y #e3e3e3; border-top: 1px solid #FFFFFF; border-bottom: 1px solid #cccccc;}

.ait-button					{ display: block; background: #F6F6F6; border: 1px solid #DFDFDF; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px; -moz-box-shadow: 0px 2px 3px rgba(0,0,0,0.2); -webkit-box-shadow: 0px 2px 3px rgba(0,0,0,0.2); box-shadow: 0px 2px 3px rgba(0,0,0,0.2); font-weight: bold; text-decoration: none; margin-bottom: 20px; }
.ait-button:hover			{ background: #FFFFFF; text-decoration: none; }
.ait-button	.ait-butwrap	{ display: block; border: 1px solid #FFFFFF; background: url('<?php echo AIT_ADMIN_URL;?>/dashboard/img/button.png') top center repeat-x; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; text-shadow: 1px 1px 0px rgba(255,255,255,1);}
.ait-button .subtitle		{ display: block; color: #666666; padding: 10px 15px 4px 15px; line-height: 16px; }
.ait-button:hover .subtitle	{ color: #333333; }
.ait-button .title			{ display: block; color: #666666; padding: 0px 15px 10px 15px; line-height: 24px; font-size: 22px; }

.ait-button.themeforest .title	{color: #9A6A38;}
.ait-button.facebook .title		{color: #3B5998;}
.ait-button.twitter .title		{color: #333333; padding: 10px 15px 0px 15px;}
.ait-button.twitter .subtitle	{padding: 4px 15px 10px 15px;}


#ait-about-us > .inside			{ background: url('<?php echo AIT_ADMIN_URL;?>/dashboard/img/gear.png') bottom left no-repeat; }
.ait-about .ait-logo			{ width: 30%; float: left; text-align: center; }
.ait-about .ait					{ display: block; width: 94px; height: 94px; text-indent: -9999px; background: url('<?php echo AIT_ADMIN_URL;?>/dashboard/img/ait-logo.png') center center no-repeat; margin: auto; margin-bottom: 10px; }
.ait-about .ait-links			{ width: 65%; float: right; text-align: center; padding-top: 6px; }
.ait-about .ait-links .ait-wrap	{ padding-right: 5px; }

.ait-themes .themes				{ list-style-type: none; margin: 0px 0px 10px 0px; padding: 0px; }
.ait-themes .themes:after 		{ content: "."; display: block; height: 0; overflow:hidden; clear: both; visibility: hidden; }
.ait-themes .themes li			{ width: 70px; float: left; margin-right: 10px; margin-bottom: 10px; position: relative; }
.ait-themes .themes li:hover	{ z-index: 1000; }
.ait-themes .themes a			{ display: block; }
.ait-themes .themes .thumb		{ display: block; width: 60px; height: 60px; padding: 4px; border: 1px solid #DFDFDF; background: #FFFFFF; }
.ait-themes .themes .preview			{ display: none; }
.ait-themes .themes a:hover .preview	{ display: block; position: absolute; left: 50px; bottom: 50px; padding: 5px; border: 1px solid #DFDFDF; background: #FFFFFF; -moz-box-shadow: 0px 2px 5px rgba(0,0,0,0.3); -webkit-box-shadow: 0px 2px 5px rgba(0,0,0,0.3); box-shadow: 0px 2px 5px rgba(0,0,0,0.3);}

.ait-twitter .ait-twheader				{ text-align: center; background: url('<?php echo AIT_ADMIN_URL;?>/dashboard/img/world.png') center center no-repeat; padding: 0px; }
.ait-twitter .ait-twheader .ait-wrap	{ background: url('<?php echo AIT_ADMIN_URL;?>/dashboard/img/shadow.png') center top no-repeat; padding: 20px 15px 20px 15px;}
.ait-twitter .ait-twheader .ait-button	{ width: 65%; margin: auto; }
.ait-twitter .tw-logo					{ display: block; width: 180px; height: 37px; text-indent: -9999px; margin: auto; background: url('<?php echo AIT_ADMIN_URL;?>/dashboard/img/twitter-logo.png') center center no-repeat; margin-bottom: 10px; }
.ait-twitter .ait-twbody				{ padding: 0px; }
#ait-theme-doc-content {margin-right:15px;overflow:hidden;}

#ait-dashboard-page .postbox 	{min-width: inherit; }

#ait-theme-doc-content .aligncenter		{ display: block; margin: auto; }
#ait-theme-doc-content .alignleft		{ float: left; margin-right: 20px;  }
#ait-theme-doc-content .alignright		{ float: right; margin-left: 20px;  }
#ait-theme-doc-content img				{ max-width: 95%; height: auto !important; border: 5px solid #EEEEEE; margin-bottom: 20px;}
#ait-theme-doc-content ul				{ padding: 0px 0px 0px 16px; list-style-type: disc; margin-bottom: 20px; }
#ait-theme-doc-content p				{ margin: 0px 0px 20px 0px; line-height:1.7; }
#ait-theme-doc-content .ait-theme-doc-update	{ border-bottom: 1px solid #DDDDDD; padding-bottom: 7px; margin-bottom: 30px; }

#ait-theme-doc h2				{ margin-bottom: 20px; }
#ait-theme-doc-content h3		{ padding:0; margin-bottom:20px; }
#ait-theme-doc .date			{ display: block; float: left; margin-right: 15px; text-align: center; padding: 9px 7px; border: 1px solid #DDDDDD; margin-top: 10px; border-radius: 3px; }
#ait-theme-faq #ait-theme-doc .date	{ display: none; }
#ait-theme-doc h1				{ font-size: 20px; font-weight: normal; margin: 0px; margin-bottom: 5px; }
#ait-theme-doc h1 a				{ text-decoration: none; }
#ait-theme-doc h1 a:hover		{ text-decoration: underline; }
#ait-theme-doc p				{ margin: 0px;}
#ait-theme-doc .dated-content	{ display: block; padding: 10px 0px; }

#ait-theme-doc-sidebar #ait-theme-doc h3			{ cursor: default; }
#ait-theme-doc-sidebar #ait-theme-doc h2			{ font-size: 16px; margin-bottom: 15px; }
#ait-theme-doc-sidebar #ait-theme-doc h1			{ font-size: 13px; margin-bottom: 5px; margin-top: 0px; }
#ait-theme-doc-sidebar #ait-theme-doc h1 a			{ text-decoration: none; }
#ait-theme-doc-sidebar #ait-theme-doc h1 a:hover	{ text-decoration: underline; }
#ait-theme-doc-sidebar #ait-theme-doc .date			{ display: none; }
#ait-theme-doc-sidebar #ait-theme-doc p				{ margin: 0px;}
#ait-theme-doc-sidebar #ait-theme-doc .dated-content	{ display: block; border-top: 1px solid #dddddd; padding: 10px 0px; }
</style>
<?php

global $aitDashboardPages;

$aitDashboardPages = array(
	'dashboard' => 	__('Dashboard', THEME_CODE_NAME),
	'docs' => 		__('Documentation', THEME_CODE_NAME),
	'faq' => 		__('FAQ', THEME_CODE_NAME),
	'videos' => 	__('Videos', THEME_CODE_NAME),
	'support' => 	__('Support Forum', THEME_CODE_NAME),
);

$aitDashboardWidgets = array();



function aitAddDashboardWidgets($widgets)
{

	foreach($widgets as $widget){
		$GLOBALS['aitDashboardWidgets'][] = array(
				'id' => $widget[0],
				'title' => $widget[1],
				'content_callback' => $widget[2],
				'params' => isset($widget[3]) ? $widget[3] : array(),
		);

	}
}



function aitDashboard()
{

	$i = 0;
	$c = count($GLOBALS['aitDashboardWidgets']);
	foreach($GLOBALS['aitDashboardWidgets'] as $widget):
		if($i % 3 == 0 or $c < 4):
	?>
			<div class="postbox-container" style="width:49%;">
				<div  class="meta-box-sortables">
		<?php endif; ?>
					<div id="ait-<?php echo $widget['id']; ?>" class="postbox">
						<h3><span><?php echo $widget['title']; ?></span></h3>
						<div class="inside">
							<?php call_user_func($widget['content_callback'], $widget['params']); ?>
						</div>
					</div>
			<?php if(($i + 1) % 3 == 0 or $i == ($c - 1) or $c < 4): ?>
				</div>
			</div>
	<?php
		endif;
		$i++;
	endforeach;
}



function aitDashboardTabs()
{
	(!isset($_GET['tab'])) ? $current = '' : $current = $_GET['tab'];

	$links = '';
	$i = 0;

	foreach($GLOBALS['aitDashboardPages'] as $tabKey => $tabTitle){
		($i != 0) ? $tabSlug = '&amp;tab=' . $tabKey : $tabSlug = '';

		if($tabKey == $current){
			$active = ' nav-tab-active';
		}else{
			($current == '' and $i == 0) ? $active = ' nav-tab-active' : $active = ''; // activate first item
		}

		$links .= '<a class="nav-tab' . $active .'" href="admin.php?page=ait-admin' . $tabSlug .'">' . $tabTitle . '</a>';

		$i++;
	}

	return $links;
}



function aitIsDashboardHome()
{
	if(!isset($_GET['tab']))
		return true;
	else
		return false;
}



function aitDashboardPages()
{

	(!isset($_GET['tab'])) ? $currentTab = '' : $currentTab = $_GET['tab'];

	if($currentTab == ''){
		return; // do nothing
	}elseif(isset($GLOBALS['aitDashboardPages'][$currentTab])){
		$f = dirname(__FILE__) . "/ait-dashboard-$currentTab.php";
		if(is_file($f))
			require_once $f;
		else
			wp_die('This page does not exist', 'This page does not exist', array('response' => 404, 'back_link' => true));
	}else{
		wp_die('This page does not exist', 'This page does not exist', array('response' => 404, 'back_link' => true));
	}
}



/**
 *
 * @param string $url Requested URL
 * @param array $params
 * @return string HTML content
 */
function aitCachedDocsRequest($url, $params)
{
	$cacheTransient = 'doc_' . md5($url);
	$cache = get_transient($cacheTransient);

	if($cache !== false){
		return $cache;
	}else{

		$request = wp_remote_get($url);

		if(!is_wp_error($request)){

			if($request['response']['code'] == 200){
				$payload = $request['body'];

				$payload = str_replace("\r", '', $payload);
				$dom = new DOMDocument;
				$dom->encoding = 'UTF-8';
				@$dom->loadHTML($payload);

				$docUrlLength = strlen($params['docUrl']);

				$div = $dom->getElementById($params['id']);

				foreach($div->getElementsByTagName('a') as $a){

					// do not change href with url to images
					if($a->hasChildNodes()){
						$imgs = $a->getElementsByTagName('img');
						if($imgs->length != 0){
							continue;
						}
					}

					$oldHref = $a->getAttribute('href');
					$href = substr($oldHref, $docUrlLength);
					$pos = strpos($href, '?') - 1;
					$href = substr($href, 0, $pos);

					$a->setAttribute('href', $params['adminDocUrl'] . $href);
				}

				$payload = $dom->saveXML($div);
				set_transient($cacheTransient, $payload, $params['expire']);

				return $payload;
			}else{
				return $request;
			}

		}else{
			return false;
		}
	}
}