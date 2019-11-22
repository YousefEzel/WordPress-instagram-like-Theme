<div class="post mt-5 post-<?php echo(the_ID()); ?>">
	<div class="col m-2 post-header">
		<div class="row" style="display: inline-flex;flex-flow: row;max-width: 100%;flex-direction: row;flex-flow: row;">
			<div class="col-1" style=" padding: 2px; margin: 0;display: flex;max-inline-size: inherit;" >
				<img class="user-img circle-img" width="45" height="45" src="<?php echo get_avatar_url( get_the_author_meta('ID')); ?>" srcset="<?php echo get_avatar_url( get_the_author() ); ?>" >
			</div>
			<div class="col mx-2" style="display: flex;">
				<div class="row">
					<a class="py-2" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>"><?php the_author(); ?>
					</a>
				</div>
				
			</div>
		</div>
	</div>
	<div class="col px-0 mx-0 post-content">
		<div class="content">
			<?php the_content(); ?>
		</div>
	</div>
	<div class="col post-footer">
		<div class="row">
			<?php  ?>
		</div>
	</div>
</div>


