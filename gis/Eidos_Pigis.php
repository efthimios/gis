<?
session_start();
include ('helper.php');
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script type="text/javascript" src="eidos_ops.js"></script>
</head>
<body>

<!--------------------
  --------------------
  Eidos Pigis Ripansis
  --------------------
  -------------------->
  
<table>
	<tr>
		<td colspan=3 align=center><strong>Είδος Πηγής Ρύπανσης</strong>:</td>
	</tr>
</table>

<!-----------
  New Eidos 
  ---------->
  
<form>
	<table>
    <tr>
      <td><strong>Νεό Είδος</strong>:</td>
			<td><input type=text size="20" name="eidos" /></td>
      <td><input name="Submit" type=button onclick="new_eidos(eidos.value)" onmousedown="if(document.getElementById('NewEidosDiv').style.display == 'none'){ document.getElementById('NewEidosDiv').style.display = 'block'; }else{ document.getElementById('NewEidosDiv').style.display = 'none'; }" value="Εισαγωγή" /></td>
	  </tr>
	</table>
</form>

<div id='NewEidosDiv' style="display:none"></div>

<?
if (isset($_POST["new_eidos"])) {

	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "INSERT INTO xEidos_pigis_ripansis (onoma, simiaki) VALUES (";
	$query .= "'" . in($_POST['onoma']) . "',";
	if ($_POST['simiaki'] == "simiaki") {
		$query .= "1)";
	}
	else 
		$query .= "0)";

  $rs = odbc_exec($conn,$query);
  if (!$rs) {
	exit("Error in SQL");
	}
	else {
?>
<script> alert ("Επιτυχής Καταχώρηση!"); </script>
<?		
	}
}
?>

<!-----------
  Edit Eidos
  ---------->

<form>
	<table>
    <tr>
      <td><strong>Επεξεργασία Είδους Πηγής</strong>:</td>
			<td>
<?			dropdown ("xEidos_pigis_ripansis", "onoma", "", ""); ?>
      </td>
			<td><input name="change_eidos" type=button onclick="edit_eidos(xEidos_pigis_ripansis.value)" onmousedown="if(document.getElementById('EditEidosDiv').style.display == 'none'){ document.getElementById('EditEidosDiv').style.display = 'block'; }else{ document.getElementById('EditEidosDiv').style.display = 'none'; }" value="Μεταβολή" /></td>
			<td><input name="del_eidos1" type=button onclick="del_eidos(xEidos_pigis_ripansis.value)" onmousedown="if(document.getElementById('EditEidosDiv').style.display == 'none'){ document.getElementById('EditEidosDiv').style.display = 'block'; }else{ document.getElementById('EditEidosDiv').style.display = 'none'; }" value="Διαγραφή" /></td>
	  </tr>
	</table>
</form>

<div id='EditEidosDiv' style="display:none"></div>
  
<?
if (isset($_POST["edit_eidos"])) {
	$id = $_POST["edit_eidos"];
	$simiaki = $_POST["simiaki"];
	
	//echo "ID = " . $id . "<BR>";
	//echo "SIMIAKI = " . $simiaki . "<BR>";
	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "UPDATE xEidos_pigis_ripansis SET ";
	$query .= "onoma='" . in($_POST["onoma"]) . "'";
	if ($simiaki == "simiaki") {
		$query .= ",simiaki=1";
	}
	else {
		$query .= ",simiaki=0";
	}
	
	$query .= " WHERE id=" . $id;

  $rs = odbc_exec($conn,$query);
  if (!$rs) {
		echo $query . "<br>";
		exit("Error in SQL");
	}
	else {
?>
<script> alert ("Επιτυχής Ενημέρωση!"); </script>
<meta http-equiv="refresh" content="0"> <!-- necessary to update drop-down box with changes -->
<?
	}
}
?>


<!-----------
  DELETE Eidos 
  ---------->
<?
if (isset($_POST["del_eidos"])) {
	$id = $_POST["del_eidos"];

	if (isset($_POST["yes"])) {
	
		$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
		if (!$conn) {exit("Connection Failed: " . $conn);}

		$query = "DELETE FROM xEidos_pigis_ripansis WHERE id=" . $id ;
		//echo "QUERY=" .$query;
		$rs = odbc_exec($conn,$query);
		if (!$rs) {exit("Error in SQL");}
?>
<script> alert ("Επιτυχής Διαγραφή!"); </script>
<meta http-equiv="refresh" content="0"> <!-- necessary to update drop-down box with changes -->
<?
}
else if (isset($_POST["no"])) {
?>
<script> alert ("Καμία Διαγραφή"); </script>
<?
}
}
?>

<!-- View Eidos Pigis table -->
<br>
<input type=button onclick="view_eidos()" onmousedown="if(document.getElementById('ViewEidosDiv').style.display == 'none'){ document.getElementById('ViewEidosDiv').style.display = 'block'; }else{ document.getElementById('ViewEidosDiv').style.display = 'none'; }" value="Προβολή Είδους"/>
<div id='ViewEidosDiv' style="display:none"></div>

</body>
</html> 