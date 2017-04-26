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
  Paragogi Pigis
**********************/
  
/*********
  New Paragogi
*********/
function new_paragogi(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('NewParagogiDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="paragogi_ops.php";
	url1=url1+"?new_paragogi="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  Edit Paragogi
*********/
function edit_paragogi(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditParagogiDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="paragogi_ops.php";
	url1=url1+"?edit_paragogi="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/**********
  Delete Paragogi
**********/
function del_paragogi(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditParagogiDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="paragogi_ops.php";
	url1=url1+"?del_paragogi="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  View Paragogi
*********/
function view_paragogi() {  
	var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('ViewParagogiDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
	var url1="paragogi_ops.php";
	url1=url1+"?view_paragogi=1";
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}