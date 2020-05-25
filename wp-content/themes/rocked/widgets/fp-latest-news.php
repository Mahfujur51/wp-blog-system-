<?php

class Rocked_Latest_News extends WP_Widget {

    function rocked_latest_news() {
		$widget_ops = array('classname' => 'rocked_latest_news_widget', 'description' => __( 'Show the latest news from your blog.', 'rocked') );
        parent::__construct(false, $name = __('Rocked FP: Latest News', 'rocked'), $widget_ops);
		$this->alt_option_name = 'rocked_latest_news_widget';
	
    }
	
	function form($instance) {
		$title     		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$category  		= isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$see_all_text  	= isset( $instance['see_all_text'] ) ? esc_html( $instance['see_all_text'] ) : '';											
	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'rocked'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Enter the slug for your category or leave empty to show posts from all categories.', 'rocked' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo $category; ?>" size="3" /></p>	

    <p><label for="<?php echo $this->get_field_id('see_all_text'); ?>"><?php _e('Add the text for the button here if you want to change the default <em>See all our news</em>', 'rocked'); ?></label>
	<input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'see_all_text' ); ?>" name="<?php echo $this->get_field_name( 'see_all_text' ); ?>" type="text" value="<?php echo $see_all_text; ?>" size="3" /></p>		

	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['category'] 		= strip_tags($new_instance['category']);
		$instance['see_all_text'] 	= strip_tags($new_instance['see_all_text']);						

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['rocked_latest_news']) )
			delete_option('rocked_latest_news');		  
		  
		return $instance;
	}
	
	// display widget
	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'rocked_latest_news', 'widget' );
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
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$category = isset( $instance['category'] ) ? esc_attr($instance['category']) : '';
		$see_all_text = isset( $instance['see_all_text'] ) ? esc_html($instance['see_all_text']) : __( 'See all our news', 'rocked' );
		if ($see_all_text == '') {
			$see_all_text = __( 'See all our news', 'rocked' );
		}

		$r = new WP_Query( array(
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'posts_per_page'	  => 3,
			'category_name'		  => $category
		) );

		echo $args['before_widget'];

		if ($r->have_posts()) :
?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>

		<div class="roll-news clearfix">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<div class="blog-post entry">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-thumb">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_post_thumbnail('rocked-medium-thumb'); ?>
					</a>			
				</div>	
			<?php endif; ?>						
			<?php the_title( sprintf( '<h3 class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
				<div class="entry-footer">
					<div class="meta">
						<span class="author vcard"><a class="url fn n" href="'<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span>
						<?php
						$cats = get_the_category();
						if ($cats) {
						  echo '&#47;&nbsp;<a class="fp-cats" href="' . get_category_link( $cats[0]->term_id ) . '"' . '>' . $cats[0]->cat_name.'</a> ';
						}
						?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
		</div>

		<?php $cat = get_term_by('slug', $category, 'category') ?>
		<?php if ($category) : //Link to the category page instead of blog page if a category is selected ?>
			<a href="<?php echo esc_url(get_category_link(get_cat_ID($cat -> name))); ?>" class="roll-button more-button"><?php echo $see_all_text; ?></a>
		<?php else : ?>
			<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="roll-button more-button"><?php echo $see_all_text; ?></a>
		<?php endif; ?>		
	<?php
		echo $args['after_widget'];
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'rocked_latest_news', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}
	
}