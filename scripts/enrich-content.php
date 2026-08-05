<?php
/**
 * Enrich BOTH WordPress sites with reference-aligned pages & deep app content.
 * Usage inside each container with SITE=brand|directory:
 *   SITE=brand php enrich-content.php
 */

require_once __DIR__ . '/wp-load.php';

$site = getenv( 'SITE' ) ?: 'brand';

function ec_page( $title, $slug, $template = '', $content = '' ) {
	$existing = get_page_by_path( $slug );
	if ( $existing ) {
		$pid = $existing->ID;
		wp_update_post(
			array(
				'ID'           => $pid,
				'post_title'   => $title,
				'post_content' => $content ? $content : $existing->post_content,
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
	} elseif ( $pid && ! is_wp_error( $pid ) && $template === '' ) {
		delete_post_meta( $pid, '_wp_page_template' );
	}
	return $pid;
}

function ec_htaccess() {
	$rules = "# BEGIN WordPress\n<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]\nRewriteBase /\nRewriteRule ^index\\.php$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . /index.php [L]\n</IfModule>\n# END WordPress\n";
	file_put_contents( ABSPATH . '.htaccess', $rules );
}

if ( 'brand' === $site ) {
	update_option( 'blogname', 'DM Win' );
	update_option( 'blogdescription', 'Dm Win Login Sign Up Sign In Register Download App' );
	switch_theme( 'harbor-play' );

	$home = ec_page( 'Home', 'home' );
	$blog = ec_page( 'Blog', 'blog', '' );
	ec_page( 'About', 'about', 'page-about' );
	ec_page( 'Contact', 'contact', 'page-contact' );
	ec_page( 'Register', 'register', 'page-register' );
	ec_page( 'Login', 'login', 'page-login' );
	ec_page( 'Sign In', 'sign-in', 'page-signin' );
	ec_page( 'Sign Up', 'sign-up', 'page-signup' );
	ec_page( 'Affiliate', 'affiliate', 'page-affiliate' );
	ec_page( 'Promotion', 'promotion', 'page-promotion' );
	ec_page( 'Download App', 'download-app', 'page-download' );
	ec_page( 'Privacy Policy', 'privacy', 'page-privacy' );
	ec_page( 'Terms of Service', 'terms', 'page-terms' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home );
	update_option( 'page_for_posts', $blog );
	update_option( 'permalink_structure', '/%postname%/' );
	ec_htaccess();
	flush_rewrite_rules( true );
	echo "OK brand enriched WP " . get_bloginfo( 'version' ) . " theme=" . get_stylesheet() . "\n";
	exit;
}

/* ===== DIRECTORY ===== */
update_option( 'blogname', 'ALL DIWA GAME' );
update_option( 'blogdescription', 'Download Latest Diwa Games APK With Bonus & Fast Withdrawal' );
switch_theme( 'app-lane' );

function ad_detail( $name, $bonus, $intro_en, $intro_hi = '' ) {
	$hi = $intro_hi ? $intro_hi : 'Is app ko simple aur user-friendly interface ke saath design kiya gaya hai, jisse naye aur purane dono players aasani se games samajh sakte hain.';
	return '<!-- wp:paragraph --><p><strong>Bonus notes:</strong> ' . esc_html( $bonus ) . '</p><!-- /wp:paragraph -->'
		. '<!-- wp:paragraph --><p>' . esc_html( $intro_en ) . '</p><!-- /wp:paragraph -->'
		. '<!-- wp:paragraph --><p>' . esc_html( $hi ) . '</p><!-- /wp:paragraph -->'
		. '<!-- wp:heading {"level":2} --><h2 class="wp-block-heading">APK download kaise kare?</h2><!-- /wp:heading -->'
		. '<!-- wp:list {"ordered":true} --><ol class="wp-block-list">'
		. '<li>Is page par demo Download button dekhein (go-live par official APK link lagayein).</li>'
		. '<li>Download complete hone par mobile Settings → Allow install from this source.</li>'
		. '<li>APK open karke install confirm karein.</li>'
		. '<li>Mobile number se Register / Login karke lobby explore karein.</li>'
		. '</ol><!-- /wp:list -->'
		. '<!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Withdrawal process (editorial notes)</h2><!-- /wp:heading -->'
		. '<!-- wp:paragraph --><p>Kai apps withdrawal ko simple rakhte hain taaki winning amount bank account me transfer ho sake. Limits VIP level ke hisaab se badal sakti hain — hamesha app ke andar ke rules padhein. Yeh directory sirf information deti hai; hum payments process nahi karte.</p><!-- /wp:paragraph -->'
		. '<!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Responsible play</h2><!-- /wp:heading -->'
		. '<!-- wp:paragraph --><p><strong>' . esc_html( $name ) . '</strong> jaisi apps online entertainment platforms hain. Financial risk ho sakta hai. 18+ only. ALL DIWA GAME kisi loss ke liye zimmedar nahi hai. Reference style: alldiwagame.com</p><!-- /wp:paragraph -->';
}

$home = ec_page( 'Home', 'home' );

$apps = array(
	array( 'Diwa Top APK 2026', 'diwa-top', '₹51–₹220', 'Download latest Diwa Games app & get free bonus notes — catalogue style listing for Alldiwagame readers.', 'Diwa Top naye users ke liye welcome bonus messaging ke saath popular listing hai.' ),
	array( 'Diwa Win APK', 'diwa-win', 'Up to ₹200 / ₹78 welcome notes', 'DIWA WIN APK aapke liye ek accha option ho sakta hai for rummy & slots style play with simple UI.', 'DIWA WIN me withdrawal process ko simple rakha gaya hai; bank transfer notes app ke andar verify karein.' ),
	array( 'DIWA GAME APK', 'diwa-game-apk', 'Welcome bonus up to ₹200', 'Latest Yono-style Diwa game app listing with welcome bonus information for 2026.', '' ),
	array( 'Spin Winner APK', 'spin-winner', 'Latest 2026', 'Spin Winner APK download guide for Android — Yono games catalogue entry.', '' ),
	array( 'IW7 GAME APK', 'iw7-game', 'Signup up to ₹500', 'IW7 Slot APK notes for Android 6.1 and above with signup bonus messaging.', '' ),
	array( 'Diwa Bet APK', 'diwa-bet', 'Guide 2026', 'Android app guide covering features and installation steps in plain language.', '' ),
	array( 'YES SPIN APK', 'yes-spin', 'Welcome bonus · instant withdrawal notes', 'YES SPIN latest version listing — welcome bonus and withdrawal information for readers.', '' ),
	array( 'WOHO GAME APK', 'woho-game', 'Up to ₹500', 'New Yono-style WOHO game download information with bonus messaging.', '' ),
	array( 'Diwa X APK', 'diwa-x', '₹78–₹300', 'Latest DiwaX game app notes for 2026 catalogue browsers.', '' ),
	array( 'MQM BET APK', 'mqm-bet', 'Welcome bonus', 'MQM BET download & play-online information listed for comparison readers.', '' ),
	array( 'DIWA 777 APK', 'diwa-777', 'Up to ₹200', 'DIWA 777 latest app download guide in the All Diwa catalogue.', '' ),
	array( 'DIWA VIP APK', 'diwa-vip', 'Bonus ₹500', 'DIWA VIP related Diwa game APK information with high bonus messaging.', '' ),
	array( 'Win Rummy App 2026', 'win-rummy', '₹51–₹299', 'Win Rummy registration, login bonus and complete guide notes for new users.', 'Win Rummy naye users ke liye registration + login bonus guide ke saath list kiya gaya hai.' ),
	array( 'Dhan Game APK', 'dhan-game', '₹49 welcome', 'Dhan Game (latest Yono-style) download notes with small welcome bonus messaging.', '' ),
	array( 'Good Slots (Diwa Game)', 'good-slots', '₹51–₹300', 'Good Slots Diwa Game APK listing — free bonus range notes for Android.', '' ),
	array( 'Money Rummy APK', 'money-rummy', '₹75 welcome', 'Money Rummy APK 2026 listing with welcome bonus information.', '' ),
	array( 'SVIP 777 APK', 'svip-777', 'Up to ₹500', 'SVIP 777 Diwa Game download notes with high signup bonus messaging.', '' ),
	array( 'Max Rummy APK', 'max-rummy', 'Fast install notes', 'Max Rummy APK download 2026 — fast install & play-online information.', '' ),
	array( 'Diwa Spin APK', 'diwa-spin', 'Welcome ₹55', 'Diwa Spin welcome bonus and easy registration notes.', '' ),
	array( 'Diwa Slots (New)', 'diwa-slots', '₹500 free bonus notes', 'DiwaSlots latest APK messaging with high bonus headline for catalogue users.', '' ),
	array( 'JaiHo 91 APK', 'jaiho-91', '₹75 welcome', 'JaiHo 91 download 2026 — welcome bonus and easy registration notes.', '' ),
	array( 'DIWA 91 APK', 'diwa-91', '₹75 welcome', 'DIWA 91 (Diwa Game) download — claim welcome bonus messaging free (editorial).', '' ),
	array( 'Diwa Win Withdrawal Proof', 'diwa-win-proof', 'Proof-style guide 2026', 'Editorial page describing deposit, balance and cashout screenshot style notes for Diwa Win readers.', 'Yeh listing informational proof-style guide hai — hamesha apne account ke asli screenshots app se verify karein.' ),
	array( 'ALL DIWA GAME APK Hub', 'all-diwa-game-apk-download', 'Multi-app hub', 'Hub-style page for Diwa 777, Diwa Slots, Diwa VIP, Diwa Win & Diwa 91 style downloads — browse related listings from the home grid.', 'ALL DIWA GAME APK hub se related titles home catalogue me milengi.' ),
);

foreach ( $apps as $app ) {
	ec_page( $app[0], $app[1], 'page-app-detail', ad_detail( $app[0], $app[2], $app[3], $app[4] ?? '' ) );
}

ec_page( 'Contact Us', 'contact-us', 'page-contact' );
ec_page( 'Disclaimer', 'disclaimer', 'page-legal' );
ec_page( 'Privacy Policy', 'privacy-policy', 'page-privacy' );
ec_page( 'Terms and Conditions', 'terms-and-conditions', 'page-terms' );

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home );
update_option( 'permalink_structure', '/%postname%/' );
ec_htaccess();
flush_rewrite_rules( true );

echo 'OK directory enriched apps=' . count( $apps ) . ' WP ' . get_bloginfo( 'version' ) . ' theme=' . get_stylesheet() . "\n";
