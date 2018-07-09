<?php
/**
 * @link http://www.nlstech.net/
 * @package jayahr
 * @author NLS Team
 */
global $jayahr_option;
$logo  = $jayahr_option['logo-image'];
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php get_favicon();?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="wrapper">
      <header>
        <div class="top-bar">
          <div id="menu_mobi">
            <div class="bars"><img src="<?php echo get_stylesheet_directory_uri().'/images/bars.png'; ?>" alt="menu-mobi"></div>
            <div class="menu-mobi">
              <div class="search-form">
                <form method="get" action="">
                  <input type="text" name="s">
                  <button type="submit"><img src="<?php echo get_stylesheet_directory_uri().'/images/search-icon.png' ?>" alt=""></button>
                </form>
              </div>
              <ul>
                <span class="menu-close"><img src="<?php echo get_stylesheet_directory_uri().'/images/close-icon.png' ?>" alt="close"></span>
                <li><a href="#">Shop</a></li>
                <li><a href="#">0 Items</a></li>
                <li><a href="#">Login</a></li>
              </ul>
              <?php wp_nav_menu( array(
                   'theme_location' => 'primary',
                   'menu_class' => ''
              ) ); ?>
            </div>
          </div>
          <div class="container">
            <ul class="user-menu">
              <li><a href="#">Shop</a></li>
              <li><a href="#">0 Items</a></li>
              <li><a href="#">Login</a></li>
            </ul>
            <h1 id="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo $logo['url']; ?>" alt="Jay Ahr"></a></h1>
            <div class="search-form">
              <form method="get" action="">
                <input type="text" name="s">
                <button type="submit"><img src="<?php echo get_stylesheet_directory_uri().'/images/search-icon.png' ?>" alt=""></button>
              </form>
            </div>
          </div>
        </div>
        <?php wp_nav_menu( array(
             'theme_location' => 'primary',
             'container' => 'nav',
             'container_class' => 'main-nav',
             'menu_class' => 'main-menu container'
        ) ); ?>
      </header>
      <main>