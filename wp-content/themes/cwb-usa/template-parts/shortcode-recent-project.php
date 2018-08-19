<?php 

	// for inclusion in shortcode [recent-project]
	//WP Query args.
	$args = array (
		'post_type'      => 'project', 
		'posts_per_page' => '1',
		
	);
	// The Query
	$member = new WP_Query( $args );
	// Loop
	if ( $member->have_posts() ) { ?>

	<div class="teamsection row">
		
		<?php while ( $member->have_posts() ) {
			$member->the_post(); ?>
			<div class="team-member">

			<div class="team-member-name">
				<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>

				</div>	

				<?php $image = get_field('hero_image');
                $size = 'medium'; // 300 x 300 
               if( $image ) { ?>
               <div class="member-photo"><?php  echo wp_get_attachment_image( $image, $size ); ?></div>
           		<?php }
               elseif (has_post_thumbnail()) { ?>  
               <div class="member-photo"><?php  echo the_post_thumbnail( 'medium' ); ?></div>
               <?php } else { ?>
						<div class="member-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/placeholder.png" /></div>
					<?php }
				?>
				<div class="team-member-info">
					
					<?php echo get_the_excerpt(); ?>
					<!-- <a href="<?php the_permalink(); ?>">Read More</a> -->
				</div> 

			</div><!-- .team-member -->

		<?php } ?> </div><!-- .teamsection  -->

	<?php } else { 
	echo ("no posts yet!");
	}			
	// Restore original Post Data
	wp_reset_postdata(); 