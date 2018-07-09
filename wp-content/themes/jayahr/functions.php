<?php
/**
 * @link http://www.nlstech.net/
 * @author NLS Team
 * @package jayahr
 */

update_option( 'siteurl', 'http://192.168.0.117/jayahr/' );
update_option( 'home', 'http://192.168.0.117/jayahr/' );

if ( ! function_exists( 'jayahr_setup' ) ) :
	function jayahr_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'jayahr' ),
			'iconic-vintage' => esc_html__( 'Iconic Vintage', 'jayahr' ),
			'client-services' => esc_html__( 'Client Services', 'jayahr' ),
			'contact-us' => esc_html__( 'Contact Us', 'jayahr' ),
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'jayahr_setup' );
/**
 * Register widget area
 */
function jayahr_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Iconic Vintage', 'jayahr' ),
		'id'            => 'iconic_vintage',
		'description'   => esc_html__( 'Add widgets here.', 'jayahr' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Client Services', 'jayahr' ),
		'id'            => 'client_services',
		'description'   => esc_html__( 'Add widgets here.', 'jayahr' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) ); 
	register_sidebar( array(
		'name'          => esc_html__( 'Contact Us', 'jayahr' ),
		'id'            => 'contact_us',
		'description'   => esc_html__( 'Add widgets here.', 'jayahr' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) ); 
}
add_action( 'widgets_init', 'jayahr_widgets_init' );
//enqueue scripts
function jayahr_scripts() {		
	wp_enqueue_style( 'jayahr-style', get_stylesheet_uri() );
	wp_enqueue_style( 'owl.carousel.min.css', get_template_directory_uri().'/css/owl.carousel.min.css' );
	wp_enqueue_style( 'main.css', get_template_directory_uri().'/css/main.css' );
	wp_enqueue_style( 'responsive.css', get_template_directory_uri().'/css/responsive.css' );

	wp_enqueue_script( 'owl.carousel.min.js', get_template_directory_uri().'/js/owl.carousel.min.js',array('jquery'), '3.8', true );
	wp_enqueue_script( 'main.js', get_template_directory_uri().'/js/main.js',array('jquery'), '3.8', true );
}
add_action( 'wp_enqueue_scripts', 'jayahr_scripts' );
/**
 * Theme option
 */
require get_template_directory() . '/inc/theme-option.php';
/**
 * widgets
 */
require get_template_directory() . '/inc/widgets.php';
/**
 * BFI_Thumb
 */
require get_template_directory() . '/BFI_Thumb.php';
/**
 * Shortcode
 */
require_once get_template_directory() . '/inc/shortcode.php';
//hide adminbar
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}
//filter logout
add_action( 'wp_logout', 'auto_redirect_external_after_logout');
function auto_redirect_external_after_logout(){
  wp_redirect(home_url());
  exit();
}
//filter wp mail html
add_filter('wp_mail_content_type','wpdocs_set_html_mail_content_type');
function wpdocs_set_html_mail_content_type($content_type){
	return 'text/html';
}
//funtion crop_img
function crop_img($w, $h, $url_img){
 $params = array( 'width' => $w, 'height' => $h, 'crop' => true);
 return bfi_thumb($url_img, $params );
}
//funtion crop_img
function get_favicon(){
    global $jayahr_option;
    $favicon  = $jayahr_option['favicon'];
    echo '<link rel="icon" type="image/png" href="'.$favicon['url'].'" sizes="32x32"/>';
}
//update version acf
function my_acf_init() {	
	acf_update_setting('select2_version', 4);	
	acf_update_setting('google_api_key', 'AIzaSyD9pVsP-Sh5vKDOU_6mGP3weZYs9qsX2wE');
}
add_action('acf/init', 'my_acf_init');
// fix woocommerce lastest
function mytheme_add_woocommerce_support() {
add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
// remove hook woocommerce_before_main_content
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_main_content', 'WC_Structured_Data::generate_website_data()', 30);
// remove hook woocommerce_before_shop_loop
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $cols ) {
  $cols = 17;
  return $cols;
}
/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3;
	}
}
// change product display
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
if (!function_exists('woocommerce_custom_template_loop_product_title')) {
	function woocommerce_custom_template_loop_product_title() {
		echo '<h4><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
	}
}
if (!function_exists('woocommerce_custom_template_loop_product_attributes')) {
	function woocommerce_custom_template_loop_product_attributes() {
		$product = wc_get_product();
		$sku = $product->get_sku();
		$attributes = $product->get_attributes();
		echo '<table class="attributes">';
		echo '<tr class="code"><td class="name">Code</td><td class="value">'.$sku.'</td></tr>';
		if ($attributes) {
			foreach ($attributes as $item) {
				$attribute_name = get_taxonomy($item['name']);
				$attribute_name = $attribute_name->labels->singular_name;
				$attribute = $product->get_attribute($item['name']);
				echo '<tr>';
				echo '<td class="name">'.$attribute_name.'</td><td class="value">'.$attribute.'</td>';
				echo '</tr>';
			}
		}
		echo '</table>';
	}
}
add_action('woocommerce_shop_loop_item_title', 'woocommerce_custom_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_custom_template_loop_product_attributes', 20);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
if (!function_exists('woocommerce_custom_template_loop_product_thumbnail_open')) {
	function woocommerce_custom_template_loop_product_thumbnail_open() {
		echo '<div class="thumb"><a href="'.get_the_permalink().'">';
	}
}
if (!function_exists('woocommerce_custom_template_loop_product_thumbnail_close')) {
	function woocommerce_custom_template_loop_product_thumbnail_close() {
		echo '</a></div>';
	}
}
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_custom_template_loop_product_thumbnail_open', 5);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_custom_template_loop_product_thumbnail_close', 15);
// remove pagination
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
if (!function_exists('woocommerce_custom_loadmore')) {
	function woocommerce_custom_loadmore() {
		echo '<div class="load-more"><a class="read-more" href="#">Load more</a></div>';
	}
}
add_action('woocommerce_after_shop_loop', 'woocommerce_custom_loadmore', 10);
// edit single product
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
if (!function_exists('woocommerce_custom_template_single_title')) {
	function woocommerce_custom_template_single_title() {
		echo '<h2 class="product_title entry-title">'.get_the_title().'</h2>';
	}
}
add_action('woocommerce_single_product_summary', 'woocommerce_custom_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
if (!function_exists('woocommerce_custom_single_meta')) {
	function woocommerce_custom_single_meta() {
		$current = get_option('woocommerce_currency');
		echo '<div class="information">';
		echo '<div class="container">';
		echo '<div class="content">';
		if (get_the_excerpt()) {
			echo '<div class="excerpt">'.get_the_excerpt().'</div>';	
		}
		echo '<div class="meta">';
		woocommerce_custom_template_loop_product_attributes();
		echo '</div>';
		echo '<div class="price">';
		if (wc_get_product(get_the_ID())->get_price()) {
			echo '<div class="value">'.wc_price(wc_get_product(get_the_ID())->get_price()).'</div>';
		}
		echo '<div class="add-cart">';
		woocommerce_template_loop_add_to_cart();
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
}
add_action('woocommerce_after_single_product_summary', 'woocommerce_custom_single_meta', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
if (!function_exists('woocommerce_custom_show_product_images')) {
	function woocommerce_custom_show_product_images() {
		$product = wc_get_product();
		$attachment_ids = $product->get_gallery_attachment_ids();
		$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($product->id), 'full');
		$count = 0;
		if ($featured_image || $attachment_ids) {
			if ($featured_image)
				$first_image = $featured_image[0];
			else
				$first_image = wp_get_attachment_url($attachment_ids[0]);
			echo '<div class="gallery-product">';
			echo '<div class="image" data-item="1">';
			echo '<div class="zoom"><img src="'.get_stylesheet_directory_uri().'/images/zoom-icon.png'.'" alt="zoom"></div>';
			echo '<img src="'.crop_img(735, 523, $first_image).'" alt="">';
			echo '</div>';
			echo '<div class="carousel-gallery">';
			echo '<div class="owl-carousel">';
			if ($featured_image) {
				$count++;
				echo '<div class="item" data-item="'.$count.'" data-medium="'.crop_img(735, 523, $featured_image[0]).'"><img src="'.crop_img(59, 42, $featured_image[0]).'" alt=""></div>';
			}
			foreach( $attachment_ids as $attachment_id ) {
		        $image_link = wp_get_attachment_url( $attachment_id );
		        $count++;
		        echo '<div class="item" data-item="'.$count.'" data-medium="'.crop_img(735, 523, $image_link).'"><img src="'.crop_img(59, 42, $image_link).'" alt=""></div>';
		    }
			echo '</div>';
			echo '</div>';
			echo '<div class="carousel-zoom-gallery">';
			echo '<div class="zoom-close"><img src="'.get_stylesheet_directory_uri().'/images/close-icon.png" alt="close"></div>';
			echo '<div class="owl-carousel">';
			$count = 0;
			if ($featured_image) {
				$count++;
				echo '<div class="item" data-item="'.$count.'" data-medium="'.crop_img(735, 523, $featured_image[0]).'"><img src="'.$featured_image[0].'" alt=""></div>';
			}
			foreach( $attachment_ids as $attachment_id ) {
		        $image_link = wp_get_attachment_url( $attachment_id );
		        $count++;
		        echo '<div class="item" data-item="'.$count.'" data-medium="'.crop_img(735, 523, $image_link).'"><img src="'.$image_link.'" alt=""></div>';
		    }
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
	}
}
add_action('woocommerce_before_single_product_summary', 'woocommerce_custom_show_product_images', 20);
// Change 'add to cart' text on single product page
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_single_add_to_cart_text' ); 
function woo_custom_single_add_to_cart_text() { 
    return __( 'Add to list', 'woocommerce' ); 
}
// Change 'view cart' text on single product page
add_filter( 'gettext', 'my_text_strings', 20, 3 );
function my_text_strings( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'View cart':
			$translated_text = __( 'View list', 'woocommerce' );
			break;
		}
	return $translated_text;
}
add_filter( 'woocommerce_cart_needs_payment', '__return_false' );