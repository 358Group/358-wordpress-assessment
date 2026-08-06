<?php
/**
 * Brand theme — Diwa Top India (cachedrop.net layout)
 *
 * @package Cache_Drop_Brand
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CDB_VERSION', '6.2.3' );
define( 'CDB_AFFILIATE_URL', 'https://vipwad.com/topsp/101.html' );

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
			'title' => 'About Our Diwa Top Guide | Diwa Top India',
			'desc'  => 'Learn how this Diwa Top guide covers app updates, APK details, bonus terms, payments, safety and responsible play.',
		),
		'about-us-hindi'    => array(
			'title' => 'हमारे Diwa Top Guide के बारे में | Diwa Top India',
			'desc'  => 'जानें यह Diwa Top guide APK, app update, bonus, payment, safety और जिम्मेदार उपयोग की जानकारी कैसे देता है।',
		),
		'disclaimer'        => array(
			'title' => 'Diwa Top Disclaimer | 18+ and Risk Notice',
			'desc'  => 'Read the Diwa Top disclaimer covering information accuracy, APK links, bonuses, payments, local laws, 18+ access and responsible use.',
		),
		'disclaimer-hindi'  => array(
			'title' => 'Diwa Top Disclaimer Hindi | 18+ और Risk Notice',
			'desc'  => 'Diwa Top disclaimer पढ़ें: APK links, bonus, payments, accuracy, local law, 18+ access और जिम्मेदार उपयोग की जरूरी बातें।',
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

/**
 * Sticky bottom affiliate CTA bar (all pages). Dismissible via close button.
 * Inline styles keep it visible even if CSS/JS caches are stale.
 */
function cdb_sticky_affiliate_bar() {
	$url = esc_url( CDB_AFFILIATE_URL );
	?>
	<style id="cd-sticky-aff-css">
	.cd-sticky-aff{position:fixed!important;left:0!important;right:0!important;bottom:0!important;z-index:2147483000!important;padding:.75rem .9rem calc(.75rem + env(safe-area-inset-bottom,0px));background:rgba(6,12,10,.92)!important;backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border-top:1px solid rgba(255,255,255,.12);box-shadow:0 -10px 30px rgba(0,0,0,.4)}
	.cd-sticky-aff__inner{position:relative;max-width:720px;margin:0 auto;display:flex;align-items:center;justify-content:center;gap:.6rem;min-height:52px;padding-right:2.75rem}
	.cd-sticky-aff__actions{display:flex;align-items:center;justify-content:center;gap:.55rem;flex-wrap:wrap}
	.cd-sticky-aff__btn{display:inline-flex!important;align-items:center;justify-content:center;min-width:138px;padding:.78rem 1.4rem;border-radius:999px;font-family:Montserrat,system-ui,sans-serif;font-size:.95rem;font-weight:800;line-height:1;text-decoration:none!important}
	.cd-sticky-aff__btn--register{background:#3dff9a!important;color:#06140d!important;border:2px solid #3dff9a!important}
	.cd-sticky-aff__btn--login{background:transparent!important;color:#fff!important;border:2px solid rgba(255,255,255,.92)!important}
	.cd-sticky-aff__close{position:absolute;right:0;top:50%;transform:translateY(-50%);width:36px;height:36px;border:0;border-radius:999px;background:rgba(0,0,0,.6);color:#fff;font-size:1.5rem;line-height:1;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;padding:0}
	body.has-cd-sticky-aff{padding-bottom:96px!important}
	</style>
	<div class="cd-sticky-aff" id="cd-sticky-aff" role="region" aria-label="Quick actions" style="display:block">
	  <div class="cd-sticky-aff__inner">
	    <div class="cd-sticky-aff__actions">
	      <a class="cd-sticky-aff__btn cd-sticky-aff__btn--register" href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer sponsored">Daftar sekarang</a>
	      <a class="cd-sticky-aff__btn cd-sticky-aff__btn--login" href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer sponsored">Log masuk</a>
	    </div>
	    <button type="button" class="cd-sticky-aff__close" id="cd-sticky-aff-close" aria-label="Close sticky banner">&times;</button>
	  </div>
	</div>
	<script>
	(function () {
	  var KEY = "cdStickyAffDismissed_v3";
	  var bar = document.getElementById("cd-sticky-aff");
	  var closeBtn = document.getElementById("cd-sticky-aff-close");
	  if (!bar) return;
	  try {
	    if (window.localStorage.getItem(KEY) === "1") {
	      bar.style.display = "none";
	      return;
	    }
	  } catch (e) {}
	  bar.style.display = "block";
	  document.body.classList.add("has-cd-sticky-aff");
	  if (closeBtn) {
	    closeBtn.addEventListener("click", function () {
	      bar.style.display = "none";
	      document.body.classList.remove("has-cd-sticky-aff");
	      try { window.localStorage.setItem(KEY, "1"); } catch (e) {}
	    });
	  }
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'cdb_sticky_affiliate_bar', 20 );
