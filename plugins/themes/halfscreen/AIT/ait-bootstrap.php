<?php

/**
 * AIT WordPress Framework
 *
 * Copyright (c) 2011, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


define('THEME_DIR', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_CSS_DIR', THEME_DIR . '/design/css');
define('THEME_CSS_URL', THEME_URL . '/design/css');
define('THEME_JS_URL', THEME_URL . '/design/js');
define('THEME_IMG_URL', THEME_URL . '/design/img');
define('THEME_FONTS_DIR', THEME_DIR . '/design/fonts');
define('THEME_FONTS_URL', THEME_URL . '/design/fonts');

define('THEME_STYLESHEET_URL', get_bloginfo('stylesheet_url'));
define('THEME_STYLESHEET_FILE', THEME_DIR . '/style.css');

define('THEME_SKINS_DIR', THEME_DIR . "/design/skins");
define('THEME_SKINS_URL', THEME_URL . "/design/skins");

define('AIT_FRAMEWORK_DIR', THEME_DIR . '/AIT/Framework');
define('AIT_FRAMEWORK_URL', THEME_URL . '/AIT/Framework');
define('AIT_ADMIN_DIR', THEME_DIR . '/AIT/Admin');
define("AIT_ADMIN_URL", THEME_URL . '/AIT/Admin');

define("AIT_CACHE_DIR", THEME_DIR . '/ait-cache');

define("AIT_TEMPLATES_DIR", THEME_DIR . '/Templates');

define('TIMTHUMB_URL', AIT_FRAMEWORK_URL . '/Libs/timthumb/timthumb.php');

define('AIT_DEFAULT_OPTIONS_KEY', 'ait_' . THEME_CODE_NAME . '_options_en');
define('AIT_OPTIONS_KEY', substr(AIT_DEFAULT_OPTIONS_KEY, 0, -2) . (defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en'));

define('AIT_BRANDING_OPTIONS_KEY',  substr('ait_' . THEME_CODE_NAME . '_admin_branding_en', 0, -2) . (defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en'));



if(file_exists(AIT_FRAMEWORK_DIR . '/dev-tools.php'))
	require AIT_FRAMEWORK_DIR . '/dev-tools.php';

require AIT_FRAMEWORK_DIR . '/Libs/Nette/nette.min.php';
require_once AIT_FRAMEWORK_DIR . '/ait-functions.php';

require AIT_FRAMEWORK_DIR . '/load.php';

$aitThemeConfig = loadConfig(THEME_DIR. '/conf/theme-config.neon');
if(!$aitThemeConfig) $aitThemeConfig = loadConfig(THEME_DIR. '/conf/@theme-config.neon');

$o = get_option(AIT_OPTIONS_KEY);
if($o === false){
	$o = get_option(AIT_DEFAULT_OPTIONS_KEY);
}
$aitThemeOptions = arrayToObject($o);
unset($o);

$aitBrandingOptions = arrayToObject(get_option(AIT_BRANDING_OPTIONS_KEY));

if(!is_admin()){
	WpLatte::$cacheDir = realpath(AIT_CACHE_DIR);
	WpLatte::$templatesDir = realpath(AIT_TEMPLATES_DIR);

	// global and allways accessible template variables
	$latteParams = array(
		'themeUrl' => THEME_URL,
		'themeCssUrl' => THEME_CSS_URL, // shortcuts :)
		'themeJsUrl' => THEME_JS_URL,
		'themeImgUrl' => THEME_IMG_URL,
		'themeOptions' => $aitThemeOptions,
		'bodyClasses' => '',
		'homeUrl' =>  home_url('/'),
		'timthumbUrl' => TIMTHUMB_URL,
		'themeboxDir' => AIT_FRAMEWORK_DIR . '/ThemeBox',
	);

}else{
	require AIT_ADMIN_DIR . '/load.php';
}

if(is_user_logged_in() and is_admin_bar_showing() and current_user_can('manage_options')){
	addAitToAdminBar();
}


function aitLoginStyles()
{
	$b = @$GLOBALS['aitBrandingOptions']->branding;
	echo '<style type="text/css">' . str_replace('{$img}', THEME_URL . '/' . @$b->loginScreenLogo, @$b->loginScreenCss) . '</style>';
}

add_action('login_head', 'aitLoginStyles');
add_action('login_headerurl', create_function('', 'return "' . @$GLOBALS['aitBrandingOptions']->branding->loginScreenLogoLink . '";'));
add_action('login_headertitle', create_function('', 'return "' . @$GLOBALS['aitBrandingOptions']->branding->loginScreenLogoTooltip . '";'));