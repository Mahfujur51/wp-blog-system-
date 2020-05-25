<?php

class Rocked_Projects extends WP_Widget {

    function rocked_projects() {
		$widget_ops = array('classname' => 'rocked_projects_widget', 'description' => __( 'Display your projects in a carousel', 'rocked') );
        parent::__construct(false, $name = __('Rocked FP: Projects', 'rocked'), $widget_ops);
		$this->alt_option_name = 'rocked_projects_widget';
		
    }

	function form($instance) {
		$title     		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    		= isset( $instance['number'] ) ? intval( $instance['number'] ) : -1;
		$category  		= isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$see_all   		= isset( $instance['see_all'] ) ? esc_url_raw( $instance['see_all'] ) : '';	
		$see_all_text  	= isset( $instance['see_all_text'] ) ? esc_html( $instance['see_all_text'] ) : '';		
	?>

	<p><?php _e('In order to display this widget, you must first add some projects from the dashboard. Add as many as you want and the theme will automatically display them all.', 'rocked'); ?></p>
	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of projects to show (-1 shows all of them):', 'rocked' ); ?></label>
	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
    <p><label for="<?php echo $this->get_field_id('see_all'); ?>"><?php _e('Enter an URL here if you want to section to link somewhere.', 'rocked'); ?></label>
	<input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'see_all' ); ?>" name="<?php echo $this->get_field_name( 'see_all' ); ?>" type="text" value="<?php echo $see_all; ?>" size="3" /></p>	
    <p><label for="<?php echo $this->get_field_id('see_all_text'); ?>"><?php _e('The text for the button [Defaults to <em>See all our projects</em> if left empty]', 'rocked'); ?></label>
	<input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'see_all_text' ); ?>" name="<?php echo $this->get_field_name( 'see_all_text' ); ?>" type="text" value="<?php echo $see_all_text; ?>" size="3" /></p>			
	<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Enter the slug for your category or leave empty to show all projects.', 'rocked' ); ?></label>
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
		if ( isset($alloptions['rocked_projects']) )
			delete_option('rocked_projects');		  
		  
		return $instance;
	}
	

	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'rocked_projects', 'widget' );
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		$title 			= apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$see_all 		= isset( $instance['see_all'] ) ? esc_url($instance['see_all']) : '';
		$see_all_text 	= isset( $instance['see_all_text'] ) ? esc_html($instance['see_all_text']) : '';		
		$number 		= ( ! empty( $instance['number'] ) ) ? intval( $instance['number'] ) : -1;
		if ( ! $number )
			$number = -1;			
		$category 		= isset( $instance['category'] ) ? esc_attr($instance['category']) : '';

		$r = new WP_Query(array(
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'post_type' 		  => 'projects',
			'posts_per_page'	  => $number,
			'category_name'		  => $category			
		) );

		echo $args['before_widget'];

		if ($r->have_posts()) :
?>

		<?php if ( $title ) echo $before_title . $title . $after_title; ?>

		<div class="roll-works">
			<div class="work-wrap">
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
				<?php $link = get_post_meta( get_the_ID(), 'wpcf-project-link', true ); ?>
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="item-work">
					<?php if ($link == '') : ?>
					<a class="item-wrap" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php else: ?>
					<a class="item-wrap" href="<?php echo esc_url($link); ?>">
					<?php endif; ?>	
					<div class="overlay">
						<div class="content">
							<h4><?php the_title(); ?></h4>
							<ul class="cats">
							<?php
								$category = get_the_category();
								echo $category[0]->cat_name;
							?>
							</ul>
						</div>
					</div>
					<?php the_post_thumbnail('rocked-medium-thumb'); ?>
					</a>
				</div>
				<?php endif; ?>	
			<?php endwhile; ?>
			</div>
		</div>

		<?php if ($see_all != '') : ?>
			<a href="<?php echo esc_url($see_all); ?>" class="roll-button more-button">
				<?php if ($see_all_text) : ?>
					<?php echo $see_all_text; ?>
				<?php else : ?>
					<?php echo __('See all our projects', 'rocked'); ?>
				<?php endif; ?>
			</a>
		<?php endif; ?>	
	
	<?php
		wp_reset_postdata();	
		endif;

		echo $args['after_widget'];

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'rocked_projects', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}
	
}