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
	//-- Footer STYLE -- Likes.CSS --
	wp_enqueue_style( 'Likes-Style', get_template_directory_uri() . '/Like.css');
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

/**
* Edit/Filter the_content 
* @param string|content 
*/


//-----------------------------------------------------------------------------------------------------------------
//------------------------------------------I am-------------------------------------------------------------------
//-----------------------------------------------The Best----------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------
function insta_content($content)
{

	global $post;
	global $wpdb;

	$lk = 0;

	$retreive_query = $wpdb->prepare("SELECT a.likes_count, a.likes_post_ID, a.likes_author, a.likes_author_url FROM wp_likes a INNER JOIN wp_posts b ON a.likes_post_ID =b.ID AND b.post_type='insta_post' and b.ID =%s", $post->ID);

 	$like_count = $wpdb->get_results($retreive_query);

	if ($like_count) {
		foreach ($like_count as $like) {
			$lk += $like->likes_count;

		}
		
	}
	$Like_btn = '
	<hr>
	<div class="rm-br likes"> 
		<button class="lk _like like-' . $post->ID . '" id="like-' . $post->ID . '" onclick="fetch('.  $post->ID .')"></button>
		<button class="lk _comment"></button>
		<!--<button class="lk _share"></button>-->
	</div>
	
	<div class="rm-br likes_number">
		<div class="bold lik  like_number">
			<span class="lks id-' . $post->ID . '">'. $lk .'</span><span class="id-' . $post->ID . '"> Like</span>
		</div>
	</div>';

	if ($post->post_type == 'insta_post'):
		$user_name = get_the_author();
		$user_href = get_author_posts_url( get_the_author_meta( 'ID' ) );

		$before_fullcode = $Like_btn;
		$a_href = '<a class="py-2 pr-2 a-username" href="';
		$main_content  = esc_url( $user_href ) . '" title="'. esc_attr( $user_name ) . '"><span class="user_name">' . esc_attr( $user_name ) . '';
		$a_after = '</span></a>';
		$full_code = $a_href . $main_content . $a_after;

		// Remove unwanted HTML comments
		$content = preg_replace('/<!--(.|\s)*?-->/', '', $content);

		$fig = strpos($content, "<figcaption>");
		if( $fig > 0)
			$pos = $fig +  strlen("<figcaption>"); 
		else {
			$pos = strpos($content, "</figure>") + strlen("</figure>");
		}

		$content = substr_replace($content, $before_fullcode . $full_code, $pos, 0 ); // replace(append) in pos1
		$content = preg_replace("/<p[^>]*>[\s|&nbsp;]*<\/p>/", '', $content);

		return $content;
	endif;
	
	return $content;
}

add_filter( 'the_content', 'insta_content', 6 , 1 ); 
// -- Just a function to add two %d 
function sum($x,$y){
	return $x += $y;
}

function data_retreive()
{
	global $post;
	global $wpdb;

	$id = intval($_POST['post_id']);
	$in = intval($_POST['increment']);

	$retreive_query = $wpdb->prepare("SELECT a.likes_count, a.likes_post_ID, a.likes_author, a.likes_author_url FROM wp_likes a INNER JOIN wp_posts b ON a.likes_post_ID =b.ID AND b.post_type='insta_post' and b.ID =%s", $id);

 	$like_count = $wpdb->get_results($retreive_query);

	if ($like_count) {
		foreach ($like_count as $like) {
			$lk += $like->likes_count;
			$authors .= $like->likes_author .', ';
			$authors_url .= $like->likes_author_url . ', ';

		}
		$lk += 1;
		//print_r($like_count);
	}else{
		$current_user = wp_get_current_user();

		$a_name = $current_user->display_name;
		$a_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		$a_email = $current_user->user_email;
		$a_ID = $current_user->ID;

		$data = array(
			'likes_ID' => null, 
			'likes_post_ID' =>$id, 
			'likes_author' =>$a_name, 
			'likes_author_email' => $a_email, 
			'likes_author_url' => $a_url,
			'likes_count' =>  $in,
			'user_id' =>  $a_ID );

		$post_query = $wpdb->insert( 'wp_likes' , $data);
		if ($post_query) {
		 	//$lk += $in;
		} else {
			$lk = "Something went wrong!";
		}
		
	}

	$author = trim($authors , ', ');            // Authors: important.
	$author_url = trim($authors_url, ', ');		// Authors url: important.

	echo $lk;

	die();
}

add_action( "wp_ajax_my_action", 'data_retreive' );
add_action( "wp_ajax_nopriv_my_action", 'data_retreive' );
