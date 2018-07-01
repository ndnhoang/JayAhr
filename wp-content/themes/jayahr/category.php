<?php
/**
 * @link https://arrowicode.com
 * @package arrowicode
 * @author vietsmiler
 */
get_header(); $term_id = get_queried_object_id();$term = get_queried_object();?>
<div class="container"> 
	<div class="row">
		<div class="col-md-9" id="content">
<?php global $wp_query;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$wp_query = new WP_Query(array(
    'post_type' => 'post',
    'orderby' => 'date',
	'order'=>'desc',
	'post_status' => 'publish',
    'posts_per_page'=>8,
    'category__in' => array($term_id),
    'paged' =>$paged
));
if($wp_query->have_posts()):
	echo '<div id="feature-course" class="custom-feature-course">';
		echo '<h2 class="title-sec">'.$term->name.'</h2>';
		echo '<div class="list-item">';
				while($wp_query->have_posts()): $wp_query->the_post();
					if(has_post_thumbnail())
						$url_img =  wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
					else
						$url_img = get_stylesheet_directory_uri().'/images/no_img.jpg';
					$fileName = pathinfo($url_img, PATHINFO_FILENAME);
					$terms = wp_get_post_terms( get_the_ID(), 'area' );
					$time = get_the_date();
					$term_name = "";
					foreach ($terms as $term) {
						if($term_name == ""){
							$term_name = $term->name;
						}else{
							$term_name = $term_name.', '.$term->name;
						}
					}?>
					<div class="item">
						<div class="wrap">
							<div class="top">
								<img src="<?php echo crop_img(339,180,$url_img)?>" alt="<?php echo $fileName?>" class="thumb"/>
								<span class="time"><?php echo $time; ?></span>
								<div class="overlay-item"></div>								
							</div>
							<div class="middle">
								<h3 class="title-post"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
								<p class="desc"><?php echo wp_trim_words(get_the_excerpt(),50); ?></p>
								<div class="bottom">
									<a href="<?php the_permalink(); ?>" class="view-more"><?php echo __("Xem thêm"); ?></a>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile;
		echo '</div>';
		wp_pagenavi();wp_reset_query();
	echo '</div>';
endif;?>
</div>
		<div class="col-md-3" id="sidebar">
			<?php dynamic_sidebar("sidebar_post");?>
		</div>
	</div>
</div>
<?php get_footer();