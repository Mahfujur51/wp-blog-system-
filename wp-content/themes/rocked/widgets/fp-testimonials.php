<?php

class Rocked_Testimonials extends WP_Widget {

    function rocked_testimonials() {
		$widget_ops = array('classname' => 'rocked_testimonials_widget', 'description' => __( 'Display your testimonials in a slider.', 'rocked') );
        parent::__construct(false, $name = __('Rocked FP: Testimonials', 'rocked'), $widget_ops);
		$this->alt_option_name = 'rocked_testimonials_widget';
				
    }
	
	function form($instance) {
		$title     		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    		= isset( $instance['number'] ) ? intval( $instance['number'] ) : -1;
		$category   	= isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$see_all   		= isset( $instance['see_all'] ) ? esc_url_raw( $instance['see_all'] ) : '';
		$see_all_text  	= isset( $instance['see_all_text'] ) ? esc_html( $instance['see_all_text'] ) : '';		
	?>

	<p><?php _e('In order to display this widget, you must first add some testimonials from your admin area.', 'rocked'); ?></p>
	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of testimonials to show (-1 shows all of them):', 'rocked' ); ?></label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
    <p><label for="<?php echo $this->get_field_id('see_all'); ?>"><?php _e('The URL for your button [In case you want a button below your testimonials block]', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'see_all' ); ?>" name="<?php echo $this->get_field_name( 'see_all' ); ?>" type="text" value="<?php echo $see_all; ?>" size="3" /></p>	
    <p><label for="<?php echo $this->get_field_id('see_all_text'); ?>"><?php _e('The text for the button [Defaults to <em>See all our testimonials</em> if left empty]', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'see_all_text' ); ?>" name="<?php echo $this->get_field_name( 'see_all_text' ); ?>" type="text" value="<?php echo $see_all_text; ?>" size="3" /></p>		
	<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Enter the slug for your category or leave empty to show all testimonials.', 'rocked' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo $category; ?>" size="3" /></p>
		
	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['number'] 		= strip_tags($new_instance['number']);
		$instance['see_all'] 		= esc_url_raw( $new_instance['see_all'] );	
		$instance['see_all_text'] 	= strip_tags($new_instance['see_all_text']);
		$instance['category'] 		= strip_tags($new_instance['category']);		

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['rocked_testimonials']) )
			delete_option('rocked_testimonials');		  
		  
		return $instance;
	}
	
	// display widget
	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'rocked_testimonials', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title 			= ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title 			= apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$see_all 		= isset( $instance['see_all'] ) ? esc_url($instance['see_all']) : '';
		$see_all_text 	= isset( $instance['see_all_text'] ) ? esc_html($instance['see_all_text']) : '';
		$number 		= ( ! empty( $instance['number'] ) ) ? intval( $instance['number'] ) : -1;
		if ( ! $number ) {
			$number = -1;
		}			
		$category 		= isset( $instance['category'] ) ? esc_attr($instance['category']) : '';

		$testimonials = new WP_Query( array(
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'post_type' 		  => 'testimonials',
			'posts_per_page'	  => $number,
			'category_name'		  => $category
		) );
		
		echo $args['before_widget'];

		if ($testimonials->have_posts()) :
?>
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>
			<div class="col-md-12">
				<div class="roll-testimonials">
					<?php while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?>
						<?php $function = get_post_meta( get_the_ID(), 'wpcf-client-function', true ); ?>
                        <div class="customer">
                            <blockquote class="whisper"><?php the_content(); ?></blockquote>             
                            <div class="name">
                            	<?php the_title(); ?>
                            	<span>&#9472; <?php echo esc_html($function); ?></span>
                            </div>
                        </div>
					<?php endwhile; ?>
				</div>
			</div>	

			<?php if ($see_all != '') : ?>
				<a href="<?php echo esc_url($see_all); ?>" class="roll-button more-button">
					<?php if ($see_all_text) : ?>
						<?php echo $see_all_text; ?>
					<?php else : ?>
						<?php echo __('See all our testimonials', 'rocked'); ?>
					<?php endif; ?>
				</a>
			<?php endif; ?>	


		</section>		
	<?php
		echo $args['after_widget'];
		wp_reset_postdata();
		endif;
		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'rocked_testimonials', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}
	
}