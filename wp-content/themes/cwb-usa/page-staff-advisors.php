<?php
/**
 * Template Name: Staff & Advisors Page
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
    <h1>CWB Staff</h1> 

<?php 

 $args = array( 
  //'orderby' => 'date',
  //'order' => 'ASC',
  'post_type' => 'member',
  'posts_per_page' => -1,
  'tax_query' => array(
        array(
            'taxonomy' => 'role',
            'term_taxonomy_id' => 'term_id',
            'terms' => '94',
        ),
    ),
 );
 $the_query = new WP_Query( $args );

 ?>

     <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="member">
           <?php if ( has_post_thumbnail() ) { ?>
             <div class="feat-img row large-5">
                <?php echo the_post_thumbnail('projectfeature'); ?>
            </div>
             <?php } ?>
             <h2 style="clear:none;"><?php the_title() ;?></h2>

             <div class="main-summary"><?php the_content() ?></div>
         </div>

     <?php endwhile; 
     else: ?> 
     <p>Sorry, there are no staff members to display.</p> 
    <?php endif; ?>
<?php wp_reset_query(); ?>

<h1>Advisors</h1>


<?php 

 $args = array( 
  //'orderby' => 'date',
  //'order' => 'ASC',
  'post_type' => 'member',
  'posts_per_page' => -1,
  'tax_query' => array(
        array(
            'taxonomy' => 'role', 
            'term_taxonomy_id' => 'term_id',
            'terms' => '222',
        ),
    ),
 );
 $the_query = new WP_Query( $args );

 ?>

     <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="member">
             <div class="feat-img row large-5">
                <?php echo the_post_thumbnail('projectfeature'); ?>
            </div>
             <h2 style="clear:none;"><?php the_title() ;?></h2>

             <div class="main-summary"><?php the_content() ?></div>
         </div>

     <?php endwhile; 
     else: ?> 
     <p>Sorry, there are no advisors to display.</p> 
    <?php endif; ?>
<?php wp_reset_query(); ?>
	</div><!-- #primary -->

<?php get_sidebar( 'pages' ); ?> 

</div>   



<?php get_footer( 'fullwidth'); ?>
