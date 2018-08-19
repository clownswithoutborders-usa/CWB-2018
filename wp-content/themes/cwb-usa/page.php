<?php
/**
 * Template Name: Default Template (content/sidebar)
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CWB-USA
 */

get_header(); ?>

<div id="content-sidebar-wrapper">

    <div id="primary" class="medium-9 columns">



        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->


    <?php get_template_part( 'template-parts/content', 'flexible-content' ); ?>     

    <?php get_template_part( 'template-parts/content', 'photoswipe-html' ); ?>  

    <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'template-parts/content', 'page' ); ?>

            <?php endwhile; // End of the loop. ?> 


	</div><!-- #primary -->

<?php get_sidebar( 'pages' ); ?> 

</div>   



<?php get_footer( 'fullwidth'); ?>
