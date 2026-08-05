<?php
require_once __DIR__ . '/wp-load.php';

function dm_page( $title, $slug, $template = '' ) {
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

function dm_htaccess() {
	$rules = "# BEGIN WordPress\n<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]\nRewriteBase /\nRewriteRule ^index\\.php$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . /index.php [L]\n</IfModule>\n# END WordPress\n";
	file_put_contents( ABSPATH . '.htaccess', $rules );
}

update_option( 'blogname', 'DM Win' );
update_option( 'blogdescription', 'Login Sign Up Register Download App' );
switch_theme( 'harbor-play' );

$home = dm_page( 'Home', 'home' );
dm_page( 'Blog', 'blog', 'page-blog' );
dm_page( 'About', 'about', 'page-about' );
dm_page( 'Contact', 'contact', 'page-contact' );
dm_page( 'Register', 'register', 'page-register' );
dm_page( 'Login', 'login', 'page-login' );
dm_page( 'Sign In', 'sign-in', 'page-signin' );
dm_page( 'Sign Up', 'sign-up', 'page-signup' );
dm_page( 'Affiliate', 'affiliate', 'page-affiliate' );
dm_page( 'Promotion', 'promotion', 'page-promotion' );
dm_page( 'Download App', 'download-app', 'page-download' );

// Remove old Harbor Play-only pages from nav confusion (keep if exist but unpublish optional)
foreach ( array( 'games', 'app', 'faq', 'disclaimer' ) as $old ) {
	$p = get_page_by_path( $old );
	if ( $p ) {
		wp_update_post( array( 'ID' => $p->ID, 'post_status' => 'draft' ) );
	}
}

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home );
update_option( 'permalink_structure', '/%postname%/' );
dm_htaccess();
flush_rewrite_rules( true );

echo 'OK DM Win pages seeded theme=' . get_stylesheet() . "\n";
