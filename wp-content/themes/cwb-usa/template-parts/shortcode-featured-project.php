	

	<?php $featureds = get_field('choose_a_project_to_feature', 'option');
		if ($featureds): ?>
		<?php foreach( $featureds as $featured): 
		setup_postdata($featured); ?>

	<div class="teamsection row">
		

			<div class="team-member">

			<div class="team-member-name">
				<a href="<?php the_permalink($featured->ID); ?>"><h4><?php echo get_the_title($featured->ID); ?></h4></a>

				</div>	

				<?php $image = get_field('hero_image', $featured->ID);
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
					
					<?php echo get_the_excerpt($featured->ID); ?>
					<!-- <a href="<?php the_permalink($featured->ID); ?>">Read More</a> -->
				</div> 

			</div><!-- .team-member -->

		<?php endforeach; ?>

		</div><!-- .teamsection  -->

	<?php endif;
	// Restore original Post Data

	wp_reset_postdata(); ?>