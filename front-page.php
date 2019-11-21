<?php get_header();?>
<div class="container">


<?php 
// query_posts(array(
//    'post_type' => ('Insta Post') ? 'Insta Post' : 'Post',
// ));

if (have_posts()) : 
	while (have_posts()):the_post();

		the_content( );echo "front-paaaage";



	endwhile;
endif;

?>




</div>
<?php get_footer();
