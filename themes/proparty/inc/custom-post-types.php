<?php

/*------------------------------------*\
	CUSTOM POST TYPES
\*------------------------------------*/

add_action('init', function(){

	// RESOURCES
	// $resource_pt = register_cuztom_post_type( 'Resource' );
	// // Add taxonomies
	// $resource_pt->add_taxonomy( 'Language' );
	// insert_language_taxonomy_terms();
	// $resource_pt->add_taxonomy( 'Sector' );
	// //insert_resource_type_taxonomy_terms();
	// $resource_pt->add_taxonomy( 'Country' );
	// insert_country_taxonomy_terms();
	// $resource_pt->add_taxonomy( 'Resource Type' );
	// insert_resource_type_taxonomy_terms();
	// $resource_pt->add_taxonomy( 'Working Group' );
	// insert_working_group_taxonomy_terms();

	// MAP TEST
	$labels = array(
		'name'          => 'Resource',
		'singular_name' => 'Resource',
		'add_new'       => 'New Resource',
		'add_new_item'  => 'New Resource',
		'edit_item'     => 'Edit Resource',
		'new_item'      => 'New Resource',
		'all_items'     => 'All',
		'view_item'     => 'View Resource',
		'menu_name'     => 'Resource'
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'resource' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type( 'resource', $args );

	if( ! taxonomy_exists('language')){

		$labels = array(
			'name'              => 'Language',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'language' ),
		);

		register_taxonomy( 'language', 'resource', $args );
	}
	insert_language_taxonomy_terms();

	if( ! taxonomy_exists('sector')){

		$labels = array(
			'name'              => 'Sector',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'sector' ),
		);

		register_taxonomy( 'sector', 'resource', $args );
	}

	if( ! taxonomy_exists('country')){

		$labels = array(
			'name'              => 'Country',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'country' ),
		);

		register_taxonomy( 'country', 'resource', $args );
	}
	insert_country_taxonomy_terms();

	if( ! taxonomy_exists('resource_type')){

		$labels = array(
			'name'              => 'Resource type',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'resource_type' ),
		);

		register_taxonomy( 'resource_type', 'resource', $args );
	}
	insert_resource_type_taxonomy_terms();

	if( ! taxonomy_exists('working_group')){

		$labels = array(
			'name'              => 'Working Group',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'working_group' ),
		);

		register_taxonomy( 'working_group', 'resource', $args );
	}
	insert_working_group_taxonomy_terms();

	if( ! taxonomy_exists('principles')){

		$labels = array(
			'name'              => 'Principles',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'principles' ),
		);

		register_taxonomy( 'principles', 'resource', $args );
	}

	if( ! taxonomy_exists('maturity-level')){

		$labels = array(
			'name'              => 'Maturity Level',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'maturity-level' ),
		);

		register_taxonomy( 'maturity-level', 'resource', $args );
	}

	if( ! taxonomy_exists('user_profiles')){

		$labels = array(
			'name'              => 'User Profiles and Roles',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'user_profiles' ),
		);

		register_taxonomy( 'user_profiles', 'resource', $args );
	}

	if( ! taxonomy_exists('data_driven_classification')){

		$labels = array(
			'name'              => 'Data-driven Classification',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'data_driven_classification' ),
		);

		register_taxonomy( 'data_driven_classification', 'resource', $args );
	}

	if( ! taxonomy_exists('themes_and_topics')){

		$labels = array(
			'name'              => 'Themes and Topics',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'themes_and_topics' ),
		);

		register_taxonomy( 'themes_and_topics', 'resource', $args );
	}

	if( ! taxonomy_exists('reference_type')){

		$labels = array(
			'name'              => 'Reference Type',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'reference_type' ),
		);

		register_taxonomy( 'reference_type', 'resource', $args );
	}

	if( ! taxonomy_exists('territories')){

		$labels = array(
			'name'              => 'Territories',
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'territories' ),
		);

		register_taxonomy( 'territories', 'resource', $args );
	}
});

/*
 * Insert region taxonomy terms
 */
function insert_language_taxonomy_terms(){
	$languages = array( 'English', 'Español' );
	foreach ( $languages as $language ) {
		$term = term_exists( $language, 'language' );
		if ( FALSE !== $term && NULL !== $term ) continue;

		wp_insert_term( $language, 'language' );
	}
}// insert_language_taxonomy_terms

/*
 * Insert region taxonomy terms
 */
function insert_implementing_partner_taxonomy_terms(){
	// $regions = array( 'Global Initiatives', 'Africa', 'Asia', 'Eastern Europe & Central Asia', 'Caribbean', 'Latin America' );
	// foreach ( $regions as $region ) {
	// 	$term = term_exists( $region, 'region' );
	// 	if ( FALSE !== $term && NULL !== $term ) continue;

	// 	wp_insert_term( $region, 'region' );
	// }
}// insert_implementing_partner_taxonomy_terms

/*
 * Insert region taxonomy terms
 */
function insert_country_taxonomy_terms(){
	$country = array( 'Mexico', 'Canada', 'USA' );
	foreach ( $country as $area ) {
		$term = term_exists( $area, 'country' );
		if ( FALSE !== $term && NULL !== $term ) continue;

		wp_insert_term( $area, 'country' );
	}
}// insert_country_taxonomy_terms

/*
 * Insert sector taxonomy terms
 */
function insert_resource_type_taxonomy_terms(){
	$resource_types = array( 'Datasets', 'Platforms' );
	foreach ( $resource_types as $resource_type ) {
		$term = term_exists( $resource_type, 'resource_type' );
		if ( FALSE !== $term && NULL !== $term ) continue;

		wp_insert_term( $resource_type, 'resource_type' );
	}
}// insert_resource_type_taxonomy_terms

/*
 * Insert sector taxonomy terms
 */
function insert_working_group_taxonomy_terms(){
	$groups = array( 'Implementation', 'Technical', 'Subnational Governments', 'Private Sector', 'Accountability', 'Incentive Mechanisms' );
	foreach ( $groups as $group ) {
		$term = term_exists( $group, 'working_group' );
		if ( FALSE !== $term && NULL !== $term ) continue;

		wp_insert_term( $group, 'working_group' );
	}
}// insert_working_group_taxonomy_terms

function insert_user_profiles_taxonomy_terms(){
	$user_profiles = array( 'Stakeholder Groups', 'Public Sector', 'Private Sector', 'Donors, Foundations and International Organizations', 'Civil Society Organizations', 'Academia / Research', 'Civil Hackers', 'Media' );
	foreach ( $user_profiles as $user_profile ) {
		$term = term_exists( $user_profile, 'user_profiles' );
		if ( FALSE !== $term && NULL !== $term ) continue;

		wp_insert_term( $user_profile, 'user_profile' );
	}
}// insert_user_profiles_taxonomy_terms





