<?php
session_start();
include ('helper.php');
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script type="text/javascript" src="paragogi_ops.js"></script>
</head>
<body>

<!--------------------
  --------------------
  Paragogi Pigis
  --------------------
  -------------------->
  
<table>
	<tr>
		<td colspan=3 align=center><strong>Παραγωγή Πηγής</strong>:</td>
	</tr>
</table>

<!-----------
  New Paragogi 
  ---------->
  
<form>
	<table>
    <tr>
      <td><strong>Για Πηγή: </strong>:</td>
			<td>
<?			dropdown ("xPigi_ripansis", "onoma", "", ""); ?>
      </td>
      <td><input name="Submit" type=button onclick="new_paragogi(xPigi_ripansis.value)" onmousedown="if(document.getElementById('NewParagogiDiv').style.display == 'none'){ document.getElementById('NewParagogiDiv').style.display = 'block'; }else{ document.getElementById('NewParagogiDiv').style.display = 'none'; }" value="Εισαγωγή" /></td>
	  </tr>
	</table>
</form>

<div id='NewParagogiDiv' style="display:none"></div>

<?
if (isset($_POST["new_dd"])) {

	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "INSERT INTO xDim_Diamerisma (dimos_id, onoma, emvado, ohp, plithismos_2001, sintelestis, arithm_klinon, ADV, eel_id) VALUES (";
	

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
  Edit Paragogi 
  ---------->

<form>
	<table>
    <tr>
      <td><strong>Επεξεργασία ΔΔ</strong>:</td>
			<td>
<?			dropdown ("xDim_Diamerisma", "onoma", "", ""); ?>
      </td>
			<td><input name="change_dd" type=button onclick="edit_dd(xDim_Diamerisma.value)" onmousedown="if(document.getElementById('EditDDDiv').style.display == 'none'){ document.getElementById('EditDDDiv').style.display = 'block'; }else{ document.getElementById('EditDDDiv').style.display = 'none'; }" value="Μεταβολή" /></td>
			<td><input name="del_dd1" type=button onclick="del_dd(xDim_Diamerisma.value)" onmousedown="if(document.getElementById('EditDDDiv').style.display == 'none'){ document.getElementById('EditDDDiv').style.display = 'block'; }else{ document.getElementById('EditDDDiv').style.display = 'none'; }" value="Διαγραφή" /></td>
	  </tr>
	</table>
</form>

<div id='EditDDDiv' style="display:none"></div>
  
<?
if (isset($_POST["edit_dd"])) {
	$id = $_POST["edit_dd"];
	
	//echo "ID = " . $id . "<BR>";
	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "UPDATE xDim_Diamerisma SET ";
	$query .= "dimos_id=" . $_POST["xDimos"];
	$query .= ",onoma='" . in($_POST["onoma"]) . "'";
	$query .= ",emvado=" . $_POST["emv"];
	$query .= ",ohp='" . in($_POST["ohp"]) . "'";
	$query .= ",plithismos_2001=" . $_POST["plith"];
	$query .= ",sintelestis=" . $_POST["sint"];
	$query .= ",arithm_klinon=" . $_POST["klines"];
	$query .= ",ADV='" . in($_POST["adv"]) . "'";
	$query .= ",eel_id=" . $_POST["xPigi_ripansis"];
	$query .= " WHERE id=" . $id;

	
  $rs = odbc_exec($conn,$query);
  if (!$rs) {
		//echo $query . "<br>";
		exit("Error in SQL");
	}
	else {
?>
<script> alert ("Επιτυχής ενημέρωση"); </script>
 <meta http-equiv="reload" content="0"> <!-- necessary to update drop-down box with changes -->
<?
	}
}
?>


<!-----------
  DELETE Paragogi 
  ---------->
<?
if (isset($_POST["del_dd"])) {
	$id = $_POST["del_dd"];

	if (isset($_POST["yes"])) {
	
		$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
		if (!$conn) {exit("Connection Failed: " . $conn);}

		$query = "DELETE FROM xDim_Diamerisma WHERE id=" . $id ;
		//echo "QUERY=" .$query;
		$rs = odbc_exec($conn,$query);
		if (!$rs) {exit("Error in SQL");}
?>
<script> alert ("Επιτυχής διαγραφή"); </script>
 <meta http-equiv="reload" content="0"> <!-- necessary to update drop-down box with changes -->
<?
}
else if (isset($_POST["no"])) {
?>
<script> alert ("Δεν διαγράφηκε κανένα ΔΔ"); </script>
<?
}
}
?>


<!-- View Paragogi table -->
<input type=button onclick="view_dd()" onmousedown="if(document.getElementById('ViewDDDiv').style.display == 'none'){ document.getElementById('ViewDDDiv').style.display = 'block'; }else{ document.getElementById('ViewDDDiv').style.display = 'none'; }" value="Προβολή ΔΔ"/>
<div id='ViewDDDiv' style="display:none"></div>

</body>
</html> 