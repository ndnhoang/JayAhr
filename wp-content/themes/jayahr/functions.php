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
			'top-header' => esc_html__( 'Top Header', 'jayahr' ),
			'menu-home' => esc_html__( 'Menu Home', 'jayahr' ),
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
		'name'          => esc_html__( 'Contact infomation', 'jayahr' ),
		'id'            => 'contact_info',
		'description'   => esc_html__( 'Add widgets here.', 'jayahr' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="title-sec">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Về chúng tôi', 'jayahr' ),
		'id'            => 'about_us',
		'description'   => esc_html__( 'Add widgets here.', 'jayahr' ),
		'before_widget' => '<section id="%1$s" class="widget about-us-wg">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) ); 
}
add_action( 'widgets_init', 'jayahr_widgets_init' );
//enqueue scripts
function jayahr_scripts() {		
	wp_enqueue_style( 'jayahr-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap.min', get_template_directory_uri().'/css/bootstrap.min.css' );
	wp_enqueue_style( 'main.css', get_template_directory_uri().'/css/main.css' );

	wp_enqueue_script( 'bootstrap.min.js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '2.0', true );
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
}
add_action('acf/init', 'my_acf_init');