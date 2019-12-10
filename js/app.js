$(document).ready(function() {
    $('[title="Explorer"] span.text-link').replaceWith('<i class="far fa-compass fa-size"></i>');
    $('[title="Activities"] span.text-link').replaceWith('<i class="far fa-heart fa-size"></i>');
    $('[title="Profile"] span.text-link').replaceWith('<i class="far fa-user fa-size"></i>');

    var content = document.getElementsByClassName("content");
    content.forEach(function(elem) {

        elem.children.forEach(function(child) {
            (child.nodeName == "FIGURE") ? false: child.classList.add("px-2");

        }), this
    }, this);

    /* remove br  */
    var btns = document.getElementsByClassName('rm-br');
    var br = document.getElementsByTagName('BR');
    btns.forEach((btn) => {
        btn.children.forEach((e) => {
            (e.nodeName == "BR") ? e.remove(): false;
        })
    }, this);

        // $('button._like').click(function() {
        //     if(this.style.backgroundPosition != '0px -324px'){
        //         this.style.backgroundPosition = '0px -324px';
        //     }else {
        //         this.style.backgroundPosition = '-26px -324px';
        //         var lk_btn = document.getElementsByClassName("lks");    

        //         lk_btn.forEach((btn)=>{
        //             var c_btn = btn.classList;
        //             c_btn.forEach((c)=>{
        //                 if(c == 'id-'+id){
        //                     var b =parseInt(btn.innerText);
        //                     btn.innerHTML = (b + 1);
        //                     var bp1 = parseInt(btn.innerText);
        //                     (bp1 > 1) ? btn.nextSibling.innerHTML = ' Likes' : ' Like';
                            
        //                 }
        //             })
                    
        //             //console.log(btn);
        //         },this);//--/ Stop
        //     }
            
            
        // });

    document.getElementsByClassName('bold').forEach((bold) => {
        bold.style.fontWeight = "600";
    }, this);

    
});
