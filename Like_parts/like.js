
$(function () {
	
		

	$("#_like").click(function(event){
		event.preventDefault();
		var Form = document.getElementsByClassName('LikeForm');
		var like = document.getElementsByClassName('_like');
 
		$.ajax({
			type: "POST",
			url: "like.php",
			data: $('LikeForm').serialize(),
			cache: false,
			success: function (response) {
				document.getElementsByClassName("lks").innerHTML = response;
			}

		})
	})


});