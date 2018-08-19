<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CWB-USA 
 */

get_header();

 ?>

<style>
#resultsWrapper ul {
	margin: 1.5em 0px 1.5em 0px;
}
#resultsWrapper ul li {
	list-style: none;
	margin: .5em 0px 1.5em;
}
select, input#search {
	width: auto;
}

.loading {
	background-color: white;
	width: 100%;
	height: 100%;
	display: none;
	position: absolute;
}
#filters {
	display: flex;
	flex-flow: row wrap;
	justify-content: center;
	margin-top: .7em;
}
.filterWrapper {
	padding: .7em 1% 0px;
	display: flex;
	flex-flow: row nowrap;
}
.or {
	padding: .5em 5% 0px 0px;
}

.buttons {
	clear: both;
	text-align: center;
}
#message {
	font-size: 1.2em;
	margin-top: .7em;
}

</style>

<div class="medium-3 large-2 columns graynav">

     <?php wp_nav_menu( array( 'theme_location' => 'projects', 'menu_id' => 'secondary-menu' ) ); ?>

</div>

	<div id="primary" class="medium-9 large-10 columns">

	<div class="mapwrapper" style="margin: 0 -.9375rem;">				

		<?php 
		$map_projects = new WP_Query( array(
		   'post_type' => 'project', 
		   'posts_per_page' => -1
		));

		if( $map_projects->have_posts()) { ?>

			<div id="cwb-map" class="acf-map"></div>

		<?php }	 
			// Restore original Post Data
			wp_reset_postdata(); ?>
			
			
	 </div>
	<div id="filters">
		<div id="yearWrapper" class="filterWrapper">
		<select id="yearFilter"><option value="all">View By Year</option></select>
		</div>
		<div id="countryWrapper" class="filterWrapper">
		<div class="or">OR</div>
		<select id="countryFilter"><option value="all">View By Country</option></select>
		</div>
		<?php
		/*<select id="countFilter">
			<option value="all" selected>Display All</option>
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="50">50</option>
		</select>
		*/
		?>
		<div id="searchWrapper" class="filterWrapper">
		<div class="or">OR</div>
		<input type="text" id="search" placeholder="Search by keyword">
		</div>
	</div>

	<div class="buttons">
		<button id="go">Go</button>
	</div>
	
	<div id="resultsWrapper">
		<div class="loading">&nbsp;</div>
		<div id="message"></div>
		<ul id="project-container"></ul> <!-- #project-container - search results appear here -->
	</div>

		</div> <!-- #primary -->


<?php #get_sidebar(); ?>
<?php get_footer(); ?>