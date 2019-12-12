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

});
