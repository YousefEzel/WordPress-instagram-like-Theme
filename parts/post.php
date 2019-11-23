<?php /*--  WP-PHP CODE  --*/

$user_name = get_the_author();
$user_img = get_avatar_url( get_the_author_meta('ID') );
$user_href = get_author_posts_url( get_the_author_meta( 'ID' ) );

?>
<!-- HTML CODE -->
<div class="post mt-5 post-<?php echo(the_ID()); ?>">
	<div class="col m-2 post-header">
		<div class="row header-row" style="">
			<div class="col-img" style=" " >
				<a href="<?php echo esc_url( $user_href ); ?>" title="<?php echo esc_attr( $user_name ); ?>" >
					<img class="user-img circle-img" width="45" height="45" src="<?php echo $user_img; ?>" srcset="<?php echo $user_img; ?>" />
				</a>
			</div>
			<div class="col mx-2" style="display: flex;">
				<div class="row user-name">
					<a class="py-2 a-username" href="<?php echo esc_url( $user_href ); ?>" title="<?php echo esc_attr( $user_name ); ?>"><?php the_author(); ?>
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