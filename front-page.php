<?php get_header(); query_posts(array('post_type' => array('post' , 'insta_post'),));  ?>
<!-- /* all Post types will be shown here */ -->
<div class="container Explorer ">
	<div class="row ">
		<div class="col-1"></div>
		<div class="col-7 posts">
			
			<?php get_template_part( '/parts/content' ); ?>
			
		</div>
		<div class="col-3 no-sd"></div>
		<div class="col-1 no-sd"></div>
	</div>
</div>

<?php get_footer();
