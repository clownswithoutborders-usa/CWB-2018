<?php
/**
 * The template for displaying Members Archive.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Clowns
 */

get_header(); ?>
<div id="content-sidebar-wrapper">
	<div id="primary" class="medium-9 columns">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">				
					
					<h1>Board and Staff</h1>
				to-do: put these in order, sections for board/staff; performers on their own page?
			</header><!-- .page-header -->

			<?php /* Start the Loop */ 
			while ( have_posts() ) : the_post(); ?>
				<div class="projects">
					<h2 class="entry-title">
					<?php the_title(); ?></h2>
					<div class="feat-img"><?php the_post_thumbnail('thumbnail'); ?></div>
					<div class="entry-content">
						<?php the_content(); ?>
					
					</div>
				</div>	
					<?php endwhile;
				
				?>

			

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar('pages'); ?>
</div>
<?php get_footer(); ?>
