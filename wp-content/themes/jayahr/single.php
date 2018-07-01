<?php
/**
 * @link https://arrowicode.com
 * @package arrowicode
 * @author vietsmiler
 */
get_header();?>
<div class="container">	
	<?php while ( have_posts() ) : the_post();set_view(get_the_ID());$date = get_the_date();$current_id = get_the_ID();?>
		<div class="row">
			<div class="col-md-9" id="content">
				<div class="header-title">
					<h3 class="title"><?php the_title() ?></h3>
					<p class="date">Ngày đăng: <?php echo $date; ?></p>
				</div>
				<div class="desc">
					<?php the_content(); ?>
				</div>
				<div class="fb-comment">
					<h4 class="title">Bình luận</h4>
					<div class="fb-comments" data-width="100%" data-href="<?php the_permalink(); ?>" data-numposts="5"></div>
				</div>
			</div>
			<div class="col-md-3" id="sidebar">
				<?php dynamic_sidebar("sidebar_post");?>
			</div>
		</div>
		<div class="list-carousel">
			<h4 class="title-carousel"><span>BÀI VIẾT LIÊN QUAN</span></h4>
			<div class="related-post owl-carousel">
				<?php
				$related = new WP_Query(array(
					'post_type'=>'post',
					'post_status'=>'publish',
					'orderby' => 'ID',
					'order' => 'DESC',
					'post__not_in' => array($current_id),
					'posts_per_page'=> '10'
				));?>
				<?php while ($related->have_posts()) : $related->the_post();?>
					<div class="item">      
						<?php
						if(has_post_thumbnail())
							$url_img =  wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
						else
							$url_img = get_stylesheet_directory_uri().'/images/no_img.jpg';
						?>                
						<a class='thumb' href="<?php the_permalink(); ?>"><img src="<?php echo crop_img(291,170,$url_img)?>" alt="<?php the_title()?>"/></a>
						<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="post-content"><?php echo wp_trim_words(get_the_excerpt(),30,''); ?></p>										
					</div>
				<?php endwhile ; wp_reset_query() ;?>
			</div>
		</div>			
	<?php endwhile; ?>	
</div>
<?php get_footer();