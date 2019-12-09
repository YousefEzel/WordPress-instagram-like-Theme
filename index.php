<?php get_header(); query_posts(array('post_type' => 'insta_post')); ?>

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

<?php get_footer(); ?>