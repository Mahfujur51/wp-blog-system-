<?php
/**
 * Services archives template
 *
 * @package Rocked
 */

get_header(); ?>

	<div id="primary" class="content-area fullwidth">
		<main id="main" class="content-wrap" role="main">

		<?php if ( have_posts() ) : ?>
		<div class="employees-area clearfix">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php //Get the custom field values
					$position = get_post_meta( get_the_ID(), 'wpcf-position', true );
					$facebook = get_post_meta( get_the_ID(), 'wpcf-facebook', true );
					$twitter  = get_post_meta( get_the_ID(), 'wpcf-twitter', true );
					$google   = get_post_meta( get_the_ID(), 'wpcf-google-plus', true );
					$link     = get_post_meta( get_the_ID(), 'wpcf-custom-link', true );
				?>
				<div class="roll-team">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="photo">
						<div class="overlay">
							<div class="content">
								<p class="text"><?php echo wp_kses_post(wp_trim_words( get_the_content(), 10, '' ));?></p>
								<ul class="socials">
									<?php if ($facebook != '') : ?>
										<li><a class="facebook" href="<?php echo esc_url($facebook); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
									<?php endif; ?>
									<?php if ($twitter != '') : ?>
										<li><a class="twitter" href="<?php echo esc_url($twitter); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
									<?php endif; ?>
									<?php if ($google != '') : ?>
										<li><a class="google" href="<?php echo esc_url($google); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
						<?php the_post_thumbnail('rocked-medium-thumb'); ?>
					</div>
					<?php endif; ?>
					<div class="info">
				        <?php if ($link == '') : ?>
				        	<h3><?php the_title(); ?></h3>
				        <?php else : ?>
				        	<h3><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h3>
				        <?php endif; ?>
						<span><?php echo esc_html($position); ?></span>
					</div>
				</div>
			<?php endwhile; ?>
		</div>	
			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
