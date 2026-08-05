<?php
/**
 * Seed Brand site — Diwa Top India final pages (cachedrop layout).
 * Run inside brand-wp: php setup-brand-updated.php
 */
require_once __DIR__ . '/wp-load.php';

function cdb_page( $title, $slug, $template = '' ) {
	$existing = get_page_by_path( $slug );
	if ( $existing ) {
		$pid = $existing->ID;
		wp_update_post(
			array(
				'ID'          => $pid,
				'post_title'  => $title,
				'post_status' => 'publish',
			)
		);
	} else {
		$pid = wp_insert_post(
			array(
				'post_title'  => $title,
				'post_name'   => $slug,
				'post_status' => 'publish',
				'post_type'   => 'page',
			)
		);
	}
	if ( $template && $pid && ! is_wp_error( $pid ) ) {
		update_post_meta( $pid, '_wp_page_template', $template );
	}
	return $pid;
}

function cdb_htaccess() {
	$rules = "# BEGIN WordPress\n<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]\nRewriteBase /\nRewriteRule ^index\\.php$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . /index.php [L]\n</IfModule>\n# END WordPress\n";
	file_put_contents( ABSPATH . '.htaccess', $rules );
}

update_option( 'blogname', 'Diwa Top India' );
update_option( 'blogdescription', 'APK Download, App Guide & ₹2000 Bonus' );
switch_theme( 'harbor-play' );

$home = cdb_page( 'Home', 'home' );
cdb_page( 'Diwa Top Hindi Guide', 'hi', 'page-hi' );
cdb_page( 'About Our Diwa Top Guide', 'about-us', 'page-about' );
cdb_page( 'हमारे Diwa Top Guide के बारे में', 'about-us-hindi', 'page-about-hindi' );
cdb_page( 'Diwa Top Disclaimer', 'disclaimer', 'page-disclaimer' );
cdb_page( 'Diwa Top Disclaimer Hindi', 'disclaimer-hindi', 'page-disclaimer-hindi' );
cdb_page( 'Download', 'download', 'page-download' );
cdb_page( 'Register', 'register', 'page-register' );
cdb_page( 'Contact', 'contact', 'page-contact' );

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home );
update_option( 'page_for_posts', 0 );
update_option( 'permalink_structure', '/%postname%/' );
cdb_htaccess();
flush_rewrite_rules( true );

echo 'OK Brand final pages seeded theme=' . get_stylesheet() . "\n";
