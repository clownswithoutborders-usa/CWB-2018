<?php
/**
 * The sidebar containing the main widget area for pages using default template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CWB-USA
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area medium-3 columns" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>

		<section id="stats_sidebar" class="widget">
			<h3 class="widget-title"><?php the_field('widget_title','option'); ?></h3>
			<?php if(have_rows('stats_modules','option')):
			    while ( have_rows('stats_modules','option') ) : the_row(); ?>

        <h4 class="year"><?php the_sub_field('year'); ?></h4>
        <div class="stat-number-wrap">
	        <div class="stat-number"><h4><?php the_sub_field('number_of_projects'); ?></h4><span>Projects</span></div>
	        <div class="stat-number"><h4><?php the_sub_field('number_of_people_served'); ?></h4><span>People Served</span></div>
        </div>
		 <?php endwhile;

		else :

		    // no rows found

		endif;

		?></section>

	<?php $posts = get_field('choose_a_project_to_feature', 'option');
		if ($posts): ?>
		<?php foreach( $posts as $post): 
		setup_postdata($post); ?>
		<section id="featured_project" class="widget">
			<h3 class="widget-title">Featured Project:<br /><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php $image = get_field('hero_image');
                $size = 'medium'; // 300 x 300 
               if( $image ) { ?>
               <div class="widgetimg"><?php  echo wp_get_attachment_image( $image, $size ); ?></div>
           		<?php }
               elseif (has_post_thumbnail()) { ?>  
               <div class="widgetimg"><?php  echo the_post_thumbnail( 'medium' ); ?></div>
               <?php }
                ?>

			<div class="textwidget"><?php the_excerpt(); ?><a href="<?php the_permalink(); ?>"> Read More &raquo;</a></div>
		</section>
	<?php endforeach; ?>
	</section>
	<?php wp_reset_postdata(); ?>

	<?php endif;  ?>


</aside><!-- #secondary -->
