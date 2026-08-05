<?php
/**
 * Seed Directory site (diwatop.co.in layout) — app-lane theme.
 * Copy into WP root and run: php setup-directory.php
 */
require_once __DIR__ . '/wp-load.php';

function dtd_page( $title, $slug, $content = '', $template = '' ) {
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

function dtd_htaccess() {
	$rules = "# BEGIN WordPress\n<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]\nRewriteBase /\nRewriteRule ^index\\.php$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . /index.php [L]\n</IfModule>\n# END WordPress\n";
	file_put_contents( ABSPATH . '.htaccess', $rules );
}

function dtd_blurb( $bonus, $text ) {
	return '<!-- wp:paragraph --><p><strong>Bonus notes:</strong> ' . esc_html( $bonus ) . '</p><!-- /wp:paragraph -->'
		. '<!-- wp:paragraph --><p>' . esc_html( $text ) . '</p><!-- /wp:paragraph -->'
		. '<!-- wp:paragraph --><p>Placeholder listing for the DiwaTop directory layout (diwatop.co.in). Replace with your final content. 18+ only.</p><!-- /wp:paragraph -->';
}

update_option( 'blogname', 'DiwaTop.co.in' );
update_option( 'blogdescription', 'Trusted destination for latest APK downloads' );
switch_theme( 'app-lane' );

$home = dtd_page( 'Home', 'home' );

$apps = array(
	array( 'Diwa Top APK 2026', 'diwa-top', '₹75–₹500', 'Signup bonus notes and latest Diwa Top app guide.' ),
	array( 'Diwa Win APK', 'diwa-win', 'Latest 2026', 'Diwa Win rummy / slots style listing placeholder.' ),
	array( 'Diwa VIP APK', 'diwa-vip', 'VIP notes', 'Diwa VIP Android APK guide placeholder.' ),
	array( 'Diwa 777 APK', 'diwa-777', 'Popular', 'Diwa 777 latest app download guide placeholder.' ),
	array( 'Diwa Slots APK', 'diwa-slots', 'Slots', 'Diwa Slots APK download information placeholder.' ),
	array( 'Rummy Games', 'rummy-games', 'Card games', 'Rummy catalogue listing placeholder.' ),
	array( 'Teen Patti Apps', 'teen-patti', 'Trending', 'Teen Patti apps directory placeholder.' ),
	array( 'Colour Prediction', 'colour-prediction', 'New', 'Colour prediction apps listing placeholder.' ),
);

foreach ( $apps as $app ) {
	dtd_page( $app[0], $app[1], dtd_blurb( $app[2], $app[3] ), 'page-app-detail' );
}

dtd_page( 'Most Rated Apps', 'most-rated-apps', '<!-- wp:paragraph --><p>Most rated apps listing — paste your ranked content later.</p><!-- /wp:paragraph -->' );
dtd_page( 'Most Viewed Apps', 'most-viewed-apps', '<!-- wp:paragraph --><p>Most viewed apps listing — paste your content later.</p><!-- /wp:paragraph -->' );
dtd_page( 'Mod Apps', 'mod-apps', '<!-- wp:paragraph --><p>Mod apps listing — paste your content later.</p><!-- /wp:paragraph -->' );
dtd_page( 'Diwa Top Category', 'category-diwa-top', '<!-- wp:paragraph --><p>Category landing placeholder. Prefer a real WP category at go-live if you want archives.</p><!-- /wp:paragraph -->' );

dtd_page( 'Contact', 'contact', '', 'page-contact' );
dtd_page( 'Disclaimer', 'disclaimer', '', 'page-legal' );

foreach (
	array(
		'contact-us',
		'privacy-policy',
		'terms-and-conditions',
		'about',
		'privacy',
		'terms',
		'sitemap',
		'diwa-game-apk',
		'spin-winner',
		'iw7-game',
		'diwa-bet',
		'yes-spin',
		'woho-game',
		'diwa-x',
		'mqm-bet',
	) as $old
) {
	$p = get_page_by_path( $old );
	if ( $p ) {
		wp_update_post( array( 'ID' => $p->ID, 'post_status' => 'draft' ) );
	}
}

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home );
update_option( 'permalink_structure', '/%postname%/' );
dtd_htaccess();
flush_rewrite_rules( true );

echo 'OK Directory (DiwaTop style) seeded theme=' . get_stylesheet() . "\n";
