<?
session_start();
include ('helper.php');
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script type="text/javascript" src="pigi_ops.js"></script>
</head>
<body>

<!--------------------
  --------------------
  Pigi Ripansis
  --------------------
  -------------------->
  
<table>
	<tr>
		<td colspan=3 align=center><strong>Πηγή Ρύπανσης</strong>:</td>
	</tr>
</table>

<!-----------
  New Pigi 
  ---------->
  
<form>
	<table>
    <tr>
      <td><strong>Νεα Πηγή</strong>:</td>
			<td><input type=text size="20" name="pigi" /></td>
      <td><input name="Submit" type=button onclick="new_pigi(pigi.value)" onmousedown="if(document.getElementById('NewPigiDiv').style.display == 'none'){ document.getElementById('NewPigiDiv').style.display = 'block'; }else{ document.getElementById('NewPigiDiv').style.display = 'none'; }" value="Εισαγωγή" /></td>
	  </tr>
	</table>
</form>

<div id='NewPigiDiv' style="display:none"></div>

<?
if (isset($_POST["new_pigi"])) {

	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "INSERT INTO xPigi_ripansis (onoma, til, dim_diamerisma_id,leitourgei,eidos_pigis_id,X,Y) VALUES (";
	$query .= "'" . in($_POST['onoma']) . "',";
	$query .= $_POST['til'] . ",";
	$query .= $_POST['xDim_Diamerisma'] . ",";
	
	if ($_POST['leitourgei'] == "nai") {
		$query .= "1,";
	}
	else 
		$query .= "0,";
		
	$query .= $_POST['xEidos_pigis_ripansis'] . ",";
	$query .= $_POST['X'] . ",";
	$query .= $_POST['Y'] . ")";
	
  $rs = odbc_exec($conn,$query);
  if (!$rs) {echo $query;	exit("Error in SQL");	}
	else {
?>
<script> alert ("Επιτυχής Καταχώρηση!"); </script>
<?		
	}
}
?>

<!-----------
  Edit Pigi
  ---------->

<form>
	<table>
    <tr>
      <td><strong>Επεξεργασία Πηγής</strong>:</td>
			<td>
<?			dropdown ("xPigi_ripansis", "onoma", "", ""); ?>
      </td>
			<td><input name="change_pigi" type=button onclick="edit_pigi(xPigi_ripansis.value)" onmousedown="if(document.getElementById('EditPigiDiv').style.display == 'none'){ document.getElementById('EditPigiDiv').style.display = 'block'; }else{ document.getElementById('EditPigiDiv').style.display = 'none'; }" value="Μεταβολή" /></td>
			<td><input name="del_pigi1" type=button onclick="del_pigi(xPigi_ripansis.value)" onmousedown="if(document.getElementById('EditPigiDiv').style.display == 'none'){ document.getElementById('EditPigiDiv').style.display = 'block'; }else{ document.getElementById('EditPigiDiv').style.display = 'none'; }" value="Διαγραφή" /></td>
	  </tr>
	</table>
</form>

<div id='EditPigiDiv' style="display:none"></div>
  
<?
if (isset($_POST["edit_pigi"])) {
	$id = $_POST["edit_pigi"];
	$leitourgei = $_POST["leitourgei"];
	
	//echo "ID = " . $id . "<BR>";
	//echo "leitourgei = " . $leitourgei . "<BR>";
	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "UPDATE xPigi_ripansis SET ";
	$query .= "onoma='" . in($_POST["onoma"]) . "'";
	$query .= ",til=" . $_POST["til"];
	$query .= ",dim_diamerisma_id=" . $_POST["xDim_Diamerisma"];
	if ($leitourgei == "nai") {
		$query .= ",leitourgei=1";
	}
	else {
		$query .= ",leitourgei=0";
	}
	$query .= ",eidos_pigis_id=" . $_POST["xEidos_pigis_ripansis"];
	$query .= ",X=" . $_POST["X"];
	$query .= ",Y=" . $_POST["Y"];
	
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
  DELETE Pigi 
  ---------->
<?
if (isset($_POST["del_pigi"])) {
	$id = $_POST["del_pigi"];

	if (isset($_POST["yes"])) {
	
		$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
		if (!$conn) {exit("Connection Failed: " . $conn);}

		$query = "DELETE FROM xPigi_ripansis WHERE id=" . $id ;
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

<!-- View Pigi table -->
<br>
<input type=button onclick="view_pigi()" onmousedown="if(document.getElementById('ViewPigiDiv').style.display == 'none'){ document.getElementById('ViewPigiDiv').style.display = 'block'; }else{ document.getElementById('ViewPigiDiv').style.display = 'none'; }" value="Προβολή Είδους"/>
<div id='ViewPigiDiv' style="display:none"></div>

</body>
</html> 