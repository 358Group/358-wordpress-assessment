<?php
require_once __DIR__ . '/wp-load.php';

function ad_page( $title, $slug, $content = '', $template = '' ) {
	$existing = get_page_by_path( $slug );
	if ( $existing ) {
		$pid = $existing->ID;
		wp_update_post(
			array(
				'ID'           => $pid,
				'post_title'   => $title,
				'post_content' => $content,
				'post_status'  => 'publish',
			)
		);
	} else {
		$pid = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_content' => $content,
				'post_status'  => 'publish',
				'post_type'    => 'page',
			)
		);
	}
	if ( $template && $pid && ! is_wp_error( $pid ) ) {
		update_post_meta( $pid, '_wp_page_template', $template );
	}
	return $pid;
}

function ad_htaccess() {
	$rules = "# BEGIN WordPress\n<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]\nRewriteBase /\nRewriteRule ^index\\.php$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . /index.php [L]\n</IfModule>\n# END WordPress\n";
	file_put_contents( ABSPATH . '.htaccess', $rules );
}

function ad_blurb( $bonus, $text ) {
	return '<!-- wp:paragraph --><p><strong>Bonus notes:</strong> ' . esc_html( $bonus ) . '</p><!-- /wp:paragraph -->'
		. '<!-- wp:paragraph --><p>' . esc_html( $text ) . '</p><!-- /wp:paragraph -->'
		. '<!-- wp:paragraph --><p>This listing follows the ALL DIWA GAME catalogue style (alldiwagame.com). Demo content for WordPress assessment — verify any real APK yourself. 18+ only.</p><!-- /wp:paragraph -->';
}

update_option( 'blogname', 'ALL DIWA GAME' );
update_option( 'blogdescription', 'Download Latest Diwa Games APK With Bonus & Fast Withdrawal' );
switch_theme( 'app-lane' );

$home = ad_page( 'Home', 'home' );

$apps = array(
	array( 'Diwa Top APK 2026', 'diwa-top', '₹51–₹220', 'Download latest Diwa Games app guide with free bonus information.' ),
	array( 'Diwa Win APK', 'diwa-win', 'Up to ₹200', 'Diwa Win registration bonus and Android APK download notes.' ),
	array( 'DIWA GAME APK', 'diwa-game-apk', '₹200', 'Latest Yono-style Diwa game app with welcome bonus info.' ),
	array( 'Spin Winner APK', 'spin-winner', 'Latest 2026', 'Spin Winner APK download guide for Android.' ),
	array( 'IW7 GAME APK', 'iw7-game', 'Up to ₹500', 'IW7 Slot APK — Android 6.1 and above notes.' ),
	array( 'Diwa Bet APK', 'diwa-bet', 'Guide 2026', 'Android app guide, features and installation steps.' ),
	array( 'YES SPIN APK', 'yes-spin', 'Welcome bonus', 'Latest version, welcome bonus and instant withdrawal notes.' ),
	array( 'WOHO GAME APK', 'woho-game', 'Up to ₹500', 'New Yono-style WOHO game download information.' ),
	array( 'Diwa X APK', 'diwa-x', '₹78–₹300', 'Latest DiwaX game app notes for 2026.' ),
	array( 'MQM BET APK', 'mqm-bet', 'Welcome bonus', 'MQM BET download and play-online information.' ),
	array( 'DIWA 777 APK', 'diwa-777', 'Up to ₹200', 'DIWA 777 latest app download guide.' ),
	array( 'DIWA VIP APK', 'diwa-vip', '₹500', 'DIWA VIP related Diwa game APK information.' ),
);

foreach ( $apps as $app ) {
	ad_page( $app[0], $app[1], ad_blurb( $app[2], $app[3] ), 'page-app-detail' );
}

ad_page( 'Contact Us', 'contact-us', '', 'page-contact' );
ad_page( 'Disclaimer', 'disclaimer', '', 'page-legal' );
ad_page( 'Privacy Policy', 'privacy-policy', '', 'page-privacy' );
ad_page( 'Terms and Conditions', 'terms-and-conditions', '', 'page-terms' );

// Draft old App Lane slugs
foreach ( array( 'about', 'contact', 'privacy', 'terms', 'sitemap', 'app-harbor-play', 'app-ledger-lite', 'app-dock-dice', 'app-margin-reader', 'app-porch-radio', 'app-stitch-notes' ) as $old ) {
	$p = get_page_by_path( $old );
	if ( $p ) {
		wp_update_post( array( 'ID' => $p->ID, 'post_status' => 'draft' ) );
	}
}

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home );
update_option( 'permalink_structure', '/%postname%/' );
ad_htaccess();
flush_rewrite_rules( true );

echo 'OK ALL DIWA GAME pages seeded theme=' . get_stylesheet() . "\n";
