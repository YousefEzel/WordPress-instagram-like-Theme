$(function() {



    $("#_like").click(function(event) {
        event.preventDefault();
        var Form = document.getElementsByClassName('LikeForm');
        var like = document.getElementsByClassName('_like');

        $.ajax({
            type: "POST",
            url: "like.php",
            data: $('LikeForm').serialize(),
            cache: false,
            success: function(response) {
                document.getElementsByClassName("lks").innerHTML = response;
            }

        })
    })


});

function fetch() {
    $.post("'.admin_url( "
        admin - ajax.php " ).'", {
            "action": "my_action",
            "post_id": '. $post->ID .',
            "increment": 1
        }
    ).done(function(response) {
        document.getElementsByClassName("like_number").innerHTML = response;
        console.log(response);
    });
}