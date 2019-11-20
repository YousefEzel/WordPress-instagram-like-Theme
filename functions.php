<?php 

/**
 * Enqueue scripts
 *
 * @param string $handle Script name
 * @param string $src Script url
 * @param array $deps (optional) Array of script names on which this script depends
 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
 */
function insta_scripts_register() {
	//<!-- Bootstrap Grid CSS -->
	wp_enqueue_style( 'bootstrap-grid', get_template_directory_uri().'/bootstrap-4.3.1/css/bootstrap-grid.css' );
	wp_enqueue_style( 'bootstrap-grid.min', get_template_directory_uri().'/bootstrap-4.3.1/css/bootstrap-grid.min.css' );


	//-- MAIN STYLE -- STYLE.CSS --
	wp_enqueue_style( 'Main-Style', get_stylesheet_uri());
	//<!-- Font Awesome -->
	wp_enqueue_style( 'fontawesome-all', 'https://use.fontawesome.com/releases/v5.11.2/css/all.css');
	//<!-- Bootstrap core CSS -->
	wp_enqueue_style( 'mdb.min', get_template_directory_uri(). '/css/bootstrap.min.css');
	//<!-- Material Design Bootstrap -->
	wp_enqueue_style( 'bootstrap-grid', get_template_directory_uri()."/css/mdb.min.css");
	
	//-- JAVA SCRIPT's FILES 

	//<!-- jQuery -->
	wp_enqueue_script( 'jquery.min', get_template_directory_uri()."/js/jquery.min.js");
	//<!-- Bootstrap tooltips -->
	wp_enqueue_script( 'popper.min', get_template_directory_uri()."/js/popper.min.js");
	//<!-- Bootstrap core JavaScript -->
	wp_enqueue_script( 'bootstrap.min', get_template_directory_uri()."/js/bootstrap.min.js");
	//<!-- MDB core JavaScript -->
	wp_enqueue_script( 'mdb.min', get_template_directory_uri()."/js/mdb.min.js");
	wp_enqueue_script( 'App', get_template_directory_uri()."/js/app.js");

}
add_action( 'wp_enqueue_scripts', 'insta_scripts_register' );


function insta_init_register()
{
	/**
 	* Creates a Menu
 	* @param string|array  Builds Menu based of 'name' and 'location' values.
 	*/
	$args = array(
		'name'          => __( 'Primary Menu', 'text-domain' ),
		//'theme_location'		=> 'Primary',
	);
   register_nav_menus( $args );

}
add_action( 'init', 'insta_init_register' );

function insta_custom_logo_setup() {
	$defaults = array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'wp-insta', 'Just a Site for fun' ),
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'insta_custom_logo_setup' );



