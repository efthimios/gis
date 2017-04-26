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
  Dimotiko Diamerisma
**********************/
  
/*********
  New DD
*********/
function new_dd(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('NewDDDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="dd_ops.php";
	url1=url1+"?new_dd="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  Edit DD
*********/
function edit_dd(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditDDDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="dd_ops.php";
	url1=url1+"?edit_dd="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/**********
  Delete DD
**********/
function del_dd (str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditDDDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="dd_ops.php";
	url1=url1+"?del_dd="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********
  View DD
*********/
function view_dd() {  
	var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('ViewDDDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
	var url1="dd_ops.php";
	url1=url1+"?view_dd=1";
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/*********************
  Dimos
**********************/
  
/************
  New Dimos
************/
function new_dimos(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('NewDimosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="dd_ops.php";
	url1=url1+"?new_dimos="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/************
  Edit Dimos
************/
function edit_dimos(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      alert (xmlHttp.responseText);
      document.getElementById('EditDimosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="dd_ops.php";
	url1=url1+"?edit_dimos="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/**************
  Delete Dimos
**************/
function del_dimos (str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditDimosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="dd_ops.php";
	url1=url1+"?del_dimos="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/************
  View Dimos
************/

function view_dimos() {  
	var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('ViewDimosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
	var url1="dd_ops.php";
	url1=url1+"?view_dimos=1";
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}


/*********************
  Nomos
**********************/
  
/************
  New Nomos
************/
function new_nomos(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('NewNomosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="dd_ops.php";
	url1=url1+"?new_nomos="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/************
  Edit Nomos
************/
function edit_nomos(str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditNomosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="dd_ops.php";
	url1=url1+"?edit_nomos="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/**************
  Delete Nomos
**************/
function del_nomos (str) {
  var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      //alert (xmlHttp.responseText);
      document.getElementById('EditNomosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
  var url1="dd_ops.php";
	url1=url1+"?del_nomos="+str;
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}

/************
  View Nomos
************/

function view_nomos() {  
	var xmlHttp = getXMLHttp();
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4) {
      document.getElementById('ViewNomosDiv').innerHTML = xmlHttp.responseText;
    }
  }
  
	var url1="dd_ops.php";
	url1=url1+"?view_nomos=1";
	url1=url1+"&sid="+Math.random();

  xmlHttp.open("GET", url1, true); 
  xmlHttp.send(null);
}