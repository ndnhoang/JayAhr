<?php
/**
 * Template Name: Home
 * @link http://www.nlstech.net/
 * @author NLS Team
 * @package jayahr
 */
get_header(); ?>
	<!-- HOME SLIDER -->
	<?php if (have_rows('slider')) : ?>
		<div class="home-slider">
			<div class="owl-carousel">
				<?php while (have_rows('slider')) : 
					the_row();
					$image = get_sub_field('image');
					$link = get_sub_field('link');
					?>
					<div class="item"><a href="<?php echo ($link) ? $link : '#'; ?>" target="_blank"><img src="<?php echo $image; ?>" alt=""></a></div>
				<?php endwhile; ?>
			</div>
		</div> 
	<?php endif; ?>
	<!-- #HOME SLIDER -->
	<!-- HOME SECTION 1 -->
	<?php if (have_rows('section_1')) :
		while (have_rows('section_1')) : 
			the_row();
			$image = get_sub_field('image');
			$title = get_sub_field('title');
			$description = get_sub_field('description');
			$text_link = get_sub_field('text_link');
			$link = get_sub_field('link'); 
			?>
			<div class="home-sec-1" style="background-image: url(<?php echo $image; ?>); ">
				<div class="container">
					<div class="sec-content">
						<h3><?php echo $title; ?></h3>
						<div class="desc"><?php echo $description; ?></div>
						<a class="read-more" href="<?php echo ($link) ? $link : '#'; ?>"><?php echo $text_link; ?></a>
					</div>
				</div>
			</div>
		<?php endwhile; 
	endif; ?>
	<!-- #HOME SECTION 1 -->
	<!-- HOME SECTION 2 -->
	<?php if (have_rows('section_2')) :
		while (have_rows('section_2')) : 
			the_row();
			$image = get_sub_field('image');
			$title = get_sub_field('title');
			$description = get_sub_field('description');
			$text_link = get_sub_field('text_link');
			$link = get_sub_field('link'); 
			?>
			<div class="home-sec-2" style="background-image: url(<?php echo $image; ?>); ">
				<div class="container">
					<div class="sec-content">
						<h3><?php echo $title; ?></h3>
						<div class="desc"><?php echo $description; ?></div>
						<a class="read-more" href="<?php echo ($link) ? $link : '#'; ?>"><?php echo $text_link; ?></a>
					</div>
				</div>
			</div>
		<?php endwhile; 
	endif; ?>
	<!-- #HOME SECTION 2 -->
	<!-- OFFICIAL -->
	<?php if (have_rows('official')) : ?>
		<div class="home-official">
			<div class="container">
				<h3>@JayAhrOfficial</h3>
				<?php while (have_rows('official')) : 
					the_row();
					$gallery = get_sub_field('gallery');
					$link = get_sub_field('link'); 
					if ($gallery) : ?>
						<div class="gallery">
							<?php foreach ($gallery as $item) : ?>
								<div class="item"><img src="<?php echo $item['url']; ?>" alt=""></div>
							<?php endforeach; ?>
						</div>
						<a class="read-more" href="<?php echo ($link) ? $link : '#'; ?>">Load more</a>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
		</div>
	<?php endif; ?>
	<!-- #OFFICIAL -->
	<!-- CONTACT -->
	<?php if (have_rows('contact')) : ?>
		<?php while (have_rows('contact')) : 
			the_row();
			$background = get_sub_field('background');
			$map = get_sub_field('map'); 
			$title = get_sub_field('title');
			$information = get_sub_field('information');
			?>
			<div class="home-contact" style="background-image: url(<?php echo $background; ?>)">
				<div class="container">
					<div class="information">
						<h3><?php echo $title; ?></h3>
						<div class="content"><?php echo $information; ?></div>
					</div>
					<div class="map">
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9pVsP-Sh5vKDOU_6mGP3weZYs9qsX2wE"></script>
						<script type="text/javascript">
						(function($) {
						function new_map( $el ) {
							var $markers = $el.find('.marker');
							var args = {
								zoom		: 16,
								center		: new google.maps.LatLng(0, 0),
								mapTypeId	: google.maps.MapTypeId.ROADMAP
							};        	
							var map = new google.maps.Map( $el[0], args);
							map.markers = [];
							$markers.each(function(){
						    	add_marker( $(this), map );
							});
							center_map( map );
							return map;
						}
						function add_marker( $marker, map ) {
							var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
							var marker = new google.maps.Marker({
								position	: latlng,
								map			: map
							});
							map.markers.push( marker );
							if( $marker.html() )
							{
								var infowindow = new google.maps.InfoWindow({
									content		: $marker.html()
								});
								google.maps.event.addListener(marker, 'click', function() {
									infowindow.open( map, marker );
								});
							}
						}
						function center_map( map ) {
							var bounds = new google.maps.LatLngBounds();
							$.each( map.markers, function( i, marker ){
								var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
								bounds.extend( latlng );
							});
							if( map.markers.length == 1 )
							{
							    map.setCenter( bounds.getCenter() );
							    map.setZoom( 16 );
							}
							else
							{
								map.fitBounds( bounds );
							}
						}
						var map = null;
						$(document).ready(function(){
							$('.acf-map').each(function(){
								map = new_map( $(this) );
							});
						});
						})(jQuery);
						</script>
						<?php
						if( !empty($map) ):
						?>
						<div class="acf-map">
							<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
	<!-- #CONTACT -->
<?php get_footer();