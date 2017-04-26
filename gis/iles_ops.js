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
  Protes Iles
**********************/
  
/*********
  New Ili
*********/
function new_ili(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('NewIliDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="iles_ops.php";
	url1=url1+"?new_ili="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  Edit Ili
*********/
function edit_ili(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditIliDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="iles_ops.php";
	url1=url1+"?edit_ili="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/**********
  Delete Ili
**********/
function del_ili(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditIliDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="iles_ops.php";
	url1=url1+"?del_ili="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  View Ili
*********/
function view_ili() {  
	var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('ViewIliDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
	var url1="iles_ops.php";
	url1=url1+"?view_ili=1";
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}