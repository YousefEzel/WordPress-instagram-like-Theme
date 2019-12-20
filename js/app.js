$(document).ready(function() {
    $('[title="Explorer"] span.text-link').replaceWith('<i class="far fa-compass fa-size"></i>');
    $('[title="Activities"] span.text-link').replaceWith('<i class="far fa-heart fa-size"></i>');
    $('[title="Profile"] span.text-link').replaceWith('<i class="far fa-user fa-size"></i>');

    var elem = document.querySelectorAll('P');
    elem.forEach((el)=>{
        if( el.innerHTML == "" || el.innerText == "" || el.textConetent == "" ){
            el.remove();
        }
    });
    var content = document.getElementsByClassName("content");
    //console.log(content);
    content.forEach(function(elem) {
        elem.children.forEach(function(child) {
            (child.nodeName == "FIGURE") ? false : child.classList.add("px-3");
        }), this
    }, this);

    document.getElementsByTagName('FIGCAPTION').forEach(function(el){
        el.classList.add("px-3");
    });

    var div_b_line = document.querySelectorAll("div.b-line");
    div_b_line.forEach( (elem)=>{
        
        
        if(elem.parentElement.nodeName == "FIGCAPTION"){
            //console.log(elem.parentElement);
            elem.parentElement.classList.add("bt");
            elem.classList.remove('b-line');
            elem.classList.remove('px-3');
        }
    });


    /* remove br  */
    var btns = document.getElementsByClassName('rm-br');
    var br = document.getElementsByTagName('BR');
    btns.forEach((btn) => {
        btn.children.forEach((e) => {
            (e.nodeName == "BR") ? e.remove(): false;
        })
    }, this);
    document.getElementsByClassName('bold').forEach((bold) => {
        bold.style.fontWeight = "600";
    }, this);

    var lk_btn = document.getElementsByClassName("lks");

        lk_btn.forEach((btn)=>{
            var c_btn = btn.classList;
            c_btn.forEach((c)=>{
                var bp1 = parseInt(btn.innerText);
                (bp1 > 1) ? btn.nextSibling.innerHTML = ' Likes' : ' Like';
            })
        }, this);

        $( window ).scroll(function() {
    
            if ($(this).scrollTop() > 0) {
                $( "nav.navbar" ).css({'position' : 'fixed', 'top' : 0 });
                $('.logo-img').hide();
                $('i.fa-instagram').css('border','none');
            } else {
                $( "nav.navbar" ).css( "position", "relative" );
                $('.logo-img').show();
                $('i.fa-instagram').css('border-right', '2px solid black');
            }
            
        });





    // for the last execute 
    setTimeout(function() {
        $('html').css({'display' : 'block', 'background' : 'none'});
        $('body').css({'display' : 'block'});
    }, 3000);
});

