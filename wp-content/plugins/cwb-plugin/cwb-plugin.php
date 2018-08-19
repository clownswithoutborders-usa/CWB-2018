<?php
/*
Plugin Name: Site Plugin for CWB
Description: Site specific custom code for clownswithoutborders.org. If you deactivate this, most of the site will break. This plugin creates Projects, Project Updates, Members, Yearbooks, and all related taxonomies.
Author: Susan Langenes 
Author URI: http://collagecreative.net
*/



add_action( 'init', 'clowns_add_new_image_size' );
function clowns_add_new_image_size() {
    add_image_size( 'hero', 1600, 540, true ); //for project cpt
}


//over-wrote single-project.php in Divi theme

// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                => _x( 'Projects', 'Post Type General Name', 'cwb_plugin' ),
		'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'cwb_plugin' ),
		'menu_name'           => __( 'Projects', 'cwb_plugin' ),
		'parent_item_colon'   => __( '', 'cwb_plugin' ),
		'all_items'           => __( 'All Projects', 'cwb_plugin' ),
		'view_item'           => __( 'View Project', 'cwb_plugin' ),
		'add_new_item'        => __( 'Add New Project', 'cwb_plugin' ),
		'add_new'             => __( 'Add New', 'cwb_plugin' ),
		'edit_item'           => __( 'Edit Project', 'cwb_plugin' ),
		'update_item'         => __( 'Update Project', 'cwb_plugin' ),
		'search_items'        => __( 'Search Projects', 'cwb_plugin' ),
		'not_found'           => __( 'No Projects found', 'cwb_plugin' ),
		'not_found_in_trash'  => __( 'No Projects found in Trash', 'cwb_plugin' ),
	);
	$rewrite = array(
		'slug'                => 'projects',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'project', 'cwb_plugin' ),
		'description'         => __( 'CWB\'s Projects throughout the world.  Includes the ability to post updates.', 'cwb_plugin' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
		'taxonomies'          => array( 'location', 'project-year' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-admin-site',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'			  => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'project', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );

// Register Custom Post Type
function update_post_type() {

	$labels = array(
		'name'                => _x( 'Project Blog Posts', 'Post Type General Name', 'cwb_plugin' ),
		'singular_name'       => _x( 'Project Blog Post', 'Post Type Singular Name', 'cwb_plugin' ),
		'menu_name'           => __( 'Project Blog Posts', 'cwb_plugin' ),
		'parent_item_colon'   => __( 'Parent Project Blog Post:', 'cwb_plugin' ),
		'all_items'           => __( 'All Project Blog Posts', 'cwb_plugin' ),
		'view_item'           => __( 'View Project Blog Post', 'cwb_plugin' ),
		'add_new_item'        => __( 'Add New Project Blog Post', 'cwb_plugin' ),
		'add_new'             => __( 'Add New', 'cwb_plugin' ),
		'edit_item'           => __( 'Edit Project Blog Post', 'cwb_plugin' ),
		'update_item'         => __( 'Update Project Blog Post', 'cwb_plugin' ),
		'search_items'        => __( 'Search Project Blog Post', 'cwb_plugin' ),
		'not_found'           => __( 'Not found', 'cwb_plugin' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'cwb_plugin' ),
	);
	$args = array(
		'label'               => __( 'update', 'cwb_plugin' ),
		'description'         => __( 'Update Description', 'cwb_plugin' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-book-alt',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'update', $args );

}

// Hook into the 'init' action
add_action( 'init', 'update_post_type', 0 );



// Register Custom Post Type
function member_post_type() {

	$labels = array(
		'name'                => _x( 'Members', 'Post Type General Name', 'cwb_plugin' ),
		'singular_name'       => _x( 'Member', 'Post Type Singular Name', 'cwb_plugin' ),
		'menu_name'           => __( 'Members', 'cwb_plugin' ),
		'all_items'           => __( 'All Members', 'cwb_plugin' ),
		'view_item'           => __( 'View Member', 'cwb_plugin' ),
		'add_new_item'        => __( 'Add New Member', 'cwb_plugin' ),
		'add_new'             => __( 'Add New', 'cwb_plugin' ),
		'edit_item'           => __( 'Edit Member', 'cwb_plugin' ),
		'update_item'         => __( 'Update Member', 'cwb_plugin' ),
		'search_items'        => __( 'Search Members', 'cwb_plugin' ),
		'not_found'           => __( 'No members found', 'cwb_plugin' ),
		'not_found_in_trash'  => __( 'No members found in Trash', 'cwb_plugin' ),
	);
	
	$args = array(
		'label'               => __( 'member', 'cwb_plugin' ),
		'description'         => __( 'CWB board and staff members', 'cwb_plugin' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-admin-users',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,		
		'capability_type'     => 'page',
	);
	register_post_type( 'member', $args );

}

// Hook into the 'init' action
add_action( 'init', 'member_post_type', 0 );

// Register Custom Post Type
function yearbook_post_type() {
	
	$labels = array(
	'name'                => _x( 'Yearbooks', 'Post Type General Name', 'cwb_plugin' ),
	'singular_name'       => _x( 'Yearbook', 'Post Type Singular Name', 'cwb_plugin' ),
	'menu_name'           => __( 'Yearbooks', 'cwb_plugin' ),
	'all_items'           => __( 'All Yearbooks', 'cwb_plugin' ),
	'view_item'           => __( 'View Yearbook', 'cwb_plugin' ),
	'add_new_item'        => __( 'Add New Yearbook', 'cwb_plugin' ),
	'add_new'             => __( 'Add New Yearbook', 'cwb_plugin' ),
	'edit_item'           => __( 'Edit Yearbook', 'cwb_plugin' ),
	'update_item'         => __( 'Update Yearbook', 'cwb_plugin' ),
	'search_items'        => __( 'Search Yearbook', 'cwb_plugin' ),
	'not_found'           => __( 'No Yearbooks found', 'cwb_plugin' ),
	'not_found_in_trash'  => __( 'No Yearbooks found in Trash', 'cwb_plugin' ),
	);
	$args = array(
	'label'               => __( 'yearbook', 'cwb_plugin' ),
	'description'         => __( 'Photo yearbooks for CWB', 'cwb_plugin' ),
	'labels'              => $labels,
	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'revisions', 'thumbnail' ),
	'hierarchical'        => false,
	'public'              => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_nav_menus'   => false,
	'show_in_admin_bar'   => true,
	'menu_position'       => 5,
	'menu-icon'			  => 'dashicons-images-alt2',
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'capability_type'     => 'page',
	);
	register_post_type( 'yearbook', $args );
	
}

// Hook into the 'init' action
add_action( 'init', 'yearbook_post_type', 0 );

// Register Custom Post Type "country"
function country_post_type() {
	
	$labels = array(
	'name'                => _x( 'Country Pages', 'Post Type General Name', 'cwb_plugin' ),
	'singular_name'       => _x( 'Country Page', 'Post Type Singular Name', 'cwb_plugin' ),
	'menu_name'           => __( 'Country Pages', 'cwb_plugin' ),
	'all_items'           => __( 'All Country Pages', 'cwb_plugin' ),
	'view_item'           => __( 'View Country Page', 'cwb_plugin' ),
	'add_new_item'        => __( 'Add New Country Page', 'cwb_plugin' ),
	'add_new'             => __( 'Add New Country Page', 'cwb_plugin' ),
	'edit_item'           => __( 'Edit Country Page', 'cwb_plugin' ),
	'update_item'         => __( 'Update Country Page', 'cwb_plugin' ),
	'search_items'        => __( 'Search Country Page', 'cwb_plugin' ),
	'not_found'           => __( 'No Country Pages found', 'cwb_plugin' ),
	'not_found_in_trash'  => __( 'No Country Pages found in Trash', 'cwb_plugin' ),
	);
	$args = array(
	'label'               => __( 'country', 'cwb_plugin' ),
	'description'         => __( 'Country pages', 'cwb_plugin' ),
	'labels'              => $labels,
	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'revisions', 'thumbnail' ),
	'hierarchical'        => false,
	'public'              => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_nav_menus'   => false,
	'show_in_admin_bar'   => true,
	'menu_position'       => 5,
	'menu-icon'			  => 'dashicons-images-alt2',
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'capability_type'     => 'page',
	);
	register_post_type( 'country', $args );
	
}

// Hook into the 'init' action
add_action( 'init', 'country_post_type', 0 );

// Register Custom Post Type "partner"
function partner_post_type() {
	
	$labels = array(
	'name'                => _x( 'Featured Partners', 'Post Type General Name', 'cwb_plugin' ),
	'singular_name'       => _x( 'Featured Partner', 'Post Type Singular Name', 'cwb_plugin' ),
	'menu_name'           => __( 'Featured Partners', 'cwb_plugin' ),
	'all_items'           => __( 'All Featured Partners', 'cwb_plugin' ),
	'view_item'           => __( 'View Featured Partner', 'cwb_plugin' ),
	'add_new_item'        => __( 'Add New Featured Partner', 'cwb_plugin' ),
	'add_new'             => __( 'Add New Featured Partner', 'cwb_plugin' ),
	'edit_item'           => __( 'Edit Featured Partner', 'cwb_plugin' ),
	'update_item'         => __( 'Update Featured Partner', 'cwb_plugin' ),
	'search_items'        => __( 'Search Featured Partner', 'cwb_plugin' ),
	'not_found'           => __( 'No Featured Partners found', 'cwb_plugin' ),
	'not_found_in_trash'  => __( 'No Featured Partners found in Trash', 'cwb_plugin' ),
	);
	$args = array(
	'label'               => __( 'partner', 'cwb_plugin' ),
	'description'         => __( 'Fetured Partner Organizations', 'cwb_plugin' ),
	'labels'              => $labels,
	'supports'            => array( 'title', 'editor', 'thumbnail' ),
	'hierarchical'        => false,
	'public'              => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_nav_menus'   => false,
	'show_in_admin_bar'   => true,
	'menu_position'       => 5,
	'menu-icon'			  => 'dashicons-groups',
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'capability_type'     => 'page',
	);
	register_post_type( 'partner', $args );
	
}

// Hook into the 'init' action
add_action( 'init', 'partner_post_type', 0 );

// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Locations', 'Taxonomy General Name', 'cwb_plugin' ),
		'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'cwb_plugin' ),
		'menu_name'                  => __( 'Locations', 'cwb_plugin' ),
		'all_items'                  => __( 'All Locations', 'cwb_plugin' ),
		'parent_item'                => __( 'Parent Location', 'cwb_plugin' ),
		'parent_item_colon'          => __( 'Parent Location:', 'cwb_plugin' ),
		'new_item_name'              => __( 'New Location', 'cwb_plugin' ),
		'add_new_item'               => __( 'Add New Location', 'cwb_plugin' ),
		'edit_item'                  => __( 'Edit Location', 'cwb_plugin' ),
		'update_item'                => __( 'Update Location', 'cwb_plugin' ),
		'separate_items_with_commas' => __( 'Separate Locations with commas', 'cwb_plugin' ),
		'search_items'               => __( 'Search Locations', 'cwb_plugin' ),
		'add_or_remove_items'        => __( 'Add or remove Locations', 'cwb_plugin' ),
		'choose_from_most_used'      => __( 'Choose from the most used Locations', 'cwb_plugin' ),
		'not_found'                  => __( 'No Location Found', 'cwb_plugin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => false,
		'show_admin_column'          => false,
		'menu-icon'					 => 'dashicons-images-alt2',
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'location', 'project', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy', 0 );
// Register Custom Taxonomy
function custom_year_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Project Years', 'Taxonomy General Name', 'cwb_plugin' ),
		'singular_name'              => _x( 'Project Year', 'Taxonomy Singular Name', 'cwb_plugin' ),
		'menu_name'                  => __( 'Years', 'cwb_plugin' ),
		'all_items'                  => __( 'All Years', 'cwb_plugin' ),
		'parent_item'                => __( 'Parent Year', 'cwb_plugin' ),
		'parent_item_colon'          => __( 'Parent Year:', 'cwb_plugin' ),
		'new_item_name'              => __( 'New Years', 'cwb_plugin' ),
		'add_new_item'               => __( 'Add New Year', 'cwb_plugin' ),
		'edit_item'                  => __( 'Edit Year', 'cwb_plugin' ),
		'update_item'                => __( 'Update Year', 'cwb_plugin' ),
		'separate_items_with_commas' => __( 'Separate Years with commas', 'cwb_plugin' ),
		'search_items'               => __( 'Search Years', 'cwb_plugin' ),
		'add_or_remove_items'        => __( 'Add or remove Years', 'cwb_plugin' ),
		'choose_from_most_used'      => __( 'Choose from the most used Years', 'cwb_plugin' ),
		'not_found'                  => __( 'No Years Found', 'cwb_plugin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'project-year', 'project', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_year_taxonomy', 0 );



// Register Custom Member Role Taxonomy
function custom_member_role_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Member Roles', 'Taxonomy General Name', 'cwb_plugin' ),
		'singular_name'              => _x( 'Role', 'Taxonomy Singular Name', 'cwb_plugin' ),
		'menu_name'                  => __( 'Roles', 'cwb_plugin' ),
		'all_items'                  => __( 'All Roles', 'cwb_plugin' ),
		'parent_item'                => __( 'Parent Role', 'cwb_plugin' ),
		'parent_item_colon'          => __( 'Parent Role:', 'cwb_plugin' ),
		'new_item_name'              => __( 'New Member Role', 'cwb_plugin' ),
		'add_new_item'               => __( 'Add New Role', 'cwb_plugin' ),
		'edit_item'                  => __( 'Edit Role', 'cwb_plugin' ),
		'update_item'                => __( 'Update Role', 'cwb_plugin' ),
		'separate_items_with_commas' => __( 'Separate Roles with commas', 'cwb_plugin' ),
		'search_items'               => __( 'Search Member Roles', 'cwb_plugin' ),
		'add_or_remove_items'        => __( 'Add or remove Roles', 'cwb_plugin' ),
		'choose_from_most_used'      => __( 'Choose from the most used Roles', 'cwb_plugin' ),
		'not_found'                  => __( 'Not Found', 'cwb_plugin' ),
	);
$rewrite = array(
		'slug'                => 'members',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'					 => $rewrite,
	);
	register_taxonomy( 'role', 'member', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_member_role_taxonomy', 0 );

// get a dropdown to filter members in admin by role taxo 
function pippin_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('role');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'member' ){
 
		foreach ($taxonomies as $tax_slug) {
			$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'pippin_add_taxonomy_filters' );



function sort_year_taxonomy_archives( $query ) {
        // If not the admin section
        if ( !is_admin() &&  $query->is_main_query()) {
            // If on a taxonomy page
            if ( is_tax('project-year') ) {
                $query->set( 'meta_key', 'project_start_date' );
                $query->set( 'orderby', 'meta_value_num' );
                $query->set( 'order', 'DESC' );
            }
        }
    }
add_action( 'pre_get_posts', 'sort_year_taxonomy_archives' );

function sort_location_taxonomy_archives( $query ) {
        // If not the admin section
        if ( !is_admin() &&  $query->is_main_query()) {
            // If on a taxonomy page
            if ( is_tax('location') ) {
                $query->set( 'meta_key', 'project_start_date' );
                $query->set( 'orderby', 'meta_value_num' );
                $query->set( 'order', 'DESC' );
            }
        }
    }
add_action( 'pre_get_posts', 'sort_location_taxonomy_archives' );


/***** MAP STUFF *****/

function my_acf_google_map_api( $api ){//Add API key to ACF
	$api['key'] = 'AIzaSyBWWpgCXukr23f4IKab3lE-2lp8gfWMwxA';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function ajax_actions() {	
	add_action('wp_ajax_nopriv_cwb_init_projects', 'cwb_init_projects' );
	add_action('wp_ajax_cwb_init_projects', 'cwb_init_projects' );
	add_action('wp_ajax_nopriv_cwb_search_projects', 'cwb_search_projects' );
	add_action('wp_ajax_cwb_search_projects', 'cwb_search_projects' );
	add_action('wp_ajax_nopriv_cwb_init_countries', 'cwb_init_countries' );
	add_action('wp_ajax_cwb_init_countries', 'cwb_init_countries' );
}
function ajax_enqueue_scripts() {

	$template_dir = get_stylesheet_directory_uri();

	wp_enqueue_style( 'datatables', "https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css" );
	
	wp_enqueue_script( 'google-maps-api',"https://maps.googleapis.com/maps/api/js?key=AIzaSyBWWpgCXukr23f4IKab3lE-2lp8gfWMwxA", array('jquery'), "1.0",true);
	wp_enqueue_script( 'map-marker-clusterer', $template_dir . '/js/js-marker-clusterer/src/markerclusterer.js', array(  'jquery','google-maps-api' ), '1.0', true );
	wp_enqueue_script( 'datatables', "https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js", array('jquery'), '1.0', true );
	wp_enqueue_script( 'cwbmap', $template_dir . '/js/cwb_map.js', array('jquery',"google-maps-api","map-marker-clusterer",'datatables'), '1.0', true );

	wp_localize_script( 'cwbmap', 'getprojects', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));	
	wp_localize_script( 'cwbmap', 'searchprojects', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));	
	wp_localize_script( 'cwbmap', 'getcountries', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));	
}
ajax_actions();
ajax_enqueue_scripts();


function cwb_search_projects() {
	$ret = new StdClass();
	$ret->query = $_POST['query'];
	$ret->args = array(
		'post_type' => 'project',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		's' => $ret->query
	);
	$search = new WP_Query( $ret->args );
	$ret->IDs = array();
	if ( $search->have_posts() ) {
		while ( $search->have_posts() ) {
			$search->the_post();
			$ret->IDs[] = get_the_id();
		}
	}
	echo json_encode($ret);
	die();
}

function get_projects() {
	$return  = new StdClass();

	$projects = array();
	$years = array();
	$countries = array();
	$map_projects = new WP_Query( array(
		'post_type' => 'project', 
		'posts_per_page' => -1,
		'meta_key'	=> 'project_start_date',
		'orderby'=> 'meta_value_num',
		'order' => 'DESC'
	));
	
	if( $map_projects->have_posts()) { 
		while ( $map_projects->have_posts() ) {
		
			$tmp = new StdClass();
			$map_projects->the_post();
			$tmp->visible = true;
			$tmp->ID = get_the_id();
			$tmp->location = get_field('project_location'); 
			$tmp->title = get_the_title();
			
			$project_years = get_the_terms( get_the_ID(),'project-year');
			$tmp->year = intval($project_years[0]->name);
			if ($tmp->year > 0 && !in_array($tmp->year,$years)) {
				$years[] = $tmp->year;
			}

			$project_countries = get_field('countries_for_this_project',$tmp->ID);
			$tmp->countryIDs = array();
			$tmp->countries = array();
			if ($project_countries) {
   				foreach ( $project_countries as $project_country ) {
					$select_country_pages = $project_country['select_country_page'];
					$select_country_page = $select_country_pages[0];
					$this_country= new StdClass();#using ID as key to prevent dupes
					$this_country->ID = $select_country_page->ID;
					$this_country->title = $select_country_page->post_title;
					$this_country->permalink = get_permalink($this_country->ID);
					
					if (!isset($countries[$select_country_page->ID])) {
						$countries[$select_country_page->ID] = $this_country;
					}
					$tmp->countries[] = $this_country;
					$tmp->countryIDs[] = $select_country_page->ID;#easy for js
				}
			}
			
			$tmp->excerpt = get_the_excerpt();
			$tmp->permalink = get_the_permalink();
			$tmp->thumbnail = '';
			if ( has_post_thumbnail() ) { 
				$tmp->thumbnail = get_the_post_thumbnail($map_project,'projectfeature');
			}elseif ( $imageID = get_field ( 'hero_image' )) {
				$img = wp_get_attachment_image( $imageID, 'projectfeature' );
				$tmp->thumbnail = $img;
			}
			if (get_field('project_start_date')) { 
				$tmp->project_start_date = date('F d, Y',strtotime(get_field( 'project_start_date' )));
			}
			if (get_field('project_end_date')) { 
				$tmp->project_end_date = date('F d, Y',strtotime(get_field( 'project_end_date' )));
			}
			$projects[] = $tmp;
		}
	}
	$return->projects = $projects;
	asort($countries);
	$return->countries = $countries;
	sort($years);
	$return->years = $years;
	return $return;
}

function cwb_init_projects() {
	$projectObject = get_projects();
	echo json_encode($projectObject);
	die();
}


function get_countries() {

	$projects = get_projects();
	$countries = array();
	$args = array( 
		'post_type' => 'country', 
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC'
	);
	$loop = new WP_Query( $args ); 
	while ( $loop->have_posts() ) {
		$loop->the_post();
		$country = new StdClass();
		$country->ID = get_the_id();
		$country->location = get_field('country_map_marker',$post->ID);
		$country->flag_image = new StdClass();
		$country->flag_image->src = get_field('flag_image',$post->ID);
		list($country->flag_image->w, $country->flag_image->h) = getimagesize($country->flag_image->src);
		$country->title = get_the_title();
		$country->permalink = get_the_permalink();
		
		$country->peopleServed = intval(get_field('historic_stats',$post->ID));
		$country->projectCount = intval(get_field('historic_projects',$post->ID));
		$country->projects = array();
		$country->peopleServed = 0;
		foreach ( $projects->projects as $project ) {
			if (have_rows('countries_for_this_project',$project->ID)) {#ACF instuctions for doing this as a metadata query don't work
				while ( have_rows('countries_for_this_project',$project->ID) ) {
					the_row();
					$project_country = get_sub_field('select_country_page');
					if ($project_country[0]->ID == $country->ID) {
						$country->peopleServed += get_sub_field('number_of_people_served');
						$country->projects[] = $project;
					}
				}
			}
		}
		$country->projectCount = sizeof($country->projects);
		$countries[] = $country;
	}
	return $countries;
}

function cwb_init_countries() {
	$countries = get_countries();
	echo json_encode($countries);
	die();
}
function findCountryByPostID($ID) {
	$ret = null;
	$countries = get_countries();
	foreach ($countries as $country) {
		if ($country->ID == $ID) {
			$ret = $country;
		}
	}
	return $ret;
}
function findProjectByPostID($ID) {
	$ret = null;
	$projects = get_projects();
	foreach ($projects->projects as $project) {
		if ($project->ID == $ID) {
			$ret = $project;
		}
	}
	return $ret;
}