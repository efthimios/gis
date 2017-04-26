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
  Proionta
**********************/
  
/*********
  New Proion
*********/
function new_proion(str, proti_ili) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('NewProionDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="proionta_ops.php";
	url1=url1+"?new_proion="+str;
	url1=url1+"&proti_ili="+proti_ili;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  Edit Proion
*********/
function edit_proion(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditProionDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="proionta_ops.php";
	url1=url1+"?edit_proion="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/**********
  Delete Proion
**********/
function del_proion(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditProionDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="proionta_ops.php";
	url1=url1+"?del_proion="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  View Proion
*********/
function view_proion() {  
	var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('ViewProionDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
	var url1="proionta_ops.php";
	url1=url1+"?view_proion=1";
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}