<?php
/**
 * Brand theme — Diwa Top India (cachedrop.net layout)
 *
 * @package Cache_Drop_Brand
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CDB_VERSION', '5.1.2' );

function cdb_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'cdb_setup' );

function cdb_assets() {
	wp_enqueue_style(
		'cdb-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Nunito:wght@400;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'cdb-main', get_template_directory_uri() . '/assets/css/main.css', array(), CDB_VERSION );
	wp_enqueue_script( 'cdb-main', get_template_directory_uri() . '/assets/js/main.js', array(), CDB_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'cdb_assets' );

/**
 * SEO titles + meta descriptions for final Brand pages.
 */
function cdb_seo_map() {
	return array(
		'home'              => array(
			'title' => 'Diwa Top India: APK Download, App Guide & ₹2000 Bonus (2026)',
			'desc'  => 'Explore the Diwa Top India app, APK download steps, games, payments, account safety, system requirements and the latest ₹2000 bonus guide.',
		),
		'hi'                => array(
			'title' => 'Diwa Top India: APK डाउनलोड, ऐप गाइड और ₹2000 बोनस (2026)',
			'desc'  => 'Diwa Top India ऐप, APK डाउनलोड, इंस्टॉलेशन, गेम, पेमेंट, सुरक्षा, सिस्टम जरूरतें और ₹2000 बोनस की पूरी हिंदी गाइड पढ़ें।',
		),
		'about-us'          => array(
			'title' => 'About Our Diwa Top Guide | Independent Information Site',
			'desc'  => 'Learn how this independent Diwa Top guide researches app updates, APK information, bonus terms, payments, safety and responsible-use content.',
		),
		'about-us-hindi'    => array(
			'title' => 'हमारे Diwa Top Guide के बारे में | Independent Information Site',
			'desc'  => 'जानें यह स्वतंत्र Diwa Top guide APK, app update, bonus, payment, safety और responsible-use information कैसे तैयार करता है।',
		),
		'disclaimer'        => array(
			'title' => 'Diwa Top Disclaimer | Independent Website, 18+ and Risk Notice',
			'desc'  => 'Read the Diwa Top independent-site disclaimer covering information accuracy, APK links, bonuses, payments, local laws, 18+ access and responsible use.',
		),
		'disclaimer-hindi'  => array(
			'title' => 'Diwa Top Disclaimer Hindi | Independent Site, 18+ और Risk Notice',
			'desc'  => 'Diwa Top की independent-site disclaimer पढ़ें: APK links, bonus, payments, accuracy, local law, 18+ access और responsible use की जरूरी जानकारी।',
		),
	);
}

function cdb_current_seo() {
	$map = cdb_seo_map();
	if ( is_front_page() ) {
		return $map['home'];
	}
	if ( is_page() ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( isset( $map[ $slug ] ) ) {
			return $map[ $slug ];
		}
	}
	return null;
}

function cdb_document_title( $title ) {
	$seo = cdb_current_seo();
	if ( $seo ) {
		$title['title']   = $seo['title'];
		$title['tagline'] = '';
		$title['site']    = '';
	}
	return $title;
}
add_filter( 'document_title_parts', 'cdb_document_title' );

function cdb_meta_description() {
	$seo = cdb_current_seo();
	if ( ! $seo ) {
		return;
	}
	echo '<meta name="description" content="' . esc_attr( $seo['desc'] ) . '" />' . "\n";
}
add_action( 'wp_head', 'cdb_meta_description', 1 );
