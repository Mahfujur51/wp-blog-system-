<?php
/**
 * @package Rocked
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content">
		<?php if ( has_post_thumbnail() && ( get_theme_mod( 'post_feat_image' ) != 1 ) ) : ?>
			<div class="entry-thumb">
				<?php the_post_thumbnail('rocked-large-thumb'); ?>
			</div>
		<?php endif; ?>
		
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

			<?php if (get_theme_mod('hide_meta_single') != 1 ) : ?>
			<div class="post-meta">
				<?php rocked_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rocked' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<?php if (get_theme_mod('hide_meta_single') != 1 ) : ?>
		<footer class="entry-footer">
			<?php rocked_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div>
</article><!-- #post-## -->
