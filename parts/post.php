<?php /*--  WP-PHP CODE  --*/
global $post;
$user_name = get_the_author();
$user_img = get_avatar_url( get_the_author_meta('ID') );
$user_href = get_author_posts_url( get_the_author_meta( 'ID' ) );
$curr = wp_get_current_user();

$comm = get_comment_count( $post->ID ); 
$a_href = '<a class="a-username pr-2 i-' . $post->ID . '" href="';
$main_content  = esc_url( $user_href ) . '" title="'. esc_attr( $user_name ) . '"><span class="user_name">' . esc_attr( $user_name ) . '';
$a_after = '</span></a>';
$fullName = $a_href . $main_content . $a_after;
?>



<!-- HTML CODE -->
<div class="post mt-5 post-<?php echo(the_ID()); ?>">
	<div class="col m-2 post-header">
		<div class="row header-row" style="">
			<div class="col-img" style="" >
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
		<div class="content <?php echo ($post->post_type == 'post') ? 'my-3' : '' ?> content-<?php echo the_ID(); ?>">

			<?php the_content(); ?>
			<div id="receiver-<?php echo the_ID(); ?>"></div>
		</div>
	</div>
	<div class="col post-footer" style="<?php echo ($comm['approved'] > 0) ? 'border-top: 1px solid #e6e6e6;' : ''; ?>"> 
		<div class="row">
			<div class="col mx-3">
				<div class="row header-row" id="comment-append-<?php echo the_ID(); ?>" style="">
				
					<?php 
					$s_span = '<span class="comment_text" style="line-height: 18px;">';
					$comment_array = get_approved_comments($post->ID);
			   		foreach($comment_array as $comment): ?>
				
						<div class="full-comment comment-<?php echo $comment->comment_ID ?>">
					
					    	<?php	echo $fullName . $s_span . $comment->comment_content . "</span><br>"; ?>

						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="row c_inputs">
			<div class="col m-2">
				<div class="row footer-row" style="">
					<input type="input" name="comment" id="<?php echo(the_ID()); ?>" placeholder="Add a comment" 
						class="c_input comment-<?php echo(the_ID()); ?>" 
						onKeyPress="btn_event('btn-<?php echo the_ID(); ?>')" 
						onpaste="btn_event('btn-<?php echo the_ID(); ?>')"
						>

					<button type="submit" class="c_btn" id="btn-<?php echo the_ID(); ?>" 

						onclick="add__comment( <?php echo $post->ID; ?> )" disabled> Publish </button>

				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	
	function btn_event(id){
		document.getElementById(id).disabled=false;
		$('#'+id).css({'color':'rgb(57, 152, 242)','opacity': 1});

	}



<?php if ($post->post_type  == 'insta_post'): ?>
	var content = document.querySelectorAll('.content-<?php echo $post->ID; ?>');
	var parent = document.getElementById('like_container_<?php echo $post->ID; ?>');
	var receiver = document.getElementById('receiver-<?php echo $post->ID; ?>');
	$('.b-line.i-<?php echo $post->ID; ?>').hide();
	receiver.append(parent);
	
	var receiver = document.getElementById('receiver-<?php echo $post->ID; ?>');
	content.forEach((item)=>{
		item.children.forEach(child =>{
	        if(child.nodeName != 'FIGURE' && child.id != 'receiver-<?php echo $post->ID; ?>'){
	        //console.log(child)
	        receiver.after(child);
	        }else if (child.nodeName == 'FIGURE'){
                //console.log(child)
                child.children.forEach((element)=>{
                    if (element.nodeName == 'FIGCAPTION'){
                		//console.log(element)
                        receiver.after(element);
                	}
                },this);
            }
	    })
	},this);
<?php endif; ?>

	function add__comment(id){
        var comment = document.getElementById(id).value;
        // if (comment == '' || comment == ' ') {
        //     return;
        // }
        $.post("<?php echo admin_url( 'admin-ajax.php' ); ?>", 
        { // Actions should be sent from here !
        "action": "add_comment",
        "post_id": id,
        "comment": comment
        }).done(function(response) 
        {
            console.log(comment);
            document.querySelector('#comment-append-<?php echo $post->ID; ?>').innerHTML += ('<div class="full-comment comment-<?php echo $comment->comment_ID ?>"><?php echo $fullName . $s_span; ?> ' + comment + '</span><br></div>');
            
        }).always(function() {
            document.getElementById(id).value = '';
        	
        	$('#btn-<?php echo the_ID(); ?>').attr("disabled", true);
        	$('#btn-<?php echo the_ID(); ?>').css({'opacity' : '.3'});

        });

    }
    
    	
	
</script>