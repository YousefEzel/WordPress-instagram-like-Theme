<?php 
if (have_posts()) : 
	
	while (have_posts()): the_post();

		require ('post.php');?>
	<!-- <div class="post post-<?php echo(the_ID()); ?>">
		<div class="col post-header">
			<div class="row">
				<div class="col-1">img</div>
				<div class="col">
					<h2>User Name</h2>
				</div>
			</div>
		</div>
		<div class="col post-content">
			<div class="content">
				<?php the_content(); ?>
			</div>
		</div>
		<div class="col post-footer">
			<div class="row">
				<?php  ?>
			</div>
		</div>
	</div> -->

<?php
	endwhile;
endif;
 