<?php
/**
 * ALL DIWA GAME theme (reference: https://www.alldiwagame.com/)
 *
 * @package All_Diwa_Game
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ALL_DIWA_VERSION', '2.0.0' );

function all_diwa_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'all_diwa_setup' );

function all_diwa_assets() {
	wp_enqueue_style(
		'all-diwa-fonts',
		'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'all-diwa-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		ALL_DIWA_VERSION
	);
	wp_enqueue_script(
		'all-diwa-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		ALL_DIWA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'all_diwa_assets' );
