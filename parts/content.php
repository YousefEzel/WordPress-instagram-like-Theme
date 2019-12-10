<?php 
if (have_posts()) : 
	global $post; ?>

<script type="text/javascript">
function fetch(id) {
	
    $.post("<?php echo admin_url( 'admin-ajax.php' ); ?>", 
    	{ // Actions should be sent from here !
        "action": "my_action",
        "post_id": id,
        "increment": 1
    }).done(function(response) {
    	//console.log(response);

		var btt = document.getElementsByClassName('like-' + id); // Till Now everything seems great; Tommorow db stuff
		btt.forEach((e)=>{
            if(e.style.backgroundPosition != '0px -324px'){
                e.style.backgroundPosition = '0px -324px';// return red
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
                    
                    //console.log(btn);
                },this);//--/ Stop
            }else {
                e.style.backgroundPosition = '-26px -324px';// return white
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
                    
                    //console.log(btn);
                },this);//--/ Stop
            }
            
            
         });



/*
    	$('button._like').click(function() {
    	var btt = document.getElementsByClassName('button._like');
		btt.forEach((e)=>{
			if(e.style.backgroundPosition != '0px -324px'){
		        e.style.backgroundPosition = '0px -324px'; // return red
		    }else {
		        e.style.backgroundPosition = '-26px -324px'; // return white
		        var lk_btn = document.getElementsByClassName("lks");    

		        lk_btn.forEach((btn)=>{
		            var c_btn = btn.classList;
		            c_btn.forEach((c)=>{
		                if(c == 'id-'+id){
		                    var b =parseInt(btn.innerText);
		                    btn.innerHTML = (b - 1);
		                    var bp1 = parseInt(btn.innerText);
		                    (bp1 >= 2) ? btn.nextSibling.innerHTML = ' Likes' : ' Like';
		                    
		                }
		            })
		            
		            //console.log(btn);
		        },this);//--/ Stop
		    }
		});
    	var lk_btn = document.getElementsByClassName("lks");	

		lk_btn.forEach((btn)=>{
			var c_btn = btn.classList;
		    c_btn.forEach((c)=>{
		    	if(c == 'id-'+id){
		            var b =parseInt(btn.innerText);
		            btn.innerHTML = (b + 1);
		            var bp1 = parseInt(btn.innerText);
					(bp1 > 1) ? btn.nextSibling.innerHTML = ' Likes' : ' Like';
         			
		        }
		    })
		    
		    //console.log(btn);
		},this);//--/ Stop
	});*/


	//------*----
	});
}
</script>

	<?php
	while (have_posts()): the_post();

		require ('post.php');

	endwhile;
endif;
 