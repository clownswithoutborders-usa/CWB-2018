<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CWB-USA
 */

get_header();
$country = findCountryByPostID(get_the_id());

?>

<div class="medium-3 large-2 columns graynav">

     <?php wp_nav_menu( array( 'theme_location' => 'projects', 'menu_id' => 'secondary-menu' ) ); ?>

</div>



<div class="medium-3 large-2 columns ochrenav">

        
<?php while ( have_posts() ) : the_post(); ?>

<div id="updates" class="clear">

        <?php 
 
    // to do: this list should be in order of project_start_date

        $x = 1;
        /*
        $projects = get_posts(array(
            'post_type' => 'project',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'select_country_page', // name of custom field
                    'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                    'compare' => 'LIKE'
                )
            )
        ));*/
        $projects = $country->projects;

        if( $projects ): ?>
   <div class="menu"><p>Projects In This Country:</p>
    <ul>
            <?php foreach( $projects as $project ): ?>
   
                    <li><a href="<?php echo get_the_permalink( $project->ID ); ?>"><?php echo get_the_title( $project->ID ); ?></a></li>
                    

            <?php endforeach; ?>
    </ul>
    <?php else:
    echo '<p class="intro">' . 'No projects here yet.' . '</p>';
    wp_reset_postdata(); 
    
        endif; ?>
        </div>
</div><!--updates-->

</div>

  <div id="primary" class="medium-6 large-8 columns">
  
<?php $image = get_field('hero_image');
                $size = 'hero'; // 1600 x 550

                if( $image ) { ?>
            <div class="hero-not-page" style="margin: 0 -.9375rem;">
                    <div class="hero">
                        <?php  echo wp_get_attachment_image( $image, $size ); ?>
                    </div>
            </div> 
            <?php } ?>  
            <div class="column medium-9">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                      
                    </header><!-- .entry-header -->

                    <div class="entry-content">

                    <?php get_template_part( 'template-parts/content', 'flexible-content' ); ?>     

                        <?php get_template_part( 'template-parts/content', 'photoswipe-html' ); ?>  
                        
                        <?php the_content(); ?>
                        
                    </div><!-- .entry-content -->
                    
                </article><!-- #post-## -->
            </div>
           
            <div class="column medium-3 widget" style="margin-top: 26px;">
                    <h3 class="widget-title">Our Work Here</h3>
                    <p style="text-align:center;">Year Started:<br /><?php the_field('year_started'); ?>
                    <p style="text-align:center;">Number of projects:<br /> <?php echo $country->projectCount; ?></p>
                    <p style="text-align:center;">Number of people served:<br /> <?php echo ($country->peopleServed > 0? number_format($country->peopleServed) : 'TBD'); ?></p>
                    <?php if (get_field('explanation_of_historic_projects')) { ?>
                        <p><?php the_field('explanation_of_historic_projects'); ?></p>
                    <?php } ?>
                <?php  $posts = get_field('featured_partner_orgs'); ?>    
                <?php if( $posts ): ?>
                <p style="text-align:center;margin-bottom:.5rem;">Featured Partners:</p>
                <ul style="text-align:center;margin:0;list-style:none;">
            <?php foreach( $posts as $post ): ?>
            <?php setup_postdata($post); ?>
            <?php if (get_field('partner_orgs_website')) { ?>
                    <li><a href="<?php the_field( 'partner_orgs_website' ); ?>" target="_blank"><?php the_title(); ?></a></li>
            <?php } 
            else { ?>
                <li><?php the_title(); ?></li>
            <?php } ?>
                    
                
            <?php endforeach; ?>
            </ul>
            <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            </div>

	</div><!-- #primary -->
<?php endwhile; ?>

<?php
//get_sidebar();
get_footer();
