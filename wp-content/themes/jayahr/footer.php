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
            <div id="login_form">
            	<h3>Login</h3>
            	<span class="close"><img src="<?php echo get_stylesheet_directory_uri().'/images/close-icon.png' ?>" alt="close"></span>
            	<div class="form-content">
            		<div class="form-group form-input">
            			<label>Username</label>
            			<div class="form-control">
            				<input type="text" name="username" placeholder="Type your username">
            				<img class="normal" src="<?php echo get_stylesheet_directory_uri().'/images/user.png'; ?>" alt="username">
            				<img class="focus" src="<?php echo get_stylesheet_directory_uri().'/images/user-black.png'; ?>" alt="username">
            			</div>
            		</div>
            		<div class="form-group form-input">
            			<label>Password</label>
            			<div class="form-control">
            				<input type="password" name="password" placeholder="Type your password">
            				<img class="normal" src="<?php echo get_stylesheet_directory_uri().'/images/key.png'; ?>" alt="password">
            				<img class="focus" src="<?php echo get_stylesheet_directory_uri().'/images/key-black.png'; ?>" alt="password">
            			</div>
            		</div>
            		<div class="forgot-group">
            			<a href="#">Forgot password?</a>
            		</div>
            		<div class="form-group">
            			<button type="submit">LOGIN</button>
            		</div>
            		<div class="register-group">
            			<span>Or Sign Up Using</span>
            			<a href="#">SIGN UP</a>
            		</div>
            	</div>
            </div>
            <div id="overlay"></div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>