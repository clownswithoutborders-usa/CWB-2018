<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Collage Creative Gallery 2016
 */

get_header(); ?>



<?php if(get_field('use_a_static_image_or_a_video') == "image") { ?>

    <div class="hero" style="background-image:url('<?php the_field('hero_image'); ?>');">
        <div class="overlay">
            <h1><?php the_field('heading_text'); ?></h1>
            <p><?php the_field('home_hero_tagline'); ?></p>
            <a class="buttonlink white" href="<?php the_field('cta_button_link'); ?>"><?php the_field('button_text_copy'); ?></a>
        </div>
    </div>

<?php }
elseif (get_field('use_a_static_image_or_a_video') == "video") { ?>
<div class="video-container" style="background:url('<?php the_field('video_fallback_image'); ?>') no-repeat right top;">

    <video autoplay muted loop poster="<?php the_field('video_fallback_image'); ?>" id="bgvid" style="background:url('<?php the_field('video_fallback_image'); ?>');width:100%;">
        <source src="<?php the_field('video'); ?>" type="video/mp4">
    </video>
    <div class="overlay-container">
    <div class="video-overlay">
            <h1><?php the_field('heading_text'); ?></h1>
            <p><?php the_field('home_hero_tagline'); ?></p>
            <a class="buttonlink white" href="<?php the_field('cta_button_link'); ?>"><?php the_field('button_text_copy'); ?></a>
        </div>
    </div>
</div>
<?php } ?>
    <div id="home-main" class="row">


    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        

                <?php get_template_part( 'template-parts/content', 'flexible-content' ); ?>      

                <?php get_template_part( 'template-parts/content', 'photoswipe-html' ); ?>  

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'template-parts/content', 'page' ); ?>

            <?php endwhile; // End of the loop. ?> 


    </div><!-- #primary -->




<?php get_footer( 'fullwidth'); ?>
