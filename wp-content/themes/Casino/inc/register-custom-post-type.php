<?php 
// Register quiz post type
add_action( 'init', 'quiz_post' );
function quiz_post() {

	$labels = array(
		'name'               => __( 'Quiz', 'casino' ),
		'singular_name'      => __( 'Quiz', 'casino' ),
		'add_new'            => _x( 'Add New Quiz', 'casino', 'casino' ),
		'add_new_item'       => __( 'Add New Quiz', 'casino' ),
		'edit_item'          => __( 'Edit Quiz', 'casino' ),
		'new_item'           => __( 'New Quiz', 'casino' ),
		'view_item'          => __( 'View Quiz', 'casino' ),
		'search_items'       => __( 'Search Quiz', 'casino' ),
		'not_found'          => __( 'No Quiz found', 'casino' ),
		'not_found_in_trash' => __( 'No Quiz found in Trash', 'casino' ),
		'parent_item_colon'  => __( 'Parent Quiz:', 'casino' ),
		'menu_name'          => __( 'Quiz', 'casino' ),
	);
	
	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-analytics',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'custom-fields',
	),
);

	register_post_type( 'quiz', $args );
}


// Register Casino post type
add_action( 'init', 'online_casinos' );
function online_casinos() {

	$labels = array(
		'name'               => __( 'Casino', 'casino' ),
		'singular_name'      => __( 'Casino', 'casino' ),
		'add_new'            => _x( 'Add New Casino', 'casino', 'casino' ),
		'add_new_item'       => __( 'Add New Casino', 'casino' ),
		'edit_item'          => __( 'Edit Casino', 'casino' ),
		'new_item'           => __( 'New Casino', 'casino' ),
		'view_item'          => __( 'View Casino', 'casino' ),
		'search_items'       => __( 'Search Casino', 'casino' ),
		'not_found'          => __( 'No Casino found', 'casino' ),
		'not_found_in_trash' => __( 'No Casino found in Trash', 'casino' ),
		'parent_item_colon'  => __( 'Parent Casino:', 'casino' ),
		'menu_name'          => __( 'Casino', 'casino' ),
	);
	
	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array( 
			'casino-types', 
			'payment-methods', 
			'currencies', 
			'minimum-deposit', 
			'casino-games',
			'casino-softwares',
			'licenses',
		),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-vault',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'custom-fields',
		),
		'rewrite'             => array(
			'slug' => 'reviews',
			'with_front' => false
		),
);

	register_post_type( 'casinos', $args );
}


// Register Worst Casino post type
add_action( 'init', 'online_worst_casinos' );
function online_worst_casinos() {

	$labels = array(
		'name'               => __( 'Worst Casino', 'casino' ),
		'singular_name'      => __( 'Worst Casino', 'casino' ),
		'add_new'            => _x( 'Add New Worst Casino', 'casino', 'casino' ),
		'add_new_item'       => __( 'Add New Worst Casino', 'casino' ),
		'edit_item'          => __( 'Edit Worst Casino', 'casino' ),
		'new_item'           => __( 'New Worst Casino', 'casino' ),
		'view_item'          => __( 'View Worst Casino', 'casino' ),
		'search_items'       => __( 'Search Worst Casino', 'casino' ),
		'not_found'          => __( 'No Worst Casino found', 'casino' ),
		'not_found_in_trash' => __( 'No Worst Casino found in Trash', 'casino' ),
		'parent_item_colon'  => __( 'Parent Worst Casino:', 'casino' ),
		'menu_name'          => __( 'Worst Casino', 'casino' ),
	);
	
	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array( 
			'casino-types', 
			'payment-methods', 
			'currencies', 
			'minimum-deposit', 
			'casino-games',
			'casino-softwares',
			'licenses',
		),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-vault',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'custom-fields',
		),
		'rewrite'             => array(
			'slug' => 'worst-casinos',
			'with_front' => false
		),
);

	register_post_type( 'worst-casinos', $args );
}


// Register Casino Bonuses post type
add_action( 'init', 'casino_bonuses' );
function casino_bonuses() {

	$labels = array(
		'name'               => __( 'Casino Bonuses', 'casino' ),
		'singular_name'      => __( 'Casino Bonuses', 'casino' ),
		'add_new'            => _x( 'Add New Casino Bonuses', 'casino', 'casino' ),
		'add_new_item'       => __( 'Add New Casino Bonuses', 'casino' ),
		'edit_item'          => __( 'Edit Casino Bonuses', 'casino' ),
		'new_item'           => __( 'New Casino Bonuses', 'casino' ),
		'view_item'          => __( 'View Casino Bonuses', 'casino' ),
		'search_items'       => __( 'Search Casino Bonuses', 'casino' ),
		'not_found'          => __( 'No Casino Bonuses found', 'casino' ),
		'not_found_in_trash' => __( 'No Casino Bonuses found in Trash', 'casino' ),
		'parent_item_colon'  => __( 'Parent Casino Bonuses:', 'casino' ),
		'menu_name'          => __( 'Casino Bonuses', 'casino' ),
	);
	
	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-list-view',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'custom-fields',
		),
		'rewrite'             => array(
			'slug' => 'best-casino-bonuses',
			'with_front' => false
		),
);

	register_post_type( 'casino-bonuses', $args );
}


function register_subscribe() {

	$labels = array(
		'name'               => __( 'Subscribe', 'casino' ),
		'singular_name'      => __( 'Subscribe', 'casino' ),
		'add_new'            => _x( 'Add New Subscribe', 'casino', 'casino' ),
		'add_new_item'       => __( 'Add New Subscribe', 'casino' ),
		'edit_item'          => __( 'Edit Subscribe', 'casino' ),
		'new_item'           => __( 'New Subscribe', 'casino' ),
		'view_item'          => __( 'View Subscribe', 'casino' ),
		'search_items'       => __( 'Search Subscribe', 'casino' ),
		'not_found'          => __( 'No Subscribe found', 'casino' ),
		'not_found_in_trash' => __( 'No Subscribe found in Trash', 'casino' ),
		'parent_item_colon'  => __( 'Parent Subscribe:', 'casino' ),
		'menu_name'          => __( 'Subscribe', 'casino' ),
	);
	
	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-email-alt',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => false,
		'capability_type'     => 'post',
		'supports'            => array(
			'title'
	),
);

	register_post_type( 'subscribe', $args );
}

add_action( 'init', 'register_subscribe' );


function register_custom_tables() {

	$labels = array(
		'name'               => __( 'Сustom Tables', 'casino' ),
		'singular_name'      => __( 'Сustom Tables', 'casino' ),
		'add_new'            => _x( 'Add New Сustom Tables', 'casino', 'casino' ),
		'add_new_item'       => __( 'Add New Сustom Tables', 'casino' ),
		'edit_item'          => __( 'Edit Сustom Tables', 'casino' ),
		'new_item'           => __( 'New Сustom Tables', 'casino' ),
		'view_item'          => __( 'View Сustom Tables', 'casino' ),
		'search_items'       => __( 'Search Сustom Tables', 'casino' ),
		'not_found'          => __( 'No Сustom Tables found', 'casino' ),
		'not_found_in_trash' => __( 'No Сustom Tables found in Trash', 'casino' ),
		'parent_item_colon'  => __( 'Parent Сustom Tables:', 'casino' ),
		'menu_name'          => __( 'Сustom Tables', 'casino' ),
	);
	
	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-editor-ol',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => false,
		'capability_type'     => 'post',
		'supports'            => array(
			'title'
		),
	);

	register_post_type( 'custom_tables', $args );
}

add_action( 'init', 'register_custom_tables' );


// Register author post type
add_action( 'init', 'refister_author' );
function refister_author() {

	$labels = array(
		'name'               => __( 'Authors', 'casino' ),
		'singular_name'      => __( 'Author', 'casino' ),
		'add_new'            => _x( 'Add New Author', 'casino', 'casino' ),
		'add_new_item'       => __( 'Add New Author', 'casino' ),
		'edit_item'          => __( 'Edit Author', 'casino' ),
		'new_item'           => __( 'New Author', 'casino' ),
		'view_item'          => __( 'View Author', 'casino' ),
		'search_items'       => __( 'Search Authors', 'casino' ),
		'not_found'          => __( 'No Author found', 'casino' ),
		'not_found_in_trash' => __( 'No Author found in Trash', 'casino' ),
		'parent_item_colon'  => __( 'Parent Author:', 'casino' ),
		'menu_name'          => __( 'Authors', 'casino' ),
	);
	
	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-admin-users',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'custom-fields',
		),
		'rewrite'             => array(
			'slug' => 'authors',
			'with_front' => false
		),
);

	register_post_type( 'authors', $args );
}



// Registers post type Blog
function register_blog() {

	$labels = array(
		'name'               => __( 'Blog', 'casino' ),
		'singular_name'      => __( 'Blog', 'casino' ),
		'add_new'            => _x( 'Add New Page', 'casino', 'casino' ),
		'add_new_item'       => __( 'Add New Page', 'casino' ),
		'edit_item'          => __( 'Edit Page', 'casino' ),
		'new_item'           => __( 'New Page', 'casino' ),
		'view_item'          => __( 'View Page', 'casino' ),
		'search_items'       => __( 'Search Page', 'casino' ),
		'not_found'          => __( 'No Page found', 'casino' ),
		'not_found_in_trash' => __( 'No Page found in Trash', 'casino' ),
		'parent_item_colon'  => __( 'Parent Page:', 'casino' ),
		'menu_name'          => __( 'Blog', 'casino' ),
	);
	
	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-welcome-write-blog',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'page-attributes',
	),
);

	register_post_type( 'blog', $args );
}

add_action( 'init', 'register_blog' );