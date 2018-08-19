<?php
/**
 * Template Name: Our Work Section Template (Section submenu on left)
 *
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CWB-USA
 */

get_header(); ?>

<div class="medium-3 large-2 columns graynav">

     <?php wp_nav_menu( array( 'theme_location' => 'projects', 'menu_id' => 'secondary-menu' ) ); ?>

</div>

	<div id="primary" class="medium-9 large-10 columns">

<?php $image = get_field('hero_image');
                $size = 'hero'; // 1600 x 550

                if( $image ) { ?>
            <div class="hero-not-page" style="margin: 0 -.9375rem;">
                    <div class="hero">
                        <?php  echo wp_get_attachment_image( $image, $size ); ?>
                    </div>
            </div> 
            <?php } ?>  

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->


                    <?php get_template_part( 'template-parts/content', 'flexible-content' ); ?>     

                    <?php get_template_part( 'template-parts/content', 'photoswipe-html' ); ?>  

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'template-parts/content', 'page' ); ?>

                    <?php endwhile; // End of the loop. ?> 

            </article><!-- #post-## -->        

	
    </div><!-- #primary -->



<?php get_footer(); ?>
