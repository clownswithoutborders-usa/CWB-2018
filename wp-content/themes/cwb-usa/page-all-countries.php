<?php
/**
 * Template Name: Countries Map Page
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CWB-USA
 */
get_header(); ?>
<style>
th.projectCount, th.peopleServed {
	text-align: center;
}
td.projectCount, td.peopleServed,
tfoot th.projectCount, tfoot th.peopleServed {
	text-align: right;
}
.countryWindow {
	padding-top: 1em;
}
.countryWindow a{
	display: flex;
	flex-flow: row nowrap;
}
img.flag_image{
	margin-right: 12px;
	border: 1px solid #efefef;/* because Japan and Nepal are white flags on a white bg - TY -SL */
}
</style>
<div class="medium-3 large-2 columns graynav">

     <?php wp_nav_menu( array( 'theme_location' => 'projects', 'menu_id' => 'secondary-menu' ) ); ?>

</div>

	<div id="primary" class="medium-9 large-10 columns">

	<div class="mapwrapper" style="margin: 0 -.9375rem;">	
		<div id="country-map" class="acf-map"></div>
    </div>
    <?php  // this is just temp, for working out IA 
    
    echo '<table id="countriesList">';
    echo '<thead>';
    echo '<tr><th class="country">Country</th><th class="projectCount">Projects</th><th class="peopleServed">People Served</th></tr>';
    echo '</thead>';
    echo '<tbody>';
    $countries = get_countries();#custom function, so the variables aren't WP variables
    $projectCount = $peopleServed = 0;
    foreach ($countries as $country) {
    	echo '<tr>';
    	echo '<td class="country">';
    	echo '<a href="' . $country->permalink . '">';
    	if ($country->flag_image) {
    		echo '<img class="flag_image" src="' . $country->flag_image->src . '" alt="' . $country->title . ' flag" style="height: ' . $country->flag_image->h . 'px; width: ' . $country->flag_image->w . 'px;">';
    	}
    	echo $country->title;
    	echo '</a>';
    	echo '</td>';
    	echo '<td class="projectCount">' . number_format($country->projectCount) . '</td>';
    	echo '<td class="peopleServed">' . number_format($country->peopleServed) . '</td>';
    	echo '</tr>';
    	$projectCount += $country->projectCount;
    	$peopleServed += $country->peopleServed;
    }
    echo '<tfoot>';
    echo '<tr>';
	echo '<th>TOTALS</th>';
	echo '<th class="projectCount">' . number_format($projectCount) . '</th>';
	echo '<th class="peopleServed">' . number_format($peopleServed) . '</th>';
	echo '</tr>';
    echo '</tfoot>';
    echo '</tbody>';
    echo '</table>';
    
?>


	</div><!-- #primary -->

<?php get_footer(); ?>
