function _(id){
	return document.getElementById(id);
}
if ((_("banyakpending")) && (_("yangpending"))){
	ambilnotif();
}
function ambilnotif(){
	var ajax= new XMLHttpRequest();
	ajax.addEventListener("load", completeambilnotif, false);
	ajax.open("GET", "../../dist/js/ambilnotif.php");
	ajax.send();
	//alert("a");
	function completeambilnotif(event){
		var notif=event.target.responseText.split("|*-*|");
		//alert(notif[0]);
		if (notif[0]>=1){
		_("banyakpending").innerHTML=notif[0];}
		_("yangpending").innerHTML=notif[1];
	}
}