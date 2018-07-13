dropdown = function(eid) {
	var result = document.getElementById(eid).selectedIndex;
	if(result == 0) { 
		document.getElementById(eid).style.border  = "1px solid #ff0000";
		//document.getElementById(eid).style.backgroundColor  = "#ff0000";
		return false;
	}
	else {
		document.getElementById(eid).style.border  = "1px solid #E5E5E5";
		//document.getElementById(eid).style.backgroundColor="#FFFFFF";
		return true;  
	}
}
