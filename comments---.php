<?php
	function getClientIP()
	{
	    $ipaddress = 'UNKNOWN';
	    $keys=array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR');
	    foreach($keys as $k)
	    {
	        if (isset($_SERVER[$k]) && !empty($_SERVER[$k]) && filter_var($_SERVER[$k], FILTER_VALIDATE_IP))
	        {
	            $ipaddress = $_SERVER[$k];
	            break;
	        }
	    }
	    return $ipaddress;
	}



	function add_comment()
	{

		$ip = getClientIP();
		global $post, $wpdb;
		$current_user = wp_get_current_user();

		$comment_author       = $current_user->display_name;
	    $comment_author_email = $current_user->user_email;
	    $comment_author_url   = get_author_posts_url( $current_user->ID );
	    $comment_author_IP    = $ip;
	    $comment_date    	  = current_time( 'mysql' );
	    $comment_date_gmt	  = get_gmt_from_date( $comment_date );
	    $comment_post_ID 	  = $post->ID;
	    $comment_content 	  = '';
	    $comment_karma   	  = 0 ;
	    $comment_approved	  = 1 ;
	    $comment_agent   	  = $_SERVER['HTTP_USER_AGENT'];
	    $comment_type    	  = '';
	    $comment_parent  	  = 0 ;
	    $user_id 		 	  = $current_user->ID;

	    $compacted = compact( 'comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_author_IP', 'comment_date', 'comment_date_gmt', 'comment_content', 'comment_karma', 'comment_approved', 'comment_agent', 'comment_type', 'comment_parent', 'user_id' );
	    
	    if ( ! $wpdb->insert( $wpdb->comments, $compacted ) ) {
	        return false;
	    }
 	}