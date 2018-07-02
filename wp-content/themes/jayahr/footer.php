<?php
/**
 * @link http://www.nlstech.net/
 * @package jayahr
 * @author NLS Team
 */
global $jayahr_option; 
$logo  = $jayahr_option['logo-image'];
$copyright  = $jayahr_option['copyright'];
?>
            </main>
            <footer>
            	<div class="container">
	      			<div class="footer-left">
	      				<?php if ( is_active_sidebar( 'iconic_vintage' ) ) : ?>
	      					<div class="item">
	      						<?php dynamic_sidebar( 'iconic_vintage' ); ?>
	      					</div>
	  					<?php endif; ?>
	  					<?php if ( is_active_sidebar( 'client_services' ) ) : ?>
	      					<div class="item">
	      						<?php dynamic_sidebar( 'client_services' ); ?>
	      					</div>
	  					<?php endif; ?>
	  					<?php if ( is_active_sidebar( 'contact_us' ) ) : ?>
	      					<div class="item">
	      						<?php dynamic_sidebar( 'contact_us' ); ?>
	      					</div>
	  					<?php endif; ?>
	      			</div>
	      			<div class="footer-right">
	      				<div class="logo-footer">
	      					<a href="<?php echo home_url(); ?>"><img src="<?php echo $logo['url']; ?>" alt=""></a>
	      				</div>
	      				<div class="socials">
	      					<?php echo do_shortcode('[show_socials_icon]'); ?>
	      				</div>
	      				<div class="copyright"><?php echo $copyright; ?></div>
	      			</div>
	      		</div>
            </footer>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>