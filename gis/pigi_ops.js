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
  Pigi Ripansis
**********************/
  
/*********
  New Pigi
	*********/
function new_pigi(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('NewPigiDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="pigi_ops.php";
	url1=url1+"?new_pigi="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  Edit Pigis
*********/
function edit_pigi(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditPigiDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="pigi_ops.php";
	url1=url1+"?edit_pigi="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/**********
  Delete Pigi
**********/
function del_pigi (str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditPigiDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="pigi_ops.php";
	url1=url1+"?del_pigi="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  View Pigi
*********/
function view_pigi() {
	var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('ViewPigiDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
	var url1="pigi_ops.php";
	url1=url1+"?view_pigi=1";
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}