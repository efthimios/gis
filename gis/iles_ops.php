<?php
session_start();
include ('helper.php');

$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
if (!$conn) {exit("Connection Failed: " . $conn);}
	
/*********************
 *********************
 Protes Iles
 *********************
 *********************
 *********************/
  
/*********
  New Ili  
 *********/
if (isset($_GET["new_ili"])) { // called by ili_ops.js
  $ili = $_GET["new_ili"];
  
  $query = "SELECT * FROM xProtes_Iles WHERE onoma='". in($ili) . "'";
  $rs = odbc_exec($conn,$query);
  if (!$rs) {exit("Error in SQL");}		
  
  $num_rows=0;
  while($temp = odbc_fetch_into($rs,&$counter)) $num_rows++;
  
  if ($num_rows > 0) {
    echo "Το όνομα της Πρώτης Ύλης που εισάγατε είναι ήδη καταχωρημένο";
  }
  else {
?>
<form method="POST" onsubmit="Protes_Iles.php">
	<input type=hidden name="new_ili" >
	<table>
		<tr><td><input type=hidden name="onoma" value=<? echo $ili; ?>></td></tr>
		<tr><td>ONOMA: <? echo $ili; ?></td></tr>
		<tr><td>Ειδος Πηγής:</td><td>
    <?
			dropdown("xEidos_pigis_ripansis", "onoma", "", "");	  
	  ?>
	</td></tr>
			
    <tr><td><input name="SubmitBT" type=submit value="Καταχώρηση" /></td></tr>
	</table>
</form>  
<?
}
} // if (isset($_GET["new_ili"])) {


/***********
  Edit Ili
  **********/
if (isset($_GET["edit_ili"])) { // called by ili_ops.js

$id = $_GET["edit_ili"];

$query = "SELECT * FROM xProtes_Iles WHERE id=" . $id ;
$rs = odbc_exec($conn,$query);
if (!$rs) {exit("Error in SQL");}

$eidos = "";
$onoma = "";

while (odbc_fetch_row($rs)) {
	$onoma = out(odbc_result($rs,"onoma"));
	$eidos = out(odbc_result($rs,"eidos_pigis_id"));
}
?>
<form method="POST" onsubmit="Protes_Iles.php">
	<input type=hidden name="edit_ili" value=<? echo $id; ?>>
	<table>
		<tr><td>ONOMA:</td><td><input type=text size="20" name="onoma" value="<? echo $onoma ?>" /></td></tr>
		<tr><td>ΕΙΔΟΣ ΠΗΓΗΣ:</td><td>
    <?
			dropdown("xEidos_pigis_ripansis", "onoma", "", $eidos);	  
	?>
	</td></tr>
			
    <tr><td><input name="SubmitBT" type=submit value="Ενημέρωση" /></td></tr>
	</table>
</form>  
<?
}


/***********
  Delete Ili
  **********/
if (isset($_GET["del_ili"])) { // called by ili_ops.js
	$id = $_GET["del_ili"];
?>

<form method="POST" onsubmit="Protes_Iles.php">
	<input type=hidden name="del_ili" value=<? echo $id; ?>>
	Είστε σίγουροι πως θέλεται να διαγραφεί αυτή η Πρώτη Ύλη (id = <? echo $id; ?> );
	
	<tr><td><input name="yes" type=submit value="ΝΑΙ" /></td>
	<td><input name="no" type=submit value="ΟΧΙ" /></td></tr>
</form>
<?
}


/**********
  View Ili
  *********/
if (isset($_GET["view_ili"])) { // called by ili_ops.js
?>
<table>
  <tr>
    <th>id</th>
    <th>eidos</th>
    <th>onoma</th>
  </tr>
<?
$query = "SELECT * FROM xProtes_Iles ORDER BY id";
$rs = odbc_exec($conn,$query);
if (!$rs) {exit("Error in SQL");}

while (odbc_fetch_row($rs)) {
  echo "<tr>";
  
  echo "<td>";
  echo out(odbc_result($rs,"id"));
  echo "</td>";
  
  echo "<td>";
  $query_temp = "SELECT onoma FROM xEidos_pigis_ripansis WHERE id=" . out(odbc_result($rs,"eidos_pigis_id"));
  $rs_tmp = odbc_exec($conn,$query_temp);
  if (!$rs_tmp) {exit("Error in SQL");}
  echo out(odbc_result($rs_tmp,"onoma"));
  echo "</td>";
	
  echo "<td>";
  echo out(odbc_result($rs,"onoma"));
  echo "</td>";
  
  echo "</tr>";
}
	echo "</table>";
} // if (isset($_GET["view_ili"]))