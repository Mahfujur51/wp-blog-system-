<?php

class Rocked_Facts extends WP_Widget {

// constructor
    function rocked_facts() {
		$widget_ops = array('classname' => 'rocked_facts_widget', 'description' => __( 'Show your visitors some facts about your company.', 'rocked') );
        parent::__construct(false, $name = __('Rocked FP: Facts', 'rocked'), $widget_ops);
		$this->alt_option_name = 'rocked_facts_widget';	
    }
	
	// widget form creation
	function form($instance) {

	// Check values
		$title     			= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$fact_one   		= isset( $instance['fact_one'] ) ? esc_html( $instance['fact_one'] ) : '';
		$fact_one_max   	= isset( $instance['fact_one_max'] ) ? absint( $instance['fact_one_max'] ) : '';
		$fact_one_icon  	= isset( $instance['fact_one_icon'] ) ? esc_html( $instance['fact_one_icon'] ) : '';		
		$fact_two   		= isset( $instance['fact_two'] ) ? esc_attr( $instance['fact_two'] ) : '';
		$fact_two_max   	= isset( $instance['fact_two_max'] ) ? absint( $instance['fact_two_max'] ) : '';
		$fact_two_icon  	= isset( $instance['fact_two_icon'] ) ? esc_html( $instance['fact_two_icon'] ) : '';
		$fact_three   		= isset( $instance['fact_three'] ) ? esc_attr( $instance['fact_three'] ) : '';
		$fact_three_max 	= isset( $instance['fact_three_max'] ) ? absint( $instance['fact_three_max'] ) : '';
		$fact_three_icon  	= isset( $instance['fact_three_icon'] ) ? esc_html( $instance['fact_three_icon'] ) : '';
		$fact_four   		= isset( $instance['fact_four'] ) ? esc_attr( $instance['fact_four'] ) : '';		
		$fact_four_max  	= isset( $instance['fact_four_max'] ) ? absint( $instance['fact_four_max'] ) : '';
		$fact_four_icon  	= isset( $instance['fact_four_icon'] ) ? esc_html( $instance['fact_four_icon'] ) : '';	
	?>
	<p><?php _e('You can find a list of the available icons ', 'rocked'); ?><a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank"><?php _e('here.', 'rocked'); ?></a>&nbsp;<?php _e('Usage example: <strong>fa-android</strong>', 'rocked'); ?></p>
	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<!-- fact one -->
	<p>
	<label for="<?php echo $this->get_field_id('fact_one'); ?>"><?php _e('First fact name', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_one'); ?>" name="<?php echo $this->get_field_name('fact_one'); ?>" type="text" value="<?php echo $fact_one; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('fact_one_max'); ?>"><?php _e('First fact value', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_one_max'); ?>" name="<?php echo $this->get_field_name('fact_one_max'); ?>" type="text" value="<?php echo $fact_one_max; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('fact_one_icon'); ?>"><?php _e('First fact icon', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_one_icon'); ?>" name="<?php echo $this->get_field_name('fact_one_icon'); ?>" type="text" value="<?php echo $fact_one_icon; ?>" />
	</p>

	<!-- fact two -->
	<p>
	<label for="<?php echo $this->get_field_id('fact_two'); ?>"><?php _e('Second fact name', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_two'); ?>" name="<?php echo $this->get_field_name('fact_two'); ?>" type="text" value="<?php echo $fact_two; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('fact_two_max'); ?>"><?php _e('Second fact value', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_two_max'); ?>" name="<?php echo $this->get_field_name('fact_two_max'); ?>" type="text" value="<?php echo $fact_two_max; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('fact_two_icon'); ?>"><?php _e('Second fact icon', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_two_icon'); ?>" name="<?php echo $this->get_field_name('fact_two_icon'); ?>" type="text" value="<?php echo $fact_two_icon; ?>" />
	</p>	

	<!-- fact three -->
	<p>
	<label for="<?php echo $this->get_field_id('fact_three'); ?>"><?php _e('Third fact name', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_three'); ?>" name="<?php echo $this->get_field_name('fact_three'); ?>" type="text" value="<?php echo $fact_three; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('fact_three_max'); ?>"><?php _e('Third fact value', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_three_max'); ?>" name="<?php echo $this->get_field_name('fact_three_max'); ?>" type="text" value="<?php echo $fact_three_max; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('fact_three_icon'); ?>"><?php _e('Third fact icon', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_three_icon'); ?>" name="<?php echo $this->get_field_name('fact_three_icon'); ?>" type="text" value="<?php echo $fact_three_icon; ?>" />
	</p>	

	<!-- fact four -->
	<p>
	<label for="<?php echo $this->get_field_id('fact_four'); ?>"><?php _e('Fourth fact name', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_four'); ?>" name="<?php echo $this->get_field_name('fact_four'); ?>" type="text" value="<?php echo $fact_four; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('fact_four_max'); ?>"><?php _e('Fourth fact value', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_four_max'); ?>" name="<?php echo $this->get_field_name('fact_four_max'); ?>" type="text" value="<?php echo $fact_four_max; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('fact_four_icon'); ?>"><?php _e('Fourth fact icon', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('fact_four_icon'); ?>" name="<?php echo $this->get_field_name('fact_four_icon'); ?>" type="text" value="<?php echo $fact_four_icon; ?>" />
	</p>							

	<?php
	}

	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['fact_one'] 		= strip_tags($new_instance['fact_one']);
		$instance['fact_one_max'] 	= intval($new_instance['fact_one_max']);
		$instance['fact_one_icon'] 	= strip_tags($new_instance['fact_one_icon']);
		$instance['fact_two'] 		= strip_tags($new_instance['fact_two']);
		$instance['fact_two_max'] 	= intval($new_instance['fact_two_max']);
		$instance['fact_two_icon'] 	= strip_tags($new_instance['fact_two_icon']);
		$instance['fact_three'] 	= strip_tags($new_instance['fact_three']);
		$instance['fact_three_max']	= intval($new_instance['fact_three_max']);
		$instance['fact_three_icon']= strip_tags($new_instance['fact_three_icon']);
		$instance['fact_four'] 		= strip_tags($new_instance['fact_four']);
		$instance['fact_four_max'] 	= intval($new_instance['fact_four_max']);
		$instance['fact_four_icon'] = strip_tags($new_instance['fact_four_icon']);

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['rocked_facts']) )
			delete_option('rocked_facts');		  
		  
		return $instance;
	}

	// display widget
	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'rocked_facts', 'widget' );
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
		$fact_one   	= isset( $instance['fact_one'] ) ? esc_html( $instance['fact_one'] ) : '';
		$fact_one_max  	= isset( $instance['fact_one_max'] ) ? absint( $instance['fact_one_max'] ) : '';
		$fact_one_icon  = isset( $instance['fact_one_icon'] ) ? esc_html( $instance['fact_one_icon'] ) : '';
		$fact_two   	= isset( $instance['fact_two'] ) ? esc_attr( $instance['fact_two'] ) : '';
		$fact_two_max  	= isset( $instance['fact_two_max'] ) ? absint( $instance['fact_two_max'] ) : '';
		$fact_two_icon  = isset( $instance['fact_two_icon'] ) ? esc_html( $instance['fact_two_icon'] ) : '';
		$fact_three   	= isset( $instance['fact_three'] ) ? esc_attr( $instance['fact_three'] ) : '';
		$fact_three_max	= isset( $instance['fact_three_max'] ) ? absint( $instance['fact_three_max'] ) : '';
		$fact_three_icon= isset( $instance['fact_three_icon'] ) ? esc_html( $instance['fact_three_icon'] ) : '';
		$fact_four   	= isset( $instance['fact_four'] ) ? esc_attr( $instance['fact_four'] ) : '';		
		$fact_four_max 	= isset( $instance['fact_four_max'] ) ? absint( $instance['fact_four_max'] ) : '';
		$fact_four_icon = isset( $instance['fact_four_icon'] ) ? esc_html( $instance['fact_four_icon'] ) : '';		

		echo $args['before_widget'];
?>

		<?php if ( $title ) echo $before_title . $title . $after_title; ?>

		<?php if ($fact_one !='') : ?>
		<div class="fact col-md-3 col-sm-3 col-xs-3">
			<div class="roll-counter">
				<i class="fa <?php echo $fact_one_icon; ?>"></i>
				<div class="numb-count" data-to="<?php echo $fact_one_max; ?>" data-speed="2000" data-waypoint-active="yes"><?php echo $fact_one_max; ?></div>
				<div class="name-count"><?php echo $fact_one; ?></div>
			</div>
		</div>
		<?php endif; ?>
		<?php if ($fact_two !='') : ?>
		<div class="fact col-md-3 col-sm-3 col-xs-3">
			<div class="roll-counter">
				<i class="fa <?php echo $fact_two_icon; ?>"></i>
				<div class="numb-count" data-to="<?php echo $fact_two_max; ?>" data-speed="2000" data-waypoint-active="yes"><?php echo $fact_two_max; ?></div>
				<div class="name-count"><?php echo $fact_two; ?></div>
			</div>
		</div>
		<?php endif; ?>
		<?php if ($fact_three !='') : ?>
		<div class="fact col-md-3 col-sm-3 col-xs-3">
			<div class="roll-counter">
				<i class="fa <?php echo $fact_three_icon; ?>"></i>
				<div class="numb-count" data-to="<?php echo $fact_three_max; ?>" data-speed="2000" data-waypoint-active="yes"><?php echo $fact_three_max; ?></div>
				<div class="name-count"><?php echo $fact_three; ?></div>
			</div>
		</div>
		<?php endif; ?>
		<?php if ($fact_four !='') : ?>
		<div class="fact col-md-3 col-sm-3 col-xs-3">
			<div class="roll-counter">
				<i class="fa <?php echo $fact_four_icon; ?>"></i>
				<div class="numb-count" data-to="<?php echo $fact_four_max; ?>" data-speed="2000" data-waypoint-active="yes"><?php echo $fact_four_max; ?></div>				
				<div class="name-count"><?php echo $fact_four; ?></div>
			</div>
		</div>
		<?php endif; ?>

	<?php
		echo $args['after_widget'];

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'rocked_facts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}
	
}