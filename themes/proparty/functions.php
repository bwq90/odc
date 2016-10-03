<?php
/**
 * Theme sprecific functions and definitions
 */

/* Theme setup section
------------------------------------------------------------------- */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 1170; /* pixels */

// Add theme specific actions and filters
// Attention! Function were add theme specific actions and filters handlers must have priority 1
if ( !function_exists( 'axiom_theme_setup' ) ) {
	add_action( 'axiom_action_before_init_theme', 'axiom_theme_setup', 1 );
	function axiom_theme_setup() {

		// Register theme menus
		add_filter( 'axiom_filter_add_theme_menus',		'axiom_add_theme_menus' );

		// Register theme sidebars
		add_filter( 'axiom_filter_add_theme_sidebars',	'axiom_add_theme_sidebars' );

		// Set theme name and folder (for the update notifier)
		add_filter('axiom_filter_update_notifier', 		'axiom_set_theme_names_for_updater');
	}
}


// Add/Remove theme nav menus
if ( !function_exists( 'axiom_add_theme_menus' ) ) {
	//add_filter( 'axiom_action_add_theme_menus', 'axiom_add_theme_menus' );
	function axiom_add_theme_menus($menus) {

		//For example:
		//$menus['menu_footer'] = __('Footer Menu', 'axiom');
		//if (isset($menus['menu_panel'])) unset($menus['menu_panel']);

		if (isset($menus['menu_side'])) unset($menus['menu_side']);
		return $menus;
	}
}


// Add theme specific widgetized areas
if ( !function_exists( 'axiom_add_theme_sidebars' ) ) {
	//add_filter( 'axiom_filter_add_theme_sidebars',	'axiom_add_theme_sidebars' );
	function axiom_add_theme_sidebars($sidebars=array()) {
		if (is_array($sidebars)) {
			$theme_sidebars = array(
				'sidebar_main'		=> __( 'Main Sidebar', 'axiom' ),
				'sidebar_footer'	=> __( 'Footer Sidebar', 'axiom' )
			);
			if (axiom_exists_woocommerce()) {
				$theme_sidebars['sidebar_cart']  = __( 'WooCommerce Cart Sidebar', 'axiom' );
			}
			$sidebars = array_merge($theme_sidebars, $sidebars);
		}
		return $sidebars;
	}
}

// Set theme name and folder (for the update notifier)
if ( !function_exists( 'axiom_set_theme_names_for_updater' ) ) {
	//add_filter('axiom_filter_update_notifier', 'axiom_set_theme_names_for_updater');
	function axiom_set_theme_names_for_updater($opt) {
		$opt['theme_name']   = 'Progress Party';
		$opt['theme_folder'] = 'default';
		return $opt;
	}
}



/* Include framework core files
------------------------------------------------------------------- */

require_once( get_template_directory().'/fw/loader.php' );


/*
 * Cuervo functions start here bruh!
 */

/*------------------------------------*\
	#CONSTANTS
\*------------------------------------*/

/**
* Define paths to javascript, styles, theme and site.
**/
define( 'JSPATH', get_template_directory_uri() . '/js/' );
define( 'THEMEPATH', get_template_directory_uri() . '/' );
define( 'SITEURL', site_url('/') );

/*------------------------------------*\
	#INCLUDES
\*------------------------------------*/

include( 'inc/cuztom/cuztom.php' );
require_once( 'inc/custom-post-types.php' );
require_once( 'inc/metaboxes.php' );
require_once( 'inc/functions-js-footer.php' );



/*------------------------------------*\
	#GENERAL FUNCTIONS
\*------------------------------------*/

add_theme_support('post-thumbnails');

if ( function_exists('add_image_size') ){

	add_image_size( 'news-home', 443, 240, true );

}

/**
* Enqueue frontend scripts and styles
**/
add_action( 'wp_enqueue_scripts', function(){

	// scripts
	wp_enqueue_script( 'plugins', JSPATH.'plugins.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'functions', JSPATH.'functions.js', array('plugins'), '1.0', true );

	wp_localize_script( 'functions', 'theme_path', THEMEPATH );

});

/**
* Add javascript to the footer of pages and admin.
**/
add_action( 'wp_footer', 'footer_scripts', 21 );

/**
* Make excerpt shorter
**/
function wp_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wp_excerpt_length', 999 );



/*------------------------------------*\
	#GENERAL FUNCTIONS
\*------------------------------------*/

/**
 * Show filters
 * @param $taxonomy
*/
function show_filters( $taxonomy, $val ){

	if( 'working-group' == $taxonomy){
		show_filters_working_groups();
		return;
	}

	if( 'working-group-centre' == $taxonomy){
		show_filters_working_groups_centre();
		return;
	}

	$args = array(
	    'orderby'                => 'name',
	    'hide_empty'             => true,
	);
	$filters = get_terms( $taxonomy, $args );
	if( empty( $filters ) ) return;

	/*echo '<div class="option-set" data-group="' . $taxonomy . '">';
	echo '<input type="checkbox" value="" id="' . $taxonomy . '-all" class="all" checked /><label for="' . $taxonomy . '-all">all</label><br />';
	foreach ( $filters as $filter ) {
		echo '<input data-name="'.$filter->name.'" type="checkbox" value=".' . $filter->slug . '" id="' . $filter->slug . '" /><label for="' . $filter->slug . '">' . $filter->name . '</label><br />';
	}
	echo '</div>';*/

	echo '<select class="resources-results-filter" name="filter-' . $taxonomy . '" data-filter-group="' . $taxonomy . '">';

	switch ( $taxonomy ) {
		case 'working_group':
			break;
		case 'user_profiles':
			echo "<option value=''>All User Profiles</option>";
			break;
		case 'themes_and_topics':
			echo '<option value="">All Themes and Topics</option>';
			break;
		case 'data_driven_classification':
			echo '<option value="">All Data-driven Classifications</option>';
			break;
		case 'reference_type':
			echo '<option value="">All Reference Types</option>';
			break;
		case 'territories':
			echo '<option value="">All Territories</option>';
			break;
	}

	foreach ( $filters as $filter ) :
		$selected 	= ( $val == $filter->slug ) ? "selected='selected'" : "";
		echo "<option value='" . $filter->slug . "' " . $selected . ">" . $filter->name . "</option>";
	endforeach;
	echo '</select>';
}

/**
 * Show filters
 * @param $taxonomy
*/
function show_filters_working_groups(){
	$group_active = isset($_POST['group']) ? $_POST['group'] : '';

	$args = array(
	    'orderby'                => 'name',
	    'hide_empty'             => true,
	);
	$filters = get_terms( 'working_group', $args );
	if( empty( $filters ) ) return;

	echo '<div class="[ button-group ]" data-filter-group="working_group">';

	echo '<a href="#" class="[ sc_button sc_button_size_medium ][ color-light ][ sc_button_bordered ]" data-filter="">All</a>';
	foreach ( $filters as $filter ): 
		$active = $filter->slug == $group_active ? 'active' : '';
		echo '<a href="#" class="[ sc_button sc_button_size_medium ][ color-light ][ sc_button_bordered ] '.$active.'" data-filter=".' . $filter->slug . '">' . $filter->name . '</a>';
	endforeach;
	echo '</div>';
}


/**
 * Show filters RESOURCE CENTRE
 * @param $taxonomy
*/
function show_filters_working_groups_centre(){

	$args = array(
	    'orderby'                => 'name',
	    'hide_empty'             => true,
	);
	$filters = get_terms( 'working_group', $args );
	if( empty( $filters ) ) return;

	echo '<div class="[ button-group ]" data-filter-group="working_group">';

	echo '<a href="#" class="[ form-groups sc_button sc_button_size_medium ][ color-light ][ sc_button_bordered ]" data-filter="">All</a>';
	foreach ( $filters as $filter ) 
		echo '<form method="POST" action="'.site_url() . '/resource-centre-results" class="form-groups"><input type="hidden" name="group" value="'.$filter->slug.'"><input type="submit" class="[ sc_button sc_button_size_medium ][ color-light ][ sc_button_bordered ]" value="'.$filter->name.'"></form>';

	echo '</div>';
}



/*------------------------------------*\
	#SET/GET FUNCTIONS
\*------------------------------------*/

/**
 * Get resource info for filters.
 * @param integer $post_id
 * @return mixed $resource_info
 */
function get_resource_info( $post_id ){

	$resource_info = array(
		'language'				=> get_resource_meta_slug( $post_id, 'language' ),
		'country'				=> get_resource_meta_slug( $post_id, 'country' ),
		'sector'				=> get_resource_meta_slug( $post_id, 'sector' ),
		'working_group'			=> get_resource_meta_slug( $post_id, 'working_group' ),
		'principles'			=> get_resource_meta_slug( $post_id, 'principles' ),
		'maturity-level'		=> get_resource_meta_slug( $post_id, 'maturity-level' ),

		);
	return $resource_info;
}// get_resource_info

/**
 * Get region slug for a given result.
 * @param integer $post_id
 * @param string $taxonomy
 * @return string $slug
 */
function get_resource_meta_slug( $post_id, $taxonomy ){
	$term = wp_get_post_terms( $post_id, $taxonomy );
	$slug = empty( $term ) ? '' : $term[0]->slug;
	return $slug;
}// get_resource_meta_slug

/**
 * Get Working Group of given Resource
 * @param integer $post_id
 * @return string $working_group
 */
function get_working_group( $post_id ){

	$terms = wp_get_post_terms( $post_id, 'working_group' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_working_group

/**
 * Get Sector of given Resource
 * @param integer $post_id
 * @return string $sector
 */
function get_sector( $post_id ){

	$terms = wp_get_post_terms( $post_id, 'sector' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_sector

/**
 * Get Country of given Resource
 * @param integer $post_id
 * @return string $country
 */
function get_country( $post_id ){

	$terms = wp_get_post_terms( $post_id, 'country' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_country

/**
 * Get Language of given Resource
 * @param integer $post_id
 * @return string $language
 */
function get_language( $post_id ){

	$terms = wp_get_post_terms( $post_id, 'language' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_language

/**
 * Get principles of given Resource
 * @param integer $post_id
 * @return string $principles
 */
function get_principles( $post_id ){

	$terms = wp_get_post_terms( $post_id, 'principles' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_principles

/**
 * Get reference type of given Resource
 * @param integer $post_id
 * @return string $reference_type
 */
function get_reference_type( $post_id ){

	$terms = wp_get_post_terms( $post_id, 'reference_type' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_reference_type

/**
 * Get Working Group of given Resource
 * @param integer $post_id
 * @return string $themes_and_topics
 */
function get_themes_and_topics( $post_id ){

	$terms = wp_get_post_terms( $post_id, 'themes_and_topics' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_themes_and_topics

/**
 * Get Language of given Resource
 * @param integer $post_id
 * @return string $res_type
 */
function get_res_type( $post_id ){

	$terms = wp_get_post_terms( $post_id, 'resource_type' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_res_type


function getResources($search, $limit, $featured = false, $order = 'post_date'){
	global $wpdb;
	$exta 		= $search == '' ? '' : 'AND ( post_title LIKE "%' . $search . '%" OR post_content LIKE "%' . $search . '%" )';
	$ids_query	= [];

	if ( $featured ) {
		$featured_id	= $wpdb->get_results( "SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key='meta-featured' AND meta_value='yes';", OBJECT );
		$ids_query		= 'AND';
		foreach ( $featured_id as $post ) {
			$ids_query	.= " ID={$post->post_id} ";
			if ( $featured_id[sizeof( $featured_id ) -1 ]->post_id != $post->post_id ) {
				$ids_query	.= 'OR';
			}
		}
		trim( $ids_query );
	}

	if ( sizeof( $ids_query ) > 0 ) {
		return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE post_status = 'publish' AND post_type = 'resource' $ids_query LIMIT $limit;", OBJECT );
	} else {
		return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE post_status = 'publish' AND post_type = 'resource' $exta ORDER BY $order LIMIT $limit;", OBJECT );
	}
}


/**	
 * GET DATE TRANSFORM
 */
function getDateTransform($fecha){
	$dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sábado','Domingo');
	$dia_name = $dias[date('N', strtotime($fecha)) - 1];
	$MesTresLetras = date('M', strtotime($fecha) );

	$fecha = explode('-', $fecha);

	$mes = array('01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' =>'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');

	return array($fecha[2], $mes[$fecha[1]], $fecha[0], $dia_name, $fecha[1], $MesTresLetras);
}


function getPostCentre($taxonomy, $term){
	$resources_args = array(
		'post_type' => 'resource',
		'posts_per_page' => 1,
		'meta_key' => '_open_contribution_meta',
		'meta_value' => 'no', 
		'tax_query' => array(
			array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => $term )
			)
		);
	$result = new WP_Query( $resources_args );
	
	return isset($result->posts[0]) ? $result->posts[0] : false;
}

function sm_custom_meta() {
    add_meta_box( 'sm_meta', __( 'Featured Post', 'sm-textdomain' ), 'sm_meta_callback', 'resource' );
}
function sm_meta_callback( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
	<p>
    <div class="sm-row-content">
        <label for="meta-featured">
            <input type="checkbox" name="meta-featured" id="meta-featured" value="yes" <?php if ( isset ( $featured['meta-featured'] ) ) checked( $featured['meta-featured'][0], 'yes' ); ?> />
            <?php _e( 'Feature this post', 'sm-textdomain' ); ?>
        </label>
        
    </div>
</p>
    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta' );

function sm_meta_save( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

	// Checks for input and saves
	if( isset( $_POST[ 'meta-featured' ] ) ) {
	    update_post_meta( $post_id, 'meta-featured', 'yes' );
	} else {
	    update_post_meta( $post_id, 'meta-featured', '' );
	}
}
add_action( 'save_post', 'sm_meta_save' );

function sm_upcoming_meta() {
    add_meta_box( 'sm_meta', __( 'Upcoming Resource', 'sm-textdomain' ), 'sm_upcoming_callback', 'resource' );
}
function sm_upcoming_callback( $post ) {
    $upcoming = get_post_meta( $post->ID );
    ?>
	<p>
    <div class="sm-row-content">
        <label for="meta-upcoming">
            <input type="checkbox" name="meta-upcoming" id="meta-upcoming" value="yes" <?php if ( isset ( $upcoming['meta-upcoming'] ) ) checked( $upcoming['meta-upcoming'][0], 'yes' ); ?> />
            <?php _e( 'Upcoming Resource', 'sm-textdomain' ); ?>
        </label>
        
    </div>
</p>
    <?php
}
add_action( 'add_meta_boxes', 'sm_upcoming_meta' );

function sm_upcoming_save( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

	// Checks for input and saves
	if( isset( $_POST[ 'meta-upcoming' ] ) ) {
	    update_post_meta( $post_id, 'meta-upcoming', 'yes' );
	} else {
	    update_post_meta( $post_id, 'meta-upcoming', '' );
	}
}
add_action( 'save_post', 'sm_upcoming_save' );

function sm_link_meta() {
    add_meta_box( 'sm_link', __( 'Document Link', 'sm-textdomain' ), 'sm_link_callback', 'resource' );
}
function sm_link_callback( $post ) {
    $post = get_post_meta( $post->ID );
    ?>
	<p>
    <div class="sm-row-content">
        <label for="meta-link">
        	<?php _e( 'Document Link', 'sm-textdomain' ); ?>
        </label>
        <input type="text" name="meta-link" id="meta-link" value="<?php echo $post['meta-link'] ? $post['meta-link'][0] : ''; ?>" />
    </div>
</p>
    <?php
}
add_action( 'add_meta_boxes', 'sm_link_meta' );

function sm_link_save( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

	// Checks for input and saves
	if( isset( $_POST[ 'meta-link' ] ) ) {
	    update_post_meta( $post_id, 'meta-link', $_POST[ 'meta-link' ] );
	} else {
	    update_post_meta( $post_id, 'meta-link', '' );
	}
}
add_action( 'save_post', 'sm_link_save' );

function sm_meta_author() {
    add_meta_box( 'sm_author', __( 'Resource Author', 'sm-textdomain' ), 'sm_author_callback', 'resource' );
}
function sm_author_callback( $post ) {
    $post = get_post_meta( $post->ID );
    ?>
	<p>
    <div class="sm-row-content">
        <label for="meta-author">
        	<?php _e( 'Resource Author', 'sm-textdomain' ); ?>
        </label>
        <input type="text" name="meta-author" id="meta-author" value="<?php echo $post['meta-author'] ? $post['meta-author'][0] : ''; ?>" />
    </div>
</p>
    <?php
}
add_action( 'add_meta_boxes', 'sm_meta_author' );

function sm_author_save( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

	// Checks for input and saves
	if( isset( $_POST[ 'meta-author' ] ) ) {
	    update_post_meta( $post_id, 'meta-author', $_POST[ 'meta-author' ] );
	} else {
	    update_post_meta( $post_id, 'meta-author', '' );
	}
}
add_action( 'save_post', 'sm_author_save' );