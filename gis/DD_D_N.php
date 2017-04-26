<?php
session_start();
include ('helper.php');
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script type="text/javascript" src="dd_ops.js"></script>
</head>
<body>

<!--------------------
  --------------------
  Dimotiko Diamerisma
  --------------------
  -------------------->
  
<table>
	<tr>
		<td colspan=3 align=center><strong>Δημοτικό Διαμέρισμα</strong>:</td>
	</tr>
</table>

<!-----------
  New DD 
  ---------->
  
<form>
	<table>
    <tr>
      <td><strong>Νέο ΔΔ</strong>:</td>
			<td><input type=text size="20" name="dd" /></td>
      <td><input name="Submit" type=button onclick="new_dd(dd.value)" onmousedown="if(document.getElementById('NewDDDiv').style.display == 'none'){ document.getElementById('NewDDDiv').style.display = 'block'; }else{ document.getElementById('NewDDDiv').style.display = 'none'; }" value="Εισαγωγή" /></td>
	  </tr>
	</table>
</form>

<div id='NewDDDiv' style="display:none"></div>

<?
if (isset($_POST["new_dd"])) {

	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "INSERT INTO xDim_Diamerisma (dimos_id, onoma, emvado, ohp, plithismos_2001, sintelestis, arithm_klinon, ADV, eel_id) VALUES (";
	$query .= $_POST['xDimos'] . ",";
	$query .= "'" . in($_POST['onoma']) . "',";
	$query .= $_POST['emv'] . ",";
	$query .= "'" . in($_POST['ohp']) . "',";
	$query .= $_POST['plith'] . ",";
	$query .= $_POST['sint'] . ",";
	$query .= $_POST['klines'] . ",";
	$query .= "'" . in($_POST['adv']) . "',";
	$query .= $_POST['xPigi_ripansis'] . ")";

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
  Edit DD 
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
  DELETE DD 
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


<hr>

<!--------------------
  --------------------
  Dimos
  --------------------
  -------------------->

<table>
	<tr>
		<td colspan=3 align=center><strong>Δήμος</strong>:</td>
	</tr>
</table>

<!-----------
  New Dimos 
  ---------->
  
<form>
	<table>
    <tr>
      <td><strong>Νέος Δήμος</strong>:</td>
			<td><input type=text size="20" name="dimos" /></td>
      <td><input name="Submit" type=button onclick="new_dimos(dimos.value)" onmousedown="if(document.getElementById('NewDimosDiv').style.display == 'none'){ document.getElementById('NewDimosDiv').style.display = 'block'; }else{ document.getElementById('NewDimosDiv').style.display = 'none'; }" value="Εισαγωγή" /></td>
	  </tr>
	</table>
</form>

<div id='NewDimosDiv' style="display:none"></div>

<?
if (isset($_POST["new_dimos"])) {

	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "INSERT INTO xDimos (nomos_id, onoma, emvado, posostostilek, emvadostilek) VALUES (";
	$query .= $_POST['xNomos'] . ",";
	$query .= "'" . in($_POST['onoma']) . "',";
	$query .= $_POST['emv'] . ",";
	$query .= $_POST['poslek'] . ",";
	$query .= $_POST['emvlek'] . ")";
	
  $rs = odbc_exec($conn,$query);
  if (!$rs) {
	exit("Error in SQL");
	}
	else {
		echo "Επιτυχής καταχώρηση<br>";
	}
}
?>

<!-----------
  Edit Dimos 
  ---------->

<form>
	<table>
    <tr>
      <td><strong>Επεξεργασία Δήμου</strong>:</td>
			<td>
<?			dropdown ("xDimos", "onoma", "", ""); ?>
      </td>
			<td><input name="change_dimos" type=button onclick="edit_dimos(xDimos.value)" onmousedown="if(document.getElementById('EditDimosDiv').style.display == 'none'){ document.getElementById('EditDimosDiv').style.display = 'block'; }else{ document.getElementById('EditDimosDiv').style.display = 'none'; }" value="Μεταβολή" /></td>
			<td><input name="del_dimos1" type=button onclick="del_dimos(xDimos.value)" onmousedown="if(document.getElementById('EditDimosDiv').style.display == 'none'){ document.getElementById('EditDimosDiv').style.display = 'block'; }else{ document.getElementById('EditDimosDiv').style.display = 'none'; }" value="Διαγραφή" /></td>
	  </tr>
	</table>
</form>

<div id='EditDimosDiv' style="display:none"></div>
  
<?
if (isset($_POST["edit_dimos"])) {
	$id = $_POST["edit_dimos"];
	
	//echo "ID = " . $id . "<BR>";
	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "UPDATE xDimos SET ";
	$query .= "nomos_id=" . $_POST["xNomos"];
	$query .= ",onoma='" . in($_POST["onoma"]) . "'";
	$query .= ",emvado=" . $_POST["emv"];
	$query .= ",posostostilek=" . $_POST["poslek"];
	$query .= ",emvadostilek=" . $_POST["emvlek"];
	$query .= " WHERE id=" . $id;

  $rs = odbc_exec($conn,$query);
  if (!$rs) {
		echo $query . "<br>";
		exit("Error in SQL");
	}
	else {
?>
<script> alert ("Επιτυχής ενημέρωση"); </script>
<meta http-equiv="refresh" content="0"> <!-- necessary to update drop-down box with changes -->
<?
	}
}
?>

<!-------------
  DELETE Dimos 
  ------------->
<?
if (isset($_POST["del_dimos"])) {
	$id = $_POST["del_dimos"];

	if (isset($_POST["yes"])) {
	
		$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
		if (!$conn) {exit("Connection Failed: " . $conn);}

		$query = "DELETE FROM xDimos WHERE id=" . $id ;
		//echo "QUERY=" .$query;
		$rs = odbc_exec($conn,$query);
		if (!$rs) {exit("Error in SQL");}
?>
<script> alert ("Επιτυχής διαγραφή"); </script>
<meta http-equiv="refresh" content="0"> <!-- necessary to update drop-down box with changes -->
<?
}
else if (isset($_POST["no"])) {
?>
<script> alert ("Δεν διαγράφηκε κανένας Δήμος"); </script>
<?
}
}
?>


<hr>

<!--------------------
  --------------------
  Nomos
  --------------------
  -------------------->

<table>
	<tr>
		<td colspan=3 align=center><strong>Νομός</strong>:</td>
	</tr>
</table>

<!-----------
  New Nomos 
  ---------->
  
<form>
	<table>
    <tr>
      <td><strong>Νέος Νομός</strong>:</td>
			<td><input type=text size="20" name="nomos" /></td>
      <td><input name="Submit" type=button onclick="new_nomos(nomos.value)" onmousedown="if(document.getElementById('NewNomosDiv').style.display == 'none'){ document.getElementById('NewNomosDiv').style.display = 'block'; }else{ document.getElementById('NewNomosDiv').style.display = 'none'; }" value="Εισαγωγή" /></td>
	  </tr>
	</table>
</form>

<div id='NewNomosDiv' style="display:none"></div>

<?
if (isset($_POST["new_nomos"])) {

	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "INSERT INTO xNomos (onoma) VALUES (";
	$query .= "'" . in($_POST['onoma']) . "')";
	
  $rs = odbc_exec($conn,$query);
  if (!$rs) {
	exit("Error in SQL");
	}
	else {
		echo "Επιτυχής καταχώρηση<br>";
	}
}
?>

<!-----------
  Edit Nomos 
  ---------->

<form>
	<table>
    <tr>
      <td><strong>Επεξεργασία Νομού</strong>:</td>
			<td>
<?			dropdown ("xNomos", "onoma", "", ""); ?>
      </td>
			<td><input name="change_nomos" type=button onclick="edit_nomos(xNomos.value)" onmousedown="if(document.getElementById('EditNomosDiv').style.display == 'none'){ document.getElementById('EditNomosDiv').style.display = 'block'; }else{ document.getElementById('EditNomosDiv').style.display = 'none'; }" value="Μεταβολή" /></td>
			<td><input name="del_nomos1" type=button onclick="del_nomos(xNomos.value)" onmousedown="if(document.getElementById('EditNomosDiv').style.display == 'none'){ document.getElementById('EditNomosDiv').style.display = 'block'; }else{ document.getElementById('EditNomosDiv').style.display = 'none'; }" value="Διαγραφή" /></td>
	  </tr>
	</table>
</form>

<div id='EditNomosDiv' style="display:none"></div>  
<?
if (isset($_POST["edit_nomos"])) {
	$id = $_POST["edit_nomos"];

	echo "ID = " . $id . "<BR>";
	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "UPDATE xNomos SET ";
	$query .= "onoma='" . in($_POST["onoma"]) . "'";
	$query .= " WHERE id=" . $id;

  $rs = odbc_exec($conn,$query);
  if (!$rs) {
		echo $query . "<br>";
		exit("Error in SQL");
	}
	else {
?>
<script> alert ("Επιτυχής ενημέρωση"); </script>
<meta http-equiv="refresh" content="0"> <!-- necessary to update drop-down box with changes -->
<?
	}
}
?>

<!-------------
  DELETE Nomos 
  ------------->
<?
if (isset($_POST["del_nomos"])) {
	$id = $_POST["del_nomos"];

	if (isset($_POST["yes"])) {
	
		$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
		if (!$conn) {exit("Connection Failed: " . $conn);}

		$query = "DELETE FROM xNomos WHERE id=" . $id ;
		//echo "QUERY=" .$query;
		$rs = odbc_exec($conn,$query);
		if (!$rs) {exit("Error in SQL");}
?>
<script> alert ("Επιτυχής διαγραφή"); </script>
<meta http-equiv="refresh" content="0"> <!-- necessary to update drop-down box with changes -->
<?
}
else if (isset($_POST["no"])) {
?>
<script> alert ("Δεν διαγράφηκε κανένας Νομός"); </script>
<?
}
}
?>


<!-- View DD table -->
<input type=button onclick="view_dd()" onmousedown="if(document.getElementById('ViewDDDiv').style.display == 'none'){ document.getElementById('ViewDDDiv').style.display = 'block'; }else{ document.getElementById('ViewDDDiv').style.display = 'none'; }" value="Προβολή ΔΔ"/>
<div id='ViewDDDiv' style="display:none"></div>

<!-- View DM table -->
<br>
<input type=button onclick="view_dimos()" onmousedown="if(document.getElementById('ViewDimosDiv').style.display == 'none'){ document.getElementById('ViewDimosDiv').style.display = 'block'; }else{ document.getElementById('ViewDimosDiv').style.display = 'none'; }" value="Προβολή Δήμων"/>
<div id='ViewDimosDiv' style="display:none"></div>

<!-- View NM table -->
<br>
<input type=button onclick="view_nomos()" onmousedown="if(document.getElementById('ViewNomosDiv').style.display == 'none'){ document.getElementById('ViewNomosDiv').style.display = 'block'; }else{ document.getElementById('ViewNomosDiv').style.display = 'none'; }" value="Προβολή Νομών"/>
<div id='ViewNomosDiv' style="display:none"></div>

</body>
</html> 