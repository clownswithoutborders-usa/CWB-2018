<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CWB-USA
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php $image = get_field('hero_image');
		      $size = 'projectfeature'; // 600 x 400
		      $featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
		      // has_post_thumbnail returns true if there is any image in the post content

		if ($image) { ?>
			<div class="feat-img row large-5"><?php	echo wp_get_attachment_image( $image, $size ); ?></div>
		<?php }      

		elseif ( ! empty( $featured_image_url ) ) { ?>
			<div class="feat-img row large-5"><?php	echo the_post_thumbnail('projectfeature'); ?></div>
		 <?php } ?>
	<header class="entry-header" style="margin-bottom: 24px;">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php cwb_usa_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php elseif ('update' === get_post_type() ) : ?>
		<div class="entry-meta">
        <?php if(get_field('project_update_date')) { ?>
        <p>Posted on <span><?php $date = DateTime::createFromFormat('Ymd', get_field( 'project_update_date' ));
            echo $date->format('F d, Y'); ?></span> 
            <?php } ?>

            <?php if(get_field('project_update_author')) { ?>
          by <span><?php the_field( 'project_update_author' ); ?> 
            <?php } ?>
            
            </p>
        </div>
		<?php endif; ?>
	</header><!-- .entry-header -->



	
	<div class="entry-content">
	<?php if ( is_search() || is_home() || is_category() || is_tag() ) : ?>
		<?php if (get_field( 'project_update_summary' )) {
			the_field ('project_update_summary'); 
			} else {
		 the_excerpt(); 
		} 
		else :
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'cwb-usa' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cwb-usa' ),
				'after'  => '</div>',
			) );
		?>
	<?php endif; ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php cwb_usa_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
