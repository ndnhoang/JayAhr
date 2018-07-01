<?php
/**
 * @link https://arrowicode.com
 * @package arrowicode
 * @author vietsmiler
 */
get_header();?>
<div class="container">
		<section class="error-404 row">
			<div class="img-404 col-md-4"> <img src="<?php echo get_stylesheet_directory_uri().'/images/404.png'; ?>" alt="404"></div>
			<div class="col-md-8">
				<div class="content-404">
					<h3>Kein Ergebnis !</h3>
					<p>Die Information ist nicht verfügbar</p>
					<p>Come back <a href="<?php echo home_url(); ?>">Home</a></p>
				</div>				
			</div><!-- .page-content -->
		</section><!-- .error-404 -->
</div>
<?php get_footer();