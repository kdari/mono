<?php
/**
 * The doctype and html head section.
 *
 * Outputs the doctype, <html> tag, and all of the <head> including calling wp_head()
 *
 * @package Codegrade_Custom_Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Titillium+Web:bold&text=code">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Merriweather:200,300,400,500,200italic|Open+Sans:300,400,600&subset=latin">
	<script src="https://use.fontawesome.com/febd1b6aaa.js"></script>
	<?php wp_head(); ?>
</head>
