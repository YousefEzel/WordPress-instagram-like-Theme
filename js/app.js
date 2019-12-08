$(document).ready(function() {
    $('[title="Explorer"] span.text-link').replaceWith('<i class="far fa-compass fa-size"></i>');
    $('[title="Activities"] span.text-link').replaceWith('<i class="far fa-heart fa-size"></i>');
    $('[title="Profile"] span.text-link').replaceWith('<i class="far fa-user fa-size"></i>');


    var content = document.getElementsByClassName("content");
    content.forEach(function(elem) {

        elem.children.forEach(function(child) {
            (child.nodeName == "FIGURE") ? false : child.classList.add("px-2");

        }), this
    }, this);

    /* remove br  */ 
    var btns = document.getElementsByClassName('rm-br');
    var br = document.getElementsByTagName('BR');
    btns.forEach( (btn) => {
        btn.children.forEach((e)=>{
            (e.nodeName == "BR") ? e.remove() : false;
        })
    },this);

    $('button._like').click(function() {
        this.style.backgroundPosition = '0px -324px';
    });
});

function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "like.php", true);
  xhttp.send();
}