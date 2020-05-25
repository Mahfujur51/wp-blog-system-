<?php

class Rocked_Action extends WP_Widget {

    function rocked_action() {
		$widget_ops = array('classname' => 'rocked_action_widget', 'description' => __( 'Display a call to action block.', 'rocked') );
        parent::__construct(false, $name = __('Rocked FP: Call to action', 'rocked'), $widget_ops);
		$this->alt_option_name = 'rocked_action_widget';
			
    }
	
	function form($instance) {
		$title     			= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';		
		$action_text 		= isset( $instance['action_text'] ) ? esc_textarea( $instance['action_text'] ) : '';
		$action_btn_link 	= isset( $instance['action_btn_link'] ) ? esc_url( $instance['action_btn_link'] ) : '';
		$action_btn_text 	= isset( $instance['action_btn_text'] ) ? esc_html( $instance['action_btn_text'] ) : '';
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('action_text'); ?>"><?php _e('Enter your call to action.', 'rocked'); ?></label>
	<textarea class="widefat" id="<?php echo $this->get_field_id('action_text'); ?>" name="<?php echo $this->get_field_name('action_text'); ?>"><?php echo $action_text; ?></textarea></p>
	<p><label for="<?php echo $this->get_field_id('action_btn_link'); ?>"><?php _e('Link for the button', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('action_btn_link'); ?>" name="<?php echo $this->get_field_name('action_btn_link'); ?>" type="text" value="<?php echo $action_btn_link; ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('action_btn_text'); ?>"><?php _e('Title for the button', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('action_btn_text'); ?>" name="<?php echo $this->get_field_name('action_btn_text'); ?>" type="text" value="<?php echo $action_btn_text; ?>" /></p>
	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 			 = strip_tags($new_instance['title']);
		$instance['action_btn_link'] = esc_url_raw($new_instance['action_btn_link']);
		$instance['action_btn_text'] = strip_tags($new_instance['action_btn_text']);
		if ( current_user_can('unfiltered_html') ) {
			$instance['action_text'] = $new_instance['action_text'];
		} else {
			$instance['action_text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['action_text']) ) );
		}			

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['rocked_action']) )
			delete_option('rocked_action');		  
		  
		return $instance;
	}
	
	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'rocked_action', 'widget' );
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

		$title 			 = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title 			 = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$action_text 	 = isset( $instance['action_text'] ) ? $instance['action_text'] : '';
		$action_btn_link = isset( $instance['action_btn_link'] ) ? esc_url($instance['action_btn_link']) : '';
		$action_btn_text = isset( $instance['action_btn_text'] ) ? esc_html($instance['action_btn_text']) : '';

		echo $args['before_widget'];

		if ( $title ) echo $before_title . $title . $after_title;
?>
        <div class="roll-promobox">
			<div class="promo-wrap">
				<?php if ($action_text !='') : ?>
				<div class="promobox-content">
					<h3 class="title"><?php echo $action_text; ?></h3>
				</div>
				<?php endif; ?>
				<div class="promobox-buttons">
					<a href="<?php echo $action_btn_link; ?>" class="roll-button"><?php echo $action_btn_text; ?></a>
				</div>
			</div>
        </div>
	<?php

		echo $args['after_widget'];

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'rocked_action', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}
	
}