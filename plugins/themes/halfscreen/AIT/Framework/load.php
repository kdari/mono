<?php

/**
 * AIT WordPress Framework
 *
 * Copyright (c) 2011, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Libs
 */
require_once AIT_FRAMEWORK_DIR . '/Libs/lessphp/lessc.inc.php';
require_once AIT_FRAMEWORK_DIR . '/WpLatte/WpLatte.php';
require_once AIT_FRAMEWORK_DIR . '/Libs/WPAlchemy/MetaBox.php';

/**
 * Widgets
 */
if(isset($GLOBALS['aitThemeWidgets']) and !empty($GLOBALS['aitThemeWidgets'])){
	foreach($GLOBALS['aitThemeWidgets'] as $widget){
		require_once AIT_FRAMEWORK_DIR . "/Widgets/ait-{$widget}-widget.php";
	}
}

/**
 * Shortcodes
 */
require_once AIT_FRAMEWORK_DIR . "/Shortcodes/initEditorShortcodes.php";

/**
 * Custom Types default columns and config
 */
require_once  AIT_FRAMEWORK_DIR . '/CustomTypes/default/default-custom-type.php';

/**
 * Custom Types
 */
if(isset($GLOBALS['aitThemeCustomTypes']) and !empty($GLOBALS['aitThemeCustomTypes'])){
	foreach($GLOBALS['aitThemeCustomTypes'] as $customType => $postion){
		require_once AIT_FRAMEWORK_DIR . "/CustomTypes/{$customType}/{$customType}.php";
	}
}

/**
 * *** Helper functions ***
 */


function aitAddAdminBarMenu($wpAdminBar)
{
	$adminUrl = get_admin_url(0, 'admin.php?page=');
	$adminId = 'ait-admin';

	$pages = array(
		'branding' => __('Admin Branding', THEME_CODE_NAME),
		'skins' => __('Skins', THEME_CODE_NAME),
		'backup' => __('Backup', THEME_CODE_NAME),
	);

	$dashboardPages = array(
		//'dashboard' => 	__('Dashboard', THEME_CODE_NAME),
		'docs' => 		__('Documentation', THEME_CODE_NAME),
		'faq' => 		__('FAQ', THEME_CODE_NAME),
		'videos' => 	__('Videos', THEME_CODE_NAME),
		'support' => 	__('Support Forum', THEME_CODE_NAME),
	);

	// root node
	$wpAdminBar->add_menu(array(
		'id' => $adminId, 
		'title' => __('AIT Themes Admin'), 
		'href' => $adminUrl . $adminId
	));
	
	$wpAdminBar->add_menu(array(
		'id' => $adminId . '-dashboard', 
		'parent' => $adminId, 
		'title' => __('AIT Dashboard'), 
		'href' => $adminUrl . $adminId
	));

	foreach($dashboardPages as $id => $title){
		$wpAdminBar->add_menu(array('id' => "{$adminId}-{$id}", 'parent' => $adminId . '-dashboard', 'title' => $title, 'href' => $adminUrl . $adminId . "&tab={$id}"));
	}

	foreach($GLOBALS['aitThemeConfig'] as $key => $page){

		$wpAdminBar->add_menu(array(
			'id' => $adminId . "-{$key}",
			'parent' => $adminId,
			'title' => __($page['menu-title']),
			'href' => $adminUrl . $adminId . "-{$key}",
		));

		if(isset($page['tabs'])){
			foreach($page['tabs'] as $tabKey => $tab){
				$wpAdminBar->add_menu(array(
					'id' => $adminId . "-{$tabKey}",
					'parent' => $adminId . "-{$key}",
					'title' => __($tab['tab-title']),
					'href' => $adminUrl . $adminId . "-{$key}&amp;tab=" . $tabKey,
				));
			}
		}
	}

	foreach($pages as $id => $title){
		$wpAdminBar->add_menu(array('id' => "{$adminId}-{$id}", 'parent' => $adminId, 'title' => $title, 'href' => $adminUrl . $adminId . "-$id" ));
	}
}



function addAitToAdminBar($position = 21)
{
	add_action('admin_bar_menu', 'aitAddAdminBarMenu', $position);
}