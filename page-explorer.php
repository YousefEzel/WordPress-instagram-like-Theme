<?php

get_header();

// query_posts(array(
//    'post_type' => (get_post_type( the_ID()) == 'Post') ? 'Post' : 'insta_post',
// ));

if (have_posts()) : the_post();
	while (have_posts()):

		the_content( ); echo "pageeeeee";



	endwhile;
endif;



get_footer();