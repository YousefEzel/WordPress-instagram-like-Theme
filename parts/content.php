<?php 
if (have_posts()) : 
	
	while (have_posts()): the_post();

		require ('post.php');

	endwhile;
endif;
 