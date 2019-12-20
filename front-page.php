<?php get_header(); query_posts(array('post_type' => array('post' , 'insta_post')));  ?>
<?php /*--  WP-PHP CODE  --*/
global $post;
$curr_user = wp_get_current_user();
$user_name = get_the_author();
$user_img = get_avatar_url( $curr_user->ID );
$user_href = get_author_posts_url( get_the_author_meta( 'ID' ) );

?>
 

<!-- /* all Post types will be shown here */ -->
<div class="container Explorer ">
	<div class="row ">
		<div class="col-1"></div>
		<div class="col-7 posts">
			
			<?php get_template_part( '/parts/content' ); ?>
			
		</div>
		<div class="col-4 mt-5 no-sd">
			<!-- HTML CODE -->
			<?php if ( 0 != $curr_user->ID ): 

				//get_template_part( '/parts/widget-right' , null );


			endif; ?>
		</div>
		
		
	</div>
</div>

<?php get_footer();
