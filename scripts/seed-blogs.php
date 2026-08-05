<?php
/**
 * Seed 3 complete DM Win blog posts + set Blog as posts page.
 * Run inside brand-wp: php seed-blogs.php
 */

require_once __DIR__ . '/wp-load.php';

require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

function dm_ensure_cat( $name, $slug ) {
	$term = get_term_by( 'slug', $slug, 'category' );
	if ( $term ) {
		return (int) $term->term_id;
	}
	$created = wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
	return is_wp_error( $created ) ? 1 : (int) $created['term_id'];
}

function dm_sideload_theme_image( $relative, $post_id, $title ) {
	$path = get_template_directory() . '/assets/img/' . ltrim( $relative, '/' );
	if ( ! file_exists( $path ) ) {
		echo "Missing image: {$path}\n";
		return 0;
	}

	// Reuse existing attachment with same title if present.
	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'title'          => $title,
			'posts_per_page' => 1,
			'post_status'    => 'inherit',
		)
	);
	if ( $existing ) {
		set_post_thumbnail( $post_id, $existing[0]->ID );
		return (int) $existing[0]->ID;
	}

	$filename = basename( $path );
	$upload   = wp_upload_bits( $filename, null, file_get_contents( $path ) );
	if ( ! empty( $upload['error'] ) ) {
		echo "Upload error: {$upload['error']}\n";
		return 0;
	}

	$filetype = wp_check_filetype( $filename, null );
	$attach_id = wp_insert_attachment(
		array(
			'post_mime_type' => $filetype['type'],
			'post_title'     => $title,
			'post_content'   => '',
			'post_status'    => 'inherit',
		),
		$upload['file'],
		$post_id
	);
	$meta = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
	wp_update_attachment_metadata( $attach_id, $meta );
	set_post_thumbnail( $post_id, $attach_id );
	return (int) $attach_id;
}

function dm_upsert_post( $title, $slug, $date, $content, $cats, $image ) {
	$existing = get_page_by_path( $slug, OBJECT, 'post' );
	$data     = array(
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_content' => $content,
		'post_status'  => 'publish',
		'post_type'    => 'post',
		'post_date'    => $date,
		'post_author'  => 1,
	);

	if ( $existing ) {
		$data['ID'] = $existing->ID;
		$pid        = wp_update_post( $data );
	} else {
		$pid = wp_insert_post( $data );
	}

	if ( is_wp_error( $pid ) || ! $pid ) {
		echo "Failed post: {$title}\n";
		return 0;
	}

	wp_set_post_categories( $pid, $cats );
	dm_sideload_theme_image( $image, $pid, $title . ' cover' );
	echo "OK post #{$pid} /{$slug}/\n";
	return $pid;
}

$cat_guides = dm_ensure_cat( 'Guides', 'guides' );
$cat_app    = dm_ensure_cat( 'App', 'app' );
$cat_uncat  = dm_ensure_cat( 'Uncategorized', 'uncategorized' );

$post1 = <<<'HTML'
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Understanding Online Gaming</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Online gaming has transformed the way we interact with games, creating immersive experiences whether you’re a casual player or a seasoned pro. DM Win gives you a platform where challenges and entertainment meet, offering something for everyone.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">The Diversity of Game Genres</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>When it comes to online gaming, the variety available is astounding. Here are some popular genres you can explore:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul class="wp-block-list">
<li><strong>Action Games:</strong> Fast-paced adventures that keep your adrenaline pumping.</li>
<li><strong>Role-Playing Games (RPGs):</strong> Immerse yourself in complex stories and character development.</li>
<li><strong>Puzzle Games:</strong> Test your intellect and problem-solving skills.</li>
<li><strong>Sports Games:</strong> Experience your favorite sports digitally.</li>
<li><strong>Simulation Games:</strong> Create, manage, and live out virtual life experiences.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Choosing the Right Game for You</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Selecting an appropriate game can set the tone for your online gaming experience. Here are a few tips to help you find your perfect match:</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol class="wp-block-list">
<li><strong>Assess Your Interests:</strong> Consider what captivates you – speed, strategy, adventure, or creativity.</li>
<li><strong>Read Reviews:</strong> Check player experiences and ratings to gauge the game’s quality.</li>
<li><strong>Try Before You Buy:</strong> Look for free demos or trial versions to sample the gameplay.</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Essential Tips for an Engaging Gaming Experience</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Once you’ve found your game, enhancing your experience comes down to a few key practices:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul class="wp-block-list">
<li><strong>Stay Connected:</strong> Engage with online communities or forums related to your game to share tips and experiences.</li>
<li><strong>Balance Gameplay:</strong> Schedule your gaming sessions to avoid burnout. Remember, moderation is key!</li>
<li><strong>Improve Your Skills:</strong> Watch tutorials or livestreams to pick up advanced techniques from experienced players.</li>
<li><strong>Customize Your Settings:</strong> Adjust game and control settings for optimal comfort and performance.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">The Future of Online Gaming</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The online gaming industry is constantly evolving, with new technologies and trends shaping gameplay and player interaction.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Emerging Trends to Watch</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list">
<li><strong>Virtual Reality (VR) and Augmented Reality (AR):</strong> These technologies are making gaming more immersive than ever.</li>
<li><strong>Cloud Gaming:</strong> Play high-quality games without the need for expensive hardware.</li>
<li><strong>In-Game Economies:</strong> Monetization through virtual currencies is redefining how players engage and compete.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Conclusion</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>By understanding the vast array of online gaming options and leveraging tips to enhance your experience, you can truly immerse yourself in this exciting digital frontier. Explore the variety offered on DM Win and find the games that resonate with you. Happy gaming!</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>18+ only. Play for entertainment, set personal limits, and never chase losses.</em></p>
<!-- /wp:paragraph -->
HTML;

$post2 = <<<'HTML'
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Why DM Win Has Multiple Entry Pages</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>On DM Win you’ll see <strong>Register</strong>, <strong>Login</strong>, <strong>Sign In</strong>, and <strong>Sign Up</strong> in the menu — the same labels used on dmwin77.com. They cover the same account journey from slightly different starting points.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">How to Register</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol class="wp-block-list">
<li>Open the <a href="/register/">Register</a> page (or <a href="/sign-up/">Sign Up</a>).</li>
<li>Enter your name, email, mobile number, and a strong password.</li>
<li>Confirm you are <strong>18+</strong> and accept the site terms.</li>
<li>Submit the form. On a live site you would verify your email next; this demo form does not create a real account.</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">How to Login / Sign In</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Already have details? Use <a href="/login/">Login</a> or <a href="/sign-in/">Sign In</a>:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul class="wp-block-list">
<li>Enter the email/username and password you registered with.</li>
<li>Use “Forgot password?” support if you need a reset — contact <a href="mailto:gajendra.loma@gmail.com">gajendra.loma@gmail.com</a> or Telegram <a href="https://t.me/lomasdollars">@lomasdollars</a>.</li>
<li>After login you can open promotions, affiliate notes, or the download app path.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Quick Safety Checklist</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list">
<li>Only use the official DM Win website / app links from this site.</li>
<li>Never share OTPs or passwords in chat.</li>
<li>Treat welcome bonuses as entertainment extras, not guaranteed income.</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><a href="/register/">Create an account</a> · <a href="/login/">Login now</a> · <a href="/contact/">Contact support</a></p>
<!-- /wp:paragraph -->
HTML;

$post3 = <<<'HTML'
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Exclusive Mobile Bonuses</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The <a href="/download-app/">Download App</a> page highlights mobile-first offers — the same idea as the “Download APP Get Free 1111 Bonus” bar on the DM Win reference site. Installing the app keeps the lobby in one tap and may unlock app-only promotions on a live build.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">How to Download (Demo Flow)</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol class="wp-block-list">
<li>Register or login on the website first so your account is ready.</li>
<li>Visit <a href="/download-app/">Download App</a>.</li>
<li>Tap <strong>Download Android APK</strong>. <em>This demo does not serve a real APK file.</em></li>
<li>On a production site, enable install-from-unknown-sources only for the official package, then open the app and sign in.</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Before You Install Any APK</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list">
<li>Confirm the file comes from this site or our official Telegram <a href="https://t.me/lomasdollars">@lomasdollars</a>.</li>
<li>Ignore random APKs sent by strangers in chats or SMS.</li>
<li>Keep your device updated and use a screen lock.</li>
<li>iOS users can use Safari “Add to Home Screen” until a native build exists.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">After Install</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Open the app, sign in with the same credentials from <a href="/login/">Login</a>, check <a href="/promotion/">Promotion</a> for current offers, and set a personal spend limit before your first session.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="/download-app/">Go to Download App</a> · <a href="/promotion/">See promotions</a></p>
<!-- /wp:paragraph -->
HTML;

dm_upsert_post(
	'Online Gaming: Tips and Tricks for Enthusiasts',
	'online-gaming-tips-tricks',
	'2025-10-26 10:00:00',
	$post1,
	array( $cat_uncat, $cat_guides ),
	'blog-gaming.png'
);

dm_upsert_post(
	'How to Register & Login on DM Win',
	'how-to-register-login-dm-win',
	'2025-11-02 11:00:00',
	$post2,
	array( $cat_guides ),
	'blog-login.png'
);

dm_upsert_post(
	'Download the App for Mobile Bonuses',
	'download-dm-win-app-mobile-bonuses',
	'2025-11-12 12:00:00',
	$post3,
	array( $cat_app ),
	'blog-app.png'
);

// Make Blog the posts index page.
$blog = get_page_by_path( 'blog' );
if ( ! $blog ) {
	$blog_id = wp_insert_post(
		array(
			'post_title'  => 'Blog',
			'post_name'   => 'blog',
			'post_status' => 'publish',
			'post_type'   => 'page',
		)
	);
} else {
	$blog_id = $blog->ID;
	// Clear custom page template so home.html (posts index) is used.
	delete_post_meta( $blog_id, '_wp_page_template' );
}

$home = get_page_by_path( 'home' );
if ( $home ) {
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home->ID );
}
update_option( 'page_for_posts', $blog_id );
update_option( 'permalink_structure', '/%postname%/' );
flush_rewrite_rules( true );

echo "Blog page ID={$blog_id} set as page_for_posts\n";
echo "Visit http://localhost:8080/blog/\n";
