<?php
/**
 * DM Win theme (reference: https://dmwin77.com/)
 *
 * @package DM_Win
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DM_WIN_VERSION', '2.0.0' );

function dm_win_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'dm_win_setup' );

function dm_win_assets() {
	wp_enqueue_style(
		'dm-win-fonts',
		'https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&family=Roboto:wght@400;500;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'dm-win-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		DM_WIN_VERSION
	);
	wp_enqueue_script(
		'dm-win-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		DM_WIN_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'dm_win_assets' );
