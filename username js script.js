function replace(a_elem, a_user) {
	var elem = document.getElementsByTagName("FIGURE");

	for(i = 0; i < elem.length; i++){
	    if(elem[i].lastChild.tagName != "FIGCAPTION"){
	        $('<figcaption>'+ a_elem + '<span class="user_name"> ' + a_user + '</span></a></figcaption>').appendTo(elem[i]);
	        console.log(elem[i].lastChild);
	    }
	}
}