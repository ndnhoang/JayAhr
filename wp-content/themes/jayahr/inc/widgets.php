<?php 
/**
 * Adds Blogs_Widget widget.
 */
// register Foo_Widget widget
function register_blogs_widget() {
    register_widget( 'Blogs_Widget' );
}
add_action( 'widgets_init', 'register_blogs_widget' );

class Blogs_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'news_widget', // Base ID
			__( 'Blog news', 'arrowicode' ), // Name
			array( 'description' => __( 'A Widget show blog news', 'arrowicode' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		//echo __( esc_attr( 'Hello, World!' ), 'text_domain' );
		$number = !empty($instance['number']) ? $instance['number'] : 4;
		$args_blog = array (
	        'post_type'      => array( 'post' ),
	        'post_status'    => array( 'publish' ),
	        'posts_per_page' => $number,
	        'order'          => 'DESC',
	        'orderby'        => 'date',
	    );

	    $blog_query = new WP_Query( $args_blog );
	    ob_start();
	    if ( $blog_query->have_posts() ) {
	        echo '<div class="widget-blogs">';
	        while ( $blog_query->have_posts() ) :
	            $blog_query->the_post();

	            if ( has_post_thumbnail() ) {
	                $url_img = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
	            }else{
	                $url_img = get_stylesheet_directory_uri(). '/images/no_img.jpg';
	            }
	            //$img_src = crop_img( 400, 225, $url_img);
	            ?>

	            <div class="item">
	                
                    <div class='content'>
                        <a class="image" href='<?php the_permalink(); ?>'><img src='<?php echo $url_img; ?>' alt='<?php the_title(); ?>'/></a>
                        <h6><a title='<?php the_title(); ?>' href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h6> 
                    </div>
	                    
	                
	            </div>
	            <?php
	        endwhile;
	        echo '</div>';
	    } 

	    // Restore original Post Data
	    wp_reset_postdata();
	    $list_project = ob_get_contents();
	    ob_end_clean();
	    echo $list_project;
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( esc_attr( 'Number:' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';

		return $instance;
	}

} // class Foo_Widget