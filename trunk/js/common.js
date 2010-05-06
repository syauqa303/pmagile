function printme(){
	leftmenu = document.getElementById("leftmenu");
	leftmenu.style.display="none";
	print();
	leftmenu.style.display="";
	//alert(leftmenu);
}

function ifr(ob)
{
	//document.getElementById(id).style.height = document.getElementById(id).contentWindow.document.body.offsetHeight + "px";
	ob.style.height = (ob.contentWindow.document.body.offsetHeight + 10) + "px";
}

function toggle(id)
{
	if(document.getElementById(id).style.display=="none")document.getElementById(id).style.display="";
	else document.getElementById(id).style.display="none";
}