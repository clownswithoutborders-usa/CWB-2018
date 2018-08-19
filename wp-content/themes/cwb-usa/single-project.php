<?php
/**
 * 
 *
 *
 * @package CWB-USA  
 */

get_header(); ?>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/project_map.js"></script>
<div id="wrap" class="row expanded">
<div class="medium-3 large-2 columns graynav">

     <?php wp_nav_menu( array( 'theme_location' => 'projects', 'menu_id' => 'secondary-menu' ) ); ?>

</div>

<div class="medium-3 large-2 columns ochrenav"> 

<?php while ( have_posts() ) : the_post(); ?>

            <?php 
        		
     		$project = findProjectByPostID(get_the_id());   
     		if ($project->countries) {      
     			echo '<div class="innerochre">About';
     			echo '<ul>';
	            foreach ($project->countries as $project_country) {
					echo '<li><a href="' . $project_country->permalink .'">' .  $project_country->title . '</a></li>';
    	        }
     			echo '</ul></div>';
			}
    		wp_reset_postdata(); 
    		
            $updates = get_posts(array(
                    'post_type' => 'update',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'which_project', // name of custom field
                            'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                            'compare' => 'LIKE'
                        )
                    )
                ));
         
                ?>
            <?php if( $updates ): ?>
                <p class="entry-title">Project Blog Posts:</p>
                <ul>
                    <?php foreach( $updates as $update ): ?>
                        <li><a href="<?php echo get_permalink( $update->ID ); ?>">
                            <?php echo get_the_title( $update->ID ); ?></a><br />
                            <span class="byline"><?php if(get_field('project_update_author', $update->ID)) { ?>
                            By <?php the_field('project_update_author', $update->ID); ?><br />
                            <?php } ?>
                            <?php $date = DateTime::createFromFormat('Ymd', get_field('project_update_date', $update->ID) );
            echo $date->format('F d, Y'); ?></span>
                        </li> 
                    <?php endforeach; ?>
            </ul>    
        <?php else:
            echo '<p class="intro">' . 'No blog for this project.' . '</p>';

                endif; ?></div>
 <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>




<?php $image = get_field('hero_image');
                $size = 'hero'; // 1600 x 550

                if( $image ) { ?>
            <div class="hero-not-page medium-8 columns" style="padding:0;">
                    <div class="hero">
                        <?php  echo wp_get_attachment_image( $image, $size ); ?>
                    </div>
        

            <div id="primary" class="medium-9 columns">
                        <?php } 
            elseif (has_post_thumbnail()) { ?>  
            <div class="hero-not-page medium-8 columns" style="padding:0;">
                    <div class="hero">
                        <?php  echo the_post_thumbnail( 'hero' ); ?>
                    </div>
         

            <div id="primary" class="medium-9 columns">

            <?php } 
            else { ?>  
            
            <div id="primary" class="medium-6 columns">
            <?php } ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

        <div class="entry-meta" style="margin-bottom: 24px; font-weight: 500;">
        <?php if(get_field('project_start_date')) { ?>
        <p>Start Date: <span><?php $date = DateTime::createFromFormat('Ymd', get_field( 'project_start_date' ));
            echo $date->format('F d, Y'); ?></span> | 
            <?php } ?>
        <?php if(get_field('project_end_date')) { ?>
        End Date: <span><?php $date = DateTime::createFromFormat('Ymd', get_field( 'project_end_date' ));
            echo $date->format('F d, Y'); ?></span>
            <?php } ?>
            <?php if(get_field('project_author')) { ?>
         | Posted by <span><?php the_field( 'project_author' ); ?> 
            <?php } ?>
            
            </p>
        </div>
       
                      
                    </header><!-- .entry-header -->

                    <div class="entry-content">

                       <?php get_template_part( 'template-parts/content', 'flexible-content' ); ?>     

                        <?php get_template_part( 'template-parts/content', 'photoswipe-html' ); ?>  
                        
                        <?php the_content(); ?>
                        
                    </div><!-- .entry-content -->
                    
                </article><!-- #post-## -->
			

			<?php endwhile; // end of the loop. ?>



    <div id="where" class="project-map">
        <?php 
         
        $location = get_field('project_location');
         
        if( !empty($location) ):
        ?>
        <div class="acf-map" style="width: 100%; height: 320px;">
            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
        </div>
        <?php endif; ?> 
        </div><!--where-->
        <div class="wpfai">Share this: <?php if(function_exists('wpfai_social')) { echo wpfai_social(); } ?></div>

        <?php the_post_navigation( array(
                'prev_text'                  => __( 'Previous Project: %title' ),
                'next_text'                  => __( 'Next Project: %title' ),
                'screen_reader_text' => __( 'Continue Reading' ),
            ) ); ?>
		
</div><!-- #primary -->
<?php if($image) { ?>
        <div id="sidebar" class="columns medium-3">
    <?php }
    elseif (has_post_thumbnail()) { ?>
        <div id="sidebar" class="columns medium-3">
    <?php }
    else { ?>
        <div id="sidebar" class="columns medium-2">
  <?php  } ?>


<?php if ( is_singular('project') ) { ?>
        <div id="top-o-column" class="widget" style="margin-top: 26px; text-align:center;">
        <h3 class="widget-title">At A Glance</h3>
        <div class="stats">
        <?php if (get_field('number_shows')) { echo '<div class="stat">Shows:<br /><span class="number">' . get_field('number_shows') . '</span>' . '</div>'; }?>
        <?php if (get_field('number_workshops')) { echo '<div class="stat">Workshops:<br /><span class="number">' . get_field('number_workshops') . '</span>' . '</div>'; }?> 
        <?php if (get_field('number_clowns')) { echo '<div class="stat">Clowns:<br /><span class="number">' . get_field('number_clowns') . '</span>' . '</div>'; }?>
        <?php if (get_field('number_people')) { echo '<div class="stat">People Served:<br /><span class="number">' . get_field('number_people') . '</span>' . '</div>'; }?>

        <?php if (get_field('project_partners')) { echo '<div class="stat">Project Partner(s):<br /><span class="partners">' . get_field('project_partners') . '</span></div>'; }?>
        </div>
        </div>
            <?php } ?>

</div><!-- #sidebar --> 
<?php if($image) { ?>
        </div><!--.hero-not-page-->
    <?php }
    elseif (has_post_thumbnail()) { ?>
        </div><!--.hero-not-page-->
    <?php }
    else { ?>
        
  <?php  } ?>
</div><!-- #wrap -->
<?php get_footer(); ?>
