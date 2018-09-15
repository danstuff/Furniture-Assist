var open = document.getElementsByClassName("open")[0];

open.innerHTML = "Furniture Assist is currently ";

var date = new Date();
var day = date.getDay();
var hour = date.getHours();
var minute = date.getMinutes();

if(day == 0 && hour >= 9 && hour < 12){
	open.innerHTML += "<font color=\"green\">open to clients</font>."
}else if(day == 0 && hour >= 12){
	if(hour >= 14 && minute >= 30){
		open.innerHTML += "<font color=\"red\">closed</font>."
	}else{
		open.innerHTML += "<font color=\"green\">open for donations</font>."
	}
}else{
	open.innerHTML += "<font color=\"red\">closed</font>."
}