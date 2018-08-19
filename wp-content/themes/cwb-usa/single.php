<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CWB-USA
 */

get_header(); ?>

 <div id="content-sidebar-wrapper">  
    
    <div id="primary" class="medium-9 columns">

 
		<?php
		while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php $image = get_field('hero_image');
		      $size = 'large'; // 870 x (max 1024)
		      $featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
		      // has_post_thumbnail returns true if there is any image in the post content

		if ($image) { ?>
			<div class="feat-img row" style="margin: 0 12px 24px 0;"><?php	echo wp_get_attachment_image( $image, $size ); ?></div>
		<?php }      

		elseif ( ! empty( $featured_image_url ) ) { ?>
			<div class="feat-img row" style="margin: 0 12px 24px 0;"><?php	echo the_post_thumbnail('large'); ?></div>
		 <?php } ?>
		<header class="entry-header" style="margin: 0 0 24px;">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<div class="entry-meta">
				<?php cwb_usa_posted_on(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->



	
	<div class="entry-content">

		<?php the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'cwb-usa' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cwb-usa' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php cwb_usa_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->


	<?php the_post_navigation( array(
	            'prev_text'                  => __( 'Previous Post: %title' ),
	            'next_text'                  => __( 'Next Post: %title' ),
	            'screen_reader_text' => __( 'Continue Reading' ),
        	) ); ?>

<div class="wpfai">Share this: <?php if(function_exists('wpfai_social')) { echo wpfai_social(); } ?></div>

			<?php // If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>


	</div><!-- #primary -->
<?php
get_sidebar(); ?>

</div>

<?php get_footer();
