<?php
session_start();
include ('helper.php');
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script type="text/javascript" src="proionta_ops.js"></script>
</head>
<body>

<!--------------------
  --------------------
  Proionta
  --------------------
  -------------------->
  
<table>
	<tr>
		<td colspan=3 align=center><strong>Προιόντα</strong>:</td>
	</tr>
</table>

<!-----------
  New Proion
  ---------->
  
<form>
	<table>
    <tr>
      <td><strong>Νέο Προιόν</strong>:</td>
			<td><input type=text size="20" name="proion" /></td>
			<td><strong>ΠΡΩΤΗ ΥΛΗ:</strong></td><td><? dropdown("xProtes_Iles","onoma", "", "");  ?></td>
      <td><input name="Submit" type=button onclick="new_proion(proion.value, xProtes_Iles.value)" onmousedown="if(document.getElementById('NewProionDiv').style.display == 'none'){ document.getElementById('NewProionDiv').style.display = 'block'; }else{ document.getElementById('NewProionDiv').style.display = 'none'; }" value="Εισαγωγή" /></td>
	  </tr>
	</table>
</form>

<div id='NewProionDiv' style="display:none"></div>

<?
if (isset($_POST["new_proion"])) {

	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	for ($i = 1; $i < 13; $i++) {
		$query = "INSERT INTO xProionta (onoma, proti_ili_id, sint_paragogis, sint_apovliton, sint_bod, sint_n, sint_p, minas) VALUES (";
		$query .= "'" . in($_POST['onoma']) . "',";
		$query .= $_POST['proti_ili_id'] . ",";
		$query .= $_POST["sint_paragogis_$i"] . ",";
		$query .= $_POST["sint_apovliton_$i"] . ",";
		$query .= $_POST["sint_bod_$i"] . ",";
		$query .= $_POST["sint_n_$i"] . ",";
		$query .= $_POST["sint_p_$i"] . ",";
		$query .= $i . ")";
	
		$rs = odbc_exec($conn,$query);
		if (!$rs) {	echo "<BR> QUERY=$query"; exit("Error in SQL");	}
		else {
		?>
		<script> alert ("Επιτυχής Καταχώρηση για το μήνα <? echo $i; ?>!"); </script>
		<?	
		}
	}
}
?>

<!-----------
  Edit Proion 
  ---------->

<form>
	<table>
    <tr>
      <td><strong>Επεξεργασία Προιόντος</strong>:</td>
			<td>
<?			dropdown_distinct ("xProionta", "onoma", "", ""); ?>
      </td>
			<td><input name="change_proion" type=button onclick="edit_proion(xProionta.value)" onmousedown="if(document.getElementById('EditProionDiv').style.display == 'none'){ document.getElementById('EditProionDiv').style.display = 'block'; }else{ document.getElementById('EditProionDiv').style.display = 'none'; }" value="Μεταβολή" /></td>
			<td><input name="del_proion1" type=button onclick="del_proion(xProionta.value)" onmousedown="if(document.getElementById('EditProionDiv').style.display == 'none'){ document.getElementById('EditProionDiv').style.display = 'block'; }else{ document.getElementById('EditProionDiv').style.display = 'none'; }" value="Διαγραφή" /></td>
	  </tr>
	</table>
</form>

<div id='EditProionDiv' style="display:none"></div>
  
<?
if (isset($_POST["edit_proion"])) {
	$id = $_POST["edit_proion"];
	$onoma_proiontos_id = "";
	
	//echo "ID = " . $id . "<BR>";
	$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}

	$query = "SELECT onoma FROM xProionta WHERE id=$id";
	$rs = odbc_exec($conn,$query);
	if (!$rs) {exit("Error in SQL");}
	while (odbc_fetch_row($rs)) {
		$onoma_proiontos_id = out(odbc_result($rs,"onoma"));
	}
	
	// find duplicate name, if current name is different to target name, then problem
  $query = "SELECT onoma FROM xProionta WHERE onoma='". in($_POST["onoma"]) . "' AND onoma<>'". in($onoma_proiontos_id) . "'";
  $rs = odbc_exec($conn,$query);
  if (!$rs) {exit("Error in SQL");}		
  
  $num_rows=0;
  while($temp = odbc_fetch_into($rs,&$counter)) $num_rows++;
  //echo $num_rows;
	//exit;
  if ($num_rows > 0) { // at lease one entry
    //echo "Το όνομα του Προιόντος που εισάγατε είναι ήδη καταχωρημένο";
?>
<script>alert ("Το όνομα του Προιόντος που εισάγατε είναι ήδη καταχωρημένο");</script>
<?
  }
	else {
	
		for ($i = 1; $i < 13; $i++) { //12 months
		
			$query = "UPDATE xProionta SET ";
			$query .= "onoma='" . in($_POST["onoma"]) . "'";
			$query .= ",proti_ili_id=" . $_POST["xProtes_Iles"];
			$query .= ",sint_paragogis=" . $_POST["sint_paragogis_$i"];
			$query .= ",sint_apovliton=" . $_POST["sint_apovliton_$i"];
			$query .= ",sint_bod=" . $_POST["sint_bod_$i"];
			$query .= ",sint_n=" . $_POST["sint_n_$i"];
			$query .= ",sint_p=" . $_POST["sint_p_$i"];
			$query .= " WHERE onoma='" . in($onoma_proiontos_id) . "' AND minas=$i";
	//	echo $query . "<br>";
			$rs = odbc_exec($conn,$query);
			if (!$rs) {
				echo $query . "<br>";
				exit("Error in SQL");
			}
			else {
	?>
	<script> alert ("Επιτυχής ενημέρωση για μήνα <? echo $i; ?>"); </script>
	<meta http-equiv="refresh" content="0"> <!-- necessary to update drop-down box with changes -->
	<?
			}
		}
	}
}
?>


<!-----------
  DELETE Proion
  ---------->
<?
if (isset($_POST["del_proion"])) {
	$id = $_POST["del_proion"];

	if (isset($_POST["yes"])) {
	
		$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
		if (!$conn) {exit("Connection Failed: " . $conn);}

		$onoma_proiontos_id = "";
		
		$query = "SELECT onoma FROM xProionta WHERE id=$id";
		$rs = odbc_exec($conn,$query);
		if (!$rs) {exit("Error in SQL");}
		while (odbc_fetch_row($rs)) {
			$onoma_proiontos_id = out(odbc_result($rs,"onoma"));
		}
			
		$query = "DELETE FROM xProionta WHERE onoma='" . in($onoma_proiontos_id) ."'";
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
<script> alert ("Δεν διαγράφηκε κανένα Προιόν"); </script>
<?
}
}
?>

<hr>

<!-- View Proionta table -->
<input type=button onclick="view_proion()" onmousedown="if(document.getElementById('ViewProionDiv').style.display == 'none'){ document.getElementById('ViewProionDiv').style.display = 'block'; }else{ document.getElementById('ViewProionDiv').style.display = 'none'; }" value="Προβολή Προιόντων"/>
<div id='ViewProionDiv' style="display:none"></div>

</body>
</html> 