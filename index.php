<?php get_header();?>
<div class="container">


<?php 
query_posts(array(
   'post_type' => ('insta_post') ? 'insta_post' : 'Post',
));

if (have_posts()) : 
	while (have_posts()):the_post();

		the_content( );echo "indesxxxx";



	endwhile;
endif;

?>




</div>
<?php get_footer();


