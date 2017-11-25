<?php

function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Register Custom Post Type
function iv1_custom_inventory() {

	$labels = array(
		'name'                  => _x( 'inventory', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'inventory', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'inventory', 'text_domain' ),
		'name_admin_bar'        => __( 'inventory', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'inventory', 'text_domain' ),
		'description'           => __( 'Inventory', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'inventory', $args );

}
add_action( 'init', 'iv1_custom_inventory', 0 );

/* try to make it work.. atleast.. */
/* function 1: Add new record */
function add_record($params) {
	$params['post_type'] = "inventory";
	// $result = wp_insert_post($params, true);
	return $params;
	/*$query = parse_url($_SERVER["QUERY_STRING"], PHP_URL_QuERY);
	parse_str($query, $params);
	var_dump($params);*/
/*	$record = array();

	foreach($params as $k=>$v){
		var_dump($k);
	}
	$post = $params['product_name'];*/
	/*$post = array(
			'id' => $params['product_name']
		);	*/
	/*var_dump($params[]);*/
	/*parse_url($_SERVER["QUERY_STRING"], (PHP_URL_QuERY, $result);
	$json = json_encode($result);
	var_dump($json);*/
	/*$posts = get_posts( array(
        'post_type' => 'inventory'
    ) );

	$post = array(
			'id' => $param['id']
		);*/
	

	return $result;
}

add_action( 'rest_api_init', function () {
	register_rest_route( 'iventory/v1', 'add-record',array(
		'methods'  => 'POST',
		'callback' => 'add_record'
	) );
} );

/* function 2: Update record */
function update_record($param){
	var_dump($param);
	$post = array(
			'id' => $param['id']
		);
}

add_action( 'rest_api_init', function () {
	register_rest_route( 'iventory/v1', 'update-record',array(
		'methods'  => 'PUT',
		'callback' => 'update_record'
		) );
} );

/* function 3: get all records */
function get_records ( $params ){
    $posts = get_posts( array(
        'post_type' => 'inventory'
    ) );

    if ( empty( $posts ) ) {
        return null;
    }

    return $posts;
}
 
// Register the rest route here.
 
add_action( 'rest_api_init', function () {
	register_rest_route(
		'iventory/v1',
		'get-records',
		array(
			'methods'  => 'GET',
			'callback' => 'get_records'
		));
});
?>