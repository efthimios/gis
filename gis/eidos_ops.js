function getXMLHttp() {
  var xmlHttp;
  
  try { //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e) { //Internet Explorer
    try  {xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");}
    catch(e) {
      try {xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");}
      catch(e) {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}

/*********************
  Eidos Pigis Ripansis
**********************/
  
/*********
  New Eidos
*********/
function new_eidos(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('NewEidosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="eidos_ops.php";
	url1=url1+"?new_eidos="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  Edit Eidos
*********/
function edit_eidos(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditEidosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="eidos_ops.php";
	url1=url1+"?edit_eidos="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/**********
  Delete Eidos
**********/
function del_eidos (str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditEidosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="eidos_ops.php";
	url1=url1+"?del_eidos="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  View Eidos
*********/
function view_eidos() {
	var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('ViewEidosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
	var url1="eidos_ops.php";
	url1=url1+"?view_eidos=1";
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}