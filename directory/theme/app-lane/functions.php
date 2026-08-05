<?php
/**
 * Directory theme — reference: https://diwatop.co.in/
 *
 * @package Diwa_Top_Directory
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DTD_VERSION', '5.0.0' );

function dtd_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'dtd_setup' );

function dtd_assets() {
	wp_enqueue_style(
		'dtd-fonts',
		'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'dtd-main', get_template_directory_uri() . '/assets/css/main.css', array(), DTD_VERSION );
	wp_enqueue_script( 'dtd-main', get_template_directory_uri() . '/assets/js/main.js', array(), DTD_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'dtd_assets' );
