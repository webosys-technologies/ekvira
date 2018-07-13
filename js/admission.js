// JavaScript Document

//WEB CAM CODE
//START


//END
		
		function AddressCopy(f) {
		  if(f.sameasabove.checked == true) {
			f.p_address.value = f.c_address.value;
			//f.billingcity.value = f.shippingcity.value;
		  }else
		  {
			 f.p_address.value = ''; 
		  }
		}


        function addRow(tableID) {
 
            var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
 
            var colCount = table.rows[0].cells.length;
 
            for(var i=0; i<colCount; i++) {
 
                var newcell = row.insertCell(i);
 
                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
               switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            } 
        }
 
        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
 
 
            }
            }catch(e) {
                alert(e);
            }
        }
 
function changedoclist(prov_id) {		
		//alert(cs_id);
		var strURL="../brand/fetch-group.php?cs_id="+cs_id;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('group').innerHTML=req.responseText;	
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}
			$("#changeGroup").fadeOut('slow');
			req.open("GET", strURL, true);
			req.send(null);
			$("#changeGroup").fadeIn('slow');
		}		
	}


