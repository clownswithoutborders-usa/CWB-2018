<?php get_header(); ?>


<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/project_map.js"></script>

<div class="medium-3 large-2 columns graynav">

     <?php wp_nav_menu( array( 'theme_location' => 'projects', 'menu_id' => 'secondary-menu' ) ); ?>

</div>

	<div id="primary" class="medium-9 columns">

	        <main id="main" class="site-main" role="main">
<?php 
$term = get_queried_object()->slug;
$args = array(
	'post_type' => 'project', 
   'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'project-year',
			'field'    => 'slug',
			'terms'    => $term,
		),
	),
);
$map_projects = new WP_Query( $args );


if( $map_projects->have_posts()) { ?>
<div class="mapwrapper" style="margin: 0 -.9375rem;">

	<div class="acf-map">
	<?php while ( $map_projects->have_posts() ) {
		$map_projects->the_post();
	
	  $location = get_field('project_location',$map_project->ID); ?>
	
		
     	<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
			<h4><?php the_title(); ?></h4>
				<p><?php the_terms( $map_project->ID, 'project-year'); ?></p>
				<?php the_excerpt(); ?>
     	</div>
    
<?php } ?>
 </div>
</div>
<?php }	 
	// Restore original Post Data
	wp_reset_postdata(); ?>

<h1 style="font-size: 40px;padding-top: 20px;">All projects in <?php echo get_queried_object()->slug; ?></h1>
		<?php

			if ( have_posts() ) :

				while ( have_posts() ) : the_post(); ?>
			<div class="project-container">

			


<div class="project">
<?php if ( has_post_thumbnail() ) { ?>
	<div class="feat-img"><?php the_post_thumbnail('thumbnail'); ?></div>
<?php } 
	elseif ( get_field ( 'hero_image' )) {
		$image_object = get_field('hero_image');

	//if( $image_object) {

	?>
	<div class="feat-img">
		<img src="<?php echo $image_object['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
	</div>
<?php } else {
	// forget it
	}
?>

	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="entry-meta">
					<?php if(get_field('project_start_date')) { ?>
					<p><span><?php $date = DateTime::createFromFormat('Ymd', get_field( 'project_start_date' ));
						echo $date->format('F d, Y'); ?></span> 
						<?php } ?>
					<?php if(get_field('project_end_date')) { ?>
					&mdash; <span><?php $date = DateTime::createFromFormat('Ymd', get_field( 'project_end_date' ));
						echo $date->format('F d, Y'); ?></span>  
						<?php } ?>
						
						</p>
					</div>
	
		<div class="entry-content">
			<?php the_excerpt();  ?>
		
		</div>
</div>	

	
</div> <!-- #project-container -->

<?php endwhile; ?>
 <?php	else :

					get_template_part( 'includes/no-results', 'index' );

				endif;

			?>

		</div> <!-- #content-area -->
	</div> <!-- .container -->

</div> <!-- #main-content -->



<?php get_footer(); ?>