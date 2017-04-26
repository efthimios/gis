function isFile(str){
    var O= AJ();
    if(!O) return false;
    try {
        O.open("HEAD", str, false);
        O.send(null);
        return (O.status==200) ? true : false;
    }
    catch(er) {
        return false;
    }
}
function AJ() {
    var obj;
    if (window.XMLHttpRequest) {
        obj= new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        try {
            obj= new ActiveXObject('MSXML2.XMLHTTP.3.0');
        }
        catch(er) {
            obj=false;
        }
    }
    return obj;
}


if (isFile("dd_insert.php")) {
  alert ("File exists");
}
else {
  alert ("File not there");
}