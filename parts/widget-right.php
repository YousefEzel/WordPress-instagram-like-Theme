<?php /*--  WP-PHP CODE  --*/
global $post;
$user_name = get_the_author();
$user_img = get_avatar_url( get_the_author_meta('ID') );
$user_href = get_author_posts_url( get_the_author_meta( 'ID' ) );
$curr_user = wp_get_current_user();
?>
<div class="row">
	<div class="col m-2 post-header">
		<div class="row header-row" style="">
			<div class="col-img" style=" " >
				<a href="<?php echo esc_url( $user_href ); ?>" title="<?php echo esc_attr( $user_name ); ?>" >
					<img class="user-img circle-img" width="55" height="55" src="<?php echo $user_img; ?>" srcset="<?php echo $user_img; ?>" />
				</a>
			</div>
			<div class="col mx-2" style="display: flex;">
				<div class="row user-name">
					<a class="pt-2 a-username" href="<?php echo esc_url( $user_href ); ?>"
						title="<?php echo esc_attr( $user_name ); ?>"><?php echo $curr_user->display_name; ?>
					</a>
					<span class="pb-2 description"><?php echo $curr_user->description; ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="widget mt-1 post-<?php echo(the_ID()); ?>">
	<div class="row">
		<div class="col-12"> widget</div>
	</div>
</div>