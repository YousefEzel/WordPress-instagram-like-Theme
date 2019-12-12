<?php 
if (have_posts()) : 
	global $post; ?>

<script type="text/javascript">

function fetch(id) {
	
    $.post("<?php echo admin_url( 'admin-ajax.php' ); ?>", 
    	{ // Actions should be sent from here !
        "action": "my_action",
        "post_id": id
       
    }).done(function(response) {
    	
    	pid = id;
		var btt = document.getElementsByClassName('like-' + id); 
		btt.forEach((e)=>{
            if(e.style.backgroundPosition != '0px -324px'){
                e.style.backgroundPosition = '0px -324px';// return red <3
                var lk_btn = document.getElementsByClassName("lks");

                lk_btn.forEach((btn)=>{
                    var c_btn = btn.classList;
                    c_btn.forEach((c)=>{
                        if(c == 'id-' + id){
                            var b =parseInt(btn.innerText);
                            btn.innerHTML = (b + 1);
                            var bp1 = parseInt(btn.innerText);
                            (bp1 > 1) ? btn.nextSibling.innerHTML = ' Likes' : ' Like';
                            
                        }
                    })
                    
                }, this);//--/ Stop
            }else {
                e.style.backgroundPosition = '-26px -324px';// return white <3
                var lk_btn = document.getElementsByClassName("lks");    

                lk_btn.forEach((btn)=>{
                    var c_btn = btn.classList;
                    c_btn.forEach((c)=>{
                        if(c == 'id-' + id){
                            var b =parseInt(btn.innerText);
                            btn.innerHTML = (b - 1);
                            var bp1 = parseInt(btn.innerText);
                            (bp1 >= 2) ? btn.nextSibling.innerHTML = ' Likes' : ' Like';
                            
                        }
                    })
                    
                }, this);//--/ Stop
            }
            
            
         });

	//------ * ----
	});
}

function fet_ch(pid, uid) {

	$.post("<?php echo admin_url( 'admin-ajax.php' ); ?>", 
    	{ // Actions should be sent from here !
        "action"  : "get_liked_red",
        "curr_uid": uid,
        "post_id" : pid
    }).done(function(response) {
    	
	    var btt = document.getElementsByClassName('like-' + pid); 
	    if (response != false || response != 0) {
			btt.forEach((e)=>{
		        if(e.style.backgroundPosition != '0px -324px'){
		            e.style.backgroundPosition = '0px -324px';// return red <3
		            
		    	}
			}, this);
		}
		//console.log(response);
	});
}

</script>

	<?php $current_user = wp_get_current_user();
	while (have_posts()): the_post(); ?> 

		<script type="text/javascript">fet_ch(<?php echo $post->ID ?> , <?php echo $current_user->ID ?> );</script>  
		
		<?php require ('post.php');

	endwhile;
endif;
 