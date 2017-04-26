<?php
session_start();
include ('helper.php');
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script type="text/javascript" src="iles_ops.js"></script>
</head>
<body>

<!--------------------
  --------------------
  Protes Iles
  --------------------
  -------------------->
  
<table>
	<tr>
		<td colspan=3 align=center><strong>Πρώτες Ύλες</strong>:</td>
	</tr>
</table>

<!-----------
  New ili 
  ---------->
  
<form>
	<table>
    <tr>
      <td><strong>Νέα Πρώτη Ύλη</strong>:</td>
			<td><input type=text size="20" name="ili" /></td>
      <td><input name="Submit" type=button onclick="new_ili(ili.value)" onmousedown="if(document.getElementById('NewIliDiv').style.display == 'none'){ document.getElementById('NewIliDiv').style.display = 'block'; }else{ document.getElementById('NewIliDiv').style.display = 'none'; }" value="Εισαγωγή" /></td>
	  </tr>
	</table>
</form>

<div id='NewIliDiv' style="display:none"></div>

<?
if (isset($_POST["new_ili"])) {

	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "INSERT INTO xProtes_Iles (eidos_pigis_id, onoma) VALUES (";
	$query .= $_POST['xEidos_pigis_ripansis'] . ",";
	$query .= "'" . in($_POST['onoma']) . "')";

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
  Edit Ili 
  ---------->

<form>
	<table>
    <tr>
      <td><strong>Επεξεργασία Πρώτης Ύλης</strong>:</td>
			<td>
<?			dropdown ("xProtes_Iles", "onoma", "", ""); ?>
      </td>
			<td><input name="change_ili" type=button onclick="edit_ili(xProtes_Iles.value)" onmousedown="if(document.getElementById('EditIliDiv').style.display == 'none'){ document.getElementById('EditIliDiv').style.display = 'block'; }else{ document.getElementById('EditIliDiv').style.display = 'none'; }" value="Μεταβολή" /></td>
			<td><input name="del_ili1" type=button onclick="del_ili(xProtes_Iles.value)" onmousedown="if(document.getElementById('EditIliDiv').style.display == 'none'){ document.getElementById('EditIliDiv').style.display = 'block'; }else{ document.getElementById('EditIliDiv').style.display = 'none'; }" value="Διαγραφή" /></td>
	  </tr>
	</table>
</form>

<div id='EditIliDiv' style="display:none"></div>
  
<?
if (isset($_POST["edit_ili"])) {
	$id = $_POST["edit_ili"];
	
	//echo "ID = " . $id . "<BR>";
	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "UPDATE xProtes_Iles SET ";
	$query .= "eidos_pigis_id=" . $_POST["xEidos_pigis_ripansis"];
	$query .= ",onoma='" . in($_POST["onoma"]) . "'";
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
  DELETE Ili 
  ---------->
<?
if (isset($_POST["del_ili"])) {
	$id = $_POST["del_ili"];

	if (isset($_POST["yes"])) {
	
		$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
		if (!$conn) {exit("Connection Failed: " . $conn);}

		$query = "DELETE FROM xProtes_Iles WHERE id=" . $id ;
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
<script> alert ("Δεν διαγράφηκε καμία Πρώτη Ύλη"); </script>
<?
}
}
?>


<hr>


<!-- View Ili table -->
<input type=button onclick="view_ili()" onmousedown="if(document.getElementById('ViewIliDiv').style.display == 'none'){ document.getElementById('ViewIliDiv').style.display = 'block'; }else{ document.getElementById('ViewIliDiv').style.display = 'none'; }" value="Προβολή Πρώτων Υλών"/>
<div id='ViewIliDiv' style="display:none"></div>
</body>
</html> 