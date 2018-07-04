<?php
/**
 * @link http://www.nlstech.net/
 * @author NLS Team
 * @package jayahr
 */
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
	wp_enqueue_style( 'main.css', get_template_directory_uri().'/css/main.css' );
	wp_enqueue_style( 'owl.carousel.min.css', get_template_directory_uri().'/css/owl.carousel.min.css' );

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
	acf_update_setting('google_api_key', 'AIzaSyCO_clusxR8INC6GFw5ivqN1dqDpPvz4lI');
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
		$attributes = $product->get_attributes();
		$categories = get_the_terms($product->id, 'product_cat');
		echo '<table class="attributes">';
		if ($categories) {
			$cat_links = array();
			foreach ($categories as $item) {
				$cat_links[] = '<a href="'.get_term_link($item).'">'.$item->name.'</a>';
			}
			$cat_links = implode(', ', $cat_links);
			echo '<tr><td class="name">Type</td><td class="value">'.$cat_links.'</td></tr>';
		}
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