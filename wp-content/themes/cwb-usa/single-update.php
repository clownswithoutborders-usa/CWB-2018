<?php
/**
 * The Template for displaying single Project Updates
 *
 * @package Clowns
 */

get_header(); 
$postID = get_the_id();
?>

<div class="medium-3 large-2 columns graynav">

     <?php wp_nav_menu( array( 'theme_location' => 'projects', 'menu_id' => 'secondary-menu' ) ); ?>

</div>
 
<div class="medium-3 large-2 columns ochrenav menu">
				<?php while ( have_posts() ) : the_post(); ?>
		
<?php 
 // this maybe could be improved; do we need a foreach? there's a limit of one project in the relationship field which_project
$posts = get_field('which_project');
 
$project = findProjectByPostID($posts[0]->ID);   
if ($project->countries) {      
	echo '<div class="menu">Country: ';
	echo '<ul>';
	foreach ($project->countries as $project_country) {
		echo '<li><a href="' . $project_country->permalink .'">' .  $project_country->title . '</a></li>';
	}
	echo '</ul>';
}
	     
echo 'Project: ';
echo '<a href="' . $project->permalink .'">' .  $project->title . '</a>';
	

		/*
		*  Query posts for a relationship value.
		*  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
		*/
 
		$updates = get_posts(array(
			'post_type' => 'update',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'which_project', // name of custom field
					'value' => '"' . $posts[0]->ID . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
					'compare' => 'LIKE'
				)
			)
		));
 
		?>
		<?php if( $updates ): ?>
	<p style="margin:10px 0; line-height: 1;">All blog posts for this project:</p>
	<ul class="update-list" style="margin:0; list-style: none; line-height: 1;">
			<?php foreach( $updates as $update ):?>
				<li style="padding: .7rem 0;" <?php echo ($update->ID == $postID? ' class="current"' : ''); ?>>				
					<a href="<?php echo get_permalink( $update->ID ); ?>" ><?php echo get_the_title( $update->ID ); ?>					
					</a>
					<?php if(get_field('project_update_author', $update->ID)) { ?>
                     <span class="byline">By <?php the_field('project_update_author', $update->ID); ?>
                    <?php } ?><br />
                    <?php $date = DateTime::createFromFormat('Ymd', get_field('project_update_date', $update->ID) );
            echo $date->format('F d, Y'); ?></span>
				</li>
				
			<?php endforeach; ?>
			</ul><!--updates-->
			
	<?php else:
    //echo '<p class="intro">' . 'We apologize, but we cannot find the list of updates at the moment.' . '</p>';

		endif; ?></div>



<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
</div>




<?php $image = get_field('hero_image');
                $size = 'hero'; // 1600 x 550

                if( $image ) { ?>
            <div class="hero-not-page medium-8 columns" style="padding:0;">
                    <div class="hero">
                        <?php  echo wp_get_attachment_image( $image, $size ); ?>
                    </div>
        	

            <div id="primary" class="medium-12 columns">
                        <?php } 
            elseif (has_post_thumbnail()) { ?>  
            <div class="hero-not-page medium-8 columns" style="padding:0;">
                    <div class="hero">
                        <?php  echo the_post_thumbnail( 'hero' ); ?>
                    </div>
         

            <div id="primary" class="medium-12 columns">

            <?php } 
            else { ?>  
            
            <div id="primary" class="medium-8 columns">
            <?php } ?>


				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom: 27px;">
					
					<header class="entry-header" style="margin-bottom: 24px;">
				
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<div class="entry-meta" style="font-weight: 500;">
				
							<p>Posted on: <span><?php $date = DateTime::createFromFormat('Ymd', get_field('project_update_date'));
								echo $date->format('F d, Y'); ?></span>
					
							<?php if(get_field('project_update_author')) { ?>
								
								by <span><?php echo get_field('project_update_author'); ?></span> 
							
							<?php }  ?>	

						<?php 
							// this maybe could be improved; do we need a foreach? there's a limit of one project in the relationship field which_project
							
							$posts = get_field('which_project');					
							
							if( $posts ): ?>
							 | Project: 
							
							<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
							
							<?php setup_postdata($post); ?>
							
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							
							<?php endforeach; ?>				
						
							<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
						
							<?php endif; ?>	</p>
						
							
						</div>

					</header><!-- .entry-header -->

			<div class="entry-content">

			<?php get_template_part( 'template-parts/content', 'flexible-content' ); ?>     

            <?php get_template_part( 'template-parts/content', 'photoswipe-html' ); ?>  
				
				<?php the_content(); 
				
				the_post_navigation( array(
	            'prev_text'                  => __( 'Previous Post: %title' ),
	            'next_text'                  => __( 'Next Post: %title' ),
	            'screen_reader_text' => __( 'Continue Reading' ),
        	) ); ?>


			<footer class="entry-meta">		

				<?php edit_post_link( __( 'Edit', 'clowns' ), '<span class="edit-link">', '</span>' ); ?>
			
			</footer><!-- .entry-meta -->

		</article><!-- #post-## -->
			<div class="wpfai">Share this: <?php if(function_exists('wpfai_social')) { echo wpfai_social(); } ?></div>
				<?php endwhile; ?>



</div><!-- #content -->		
	
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