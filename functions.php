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
	$current_user = wp_get_current_user();

	$lk = 0;

	$retreive_query = $wpdb->prepare("SELECT a.likes_count, a.likes_post_ID, a.likes_author, a.likes_author_url FROM wp_likes a INNER JOIN wp_posts b ON a.likes_post_ID =b.ID AND b.post_type='insta_post' and b.ID =%s", $post->ID);

 	$like_count = $wpdb->get_results($retreive_query);

	if ($like_count) {
		foreach ($like_count as $like) {
			$lk += $like->likes_count;
		}
		
	}
	$Like_btn = '
	<div class="rm-br likes i-' . $post->ID . '"> 
		<button class="lk _like like-' . $post->ID . '" id="like-' . $post->ID . '"	onclick="fetch('.  $post->ID . ')"></button>
		<button class="lk _comment"></button>
		<!--<button class="lk _share"></button>-->
	</div>
	<div class="rm-br likes_number i-' . $post->ID . '">
		<div class="bold lik  like_number">
			<span class="lks id-' . $post->ID . '">'. $lk .'</span><span class="id-' . $post->ID . '"> Like</span>
		</div>
	</div>';
	( $current_user->ID == 0 ) ? $Like_btn='' : '';

	if ($post->post_type == 'insta_post' ):
		$user_name = get_the_author();
		$user_href = get_author_posts_url( get_the_author_meta( 'ID' ) );

		$before_fullcode = $Like_btn;
		$a_href = '<a class="py-2 pr-2 a-username i-' . $post->ID . '" href="';
		$main_content  = esc_url( $user_href ) . '" title="'. esc_attr( $user_name ) . '"><span class="user_name">' . esc_attr( $user_name ) . '';
		$a_after = '</span></a>';

		$full_code = '<div class="b-line i-' . $post->ID .'"></div>
		<div id="like_container_' . $post->ID . '" class="container-' . $post->ID . ' like-container">' . 
		$before_fullcode .$a_href . $main_content . $a_after . 
		'</div>';

		// Remove unwanted HTML comments
		$content = preg_replace('/<!--(.|\s)*?-->/', '', $content);

		$fig = strpos($content, "<figcaption>");
		
		if( $fig > 0){
			$pos = $fig + strlen("<figcaption>"); 
		}else {
			$pos = strpos($content, "</figure>") + strlen("</figure>");
		}
		
		$content = substr_replace($content,  $full_code, $pos, 0 ); // replace(append) in pos1
		$content = preg_replace("/<p[^>]*>[\s|&nbsp;]*<\/p>/", '', $content);

		return $content;
	endif;
	
	return $content;
}

add_filter( 'the_content', 'insta_content', 6 , 1 ); 

/**
* 
* data_retreive @param : null
* 
**/
function data_retreive()
{
	global $post;
	global $wpdb;
	$current_user = wp_get_current_user();
	$id = intval($_POST['post_id']);





	$retreive_query = $wpdb->prepare("SELECT a.likes_count, a.likes_post_ID, a.likes_author, a.likes_author_url, a.user_id FROM wp_likes a INNER JOIN wp_posts b ON a.likes_post_ID =b.ID AND b.post_type='insta_post' and b.ID =%s", $id);

 	$like_count = $wpdb->get_results($retreive_query);
 	$trv = true;
	if ($like_count) {
		foreach ($like_count as $like) {
			$lk += $like->likes_count;
			$authors .= $like->likes_author .', ';
			$authors_url .= $like->likes_author_url . ', ';
			$a_Id .= $like->user_id;
			if ($current_user->ID == $like->user_id and  $id == $like->likes_post_ID ) {
				$trv = true;
				$delete_data = array( 'likes_post_ID' => $id, 'user_id'=> $current_user->ID );
				$post_query = $wpdb->delete( 'wp_likes', $delete_data );
			} else {
				$trv = false;
			}
		}
		//print_r($like_count);
	}else{
		
		register_like_author($id);
		
	}

	if ($trv == false) {
		register_like_author($id);
	}

	$author = trim($authors , ', ');            // Authors: important.
	$author_url = trim($authors_url, ', ');		// Authors url: important.

	//print_r($post_query);

	die();
}

add_action( "wp_ajax_my_action", 'data_retreive' );
add_action( "wp_ajax_nopriv_my_action", 'data_retreive' );

/**
* 
* register_like_author @param : $post_id
* 
**/
function register_like_author($post_id)
{
	global $post;
	global $wpdb;
	$current_user = wp_get_current_user();

	$a_name = $current_user->display_name;
	$a_url = get_author_posts_url( $current_user->ID );
	$a_email = $current_user->user_email;
	$a_ID = $current_user->ID;

	$pid = $post_id;
	$usr_id = $a_ID;

	$retreive_query = $wpdb->prepare("SELECT a.likes_post_ID, a.user_id, b.ID, b.post_type FROM wp_likes a INNER JOIN wp_posts b ON a.likes_post_ID=b.ID AND b.post_type='insta_post' and b.ID =%s AND a.user_id=%s ", $pid, $usr_id);

 	$u_id = $wpdb->get_results($retreive_query);
 	
	if ($u_id) {
		foreach ($u_id as $id) {
			
			if ($id->user_id == $usr_id ) {
				$a_Id = $id->user_id;
			}
		}
	}
	
	$data = array(
		'likes_ID' => null, 
		'likes_post_ID' => $post_id, 
		'likes_author' => $a_name, 
		'likes_author_email' => $a_email, 
		'likes_author_url' => $a_url,
		'likes_count' => 1,
		'user_id' =>  $a_ID );

	//
	if ($a_Id) {

	} else {
		$post_query = $wpdb->insert( 'wp_likes' , $data);
	}
	
	
	if ($post_query) {
	 	__return_true();
	} else {
		__return_false();
	}

}

/**
*	get_liked_red @param none
*	return the user_id which will allow the other side of function to get the red heart (like btn) 
*/

add_action( "wp_ajax_get_liked_red", 'get_liked_red' );
add_action( "wp_ajax_nopriv_get_liked_red", 'get_liked_red' );

function get_liked_red()
{
	global $post;
	global $wpdb;


	$pid = intval($_POST['post_id']);
	$usr_id = intval($_POST['curr_uid']);

	$retreive_query = $wpdb->prepare("SELECT a.likes_post_ID, a.user_id, b.ID, b.post_type FROM wp_likes a INNER JOIN wp_posts b ON a.likes_post_ID=b.ID AND b.post_type='insta_post' and b.ID =%s AND a.user_id=%s ", $pid, $usr_id);

 	$u_id = $wpdb->get_results($retreive_query);
 	
	if ($u_id) {
		foreach ($u_id as $id) {
			
			if ($id->user_id == $usr_id ) {
				$a_Id = $id->user_id;
			}
		}
	}
	
	echo $a_Id;
	die();
}

/**
*
* get current local ip for the comment local ip address
*
*/

function getClientIP()
{
    $ipaddress = 'UNKNOWN';
    $keys = array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED',
    			  'HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR');
    foreach($keys as $key)
    {
        if (isset($_SERVER[$key]) && !empty($_SERVER[$key]) && filter_var($_SERVER[$key], FILTER_VALIDATE_IP))
        {
            $ipaddress = $_SERVER[$key];
            break;
        }
    }
    return $ipaddress;
}



add_action( "wp_ajax_add_comment", 'add_comment' );
add_action( "wp_ajax_nopriv_add_comment", 'add_comment' );


/**
* @param $post_id
* Add comments manually  
*
*/
function add_comment()
{
	$ip = getClientIP();
	global $post, $wpdb;
	$post_id = intval($_POST['post_id']);
	$comment = $_POST['comment'];

	$current_user = wp_get_current_user();

	$comment_author       = ($current_user->ID != 0) ? $current_user->display_name : 'Anonymous';
    $comment_author_email = ($current_user->ID != 0) ? $current_user->user_email : '';
    $comment_author_url   = ($current_user->ID != 0) ? get_author_posts_url( $current_user->ID ) : '';
    $comment_author_IP    = $ip;
    $comment_date    	  = current_time( 'mysql' );
    $comment_date_gmt	  = get_gmt_from_date( $comment_date );
    $comment_post_ID 	  = $post_id;
    $comment_content 	  = $comment;
    $comment_karma   	  = 0 ;
    $comment_approved	  = 1 ;
    $comment_agent   	  = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null ;
    $comment_type    	  = '';
    $comment_parent  	  = 0 ;
    $user_id 		 	  = $current_user->ID;

    $compacted = compact( 'comment_post_ID', 'comment_author', 
    	'comment_author_email', 'comment_author_url', 'comment_author_IP', 
    	'comment_date', 'comment_date_gmt', 'comment_content', 'comment_karma', 
    	'comment_approved', 'comment_agent', 'comment_type', 'comment_parent', 'user_id' );
    //$wpdb->insert( $wpdb->comments, $compacted )
    if ( wp_insert_comment($compacted) ) {
        $com = $comment;
    }else{
    	$com = ' Something went wrong ! ';
    }

    echo $com;
    die();
}