<?php
session_start();
include ('helper.php');

$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
if (!$conn) {exit("Connection Failed: " . $conn);}
	
/*********************
 *********************
 Proionta
 *********************
 *********************
 *********************/
  
/*********
  New Proion  
 *********/
if (isset($_GET["new_proion"])) { // called by proionta_ops.js
  $id = $_GET["new_proion"];
	$proti_ili_id = $_GET["proti_ili"];
	
  $query = "SELECT * FROM xProionta WHERE onoma='". in($id) . "'";
  $rs = odbc_exec($conn,$query);
  if (!$rs) {exit("Error in SQL");}		
  
  $num_rows=0;
  while($temp = odbc_fetch_into($rs,&$counter)) $num_rows++;
  
  if ($num_rows > 11) { // 12 months
    echo "Το όνομα του Προιόντος που εισάγατε είναι ήδη καταχωρημένο";
  }
  else {
		$query = "SELECT onoma FROM xProtes_Iles WHERE id=$proti_ili_id";
		$rs = odbc_exec($conn,$query);
		if (!$rs) {exit("Error in SQL");}
		$proti_ili_onoma = "";
		while (odbc_fetch_row($rs)) {
			$proti_ili_onoma = out(odbc_result($rs,"onoma"));
		}
?>
<form method="POST" onsubmit="Prionta.php">
	<input type=hidden name="new_proion" >
	<table>
		<tr><td><input type=hidden name="onoma" value=<? echo $id; ?>></td></tr>
		<tr><td><input type=hidden name="proti_ili_id" value=<? echo $proti_ili_id; ?>></td></tr>
		<tr><td>ONOMA: <? echo $id; ?></td></tr>
		<tr><td>ΠΡΩΤΗ ΥΛΗ: <? echo $proti_ili_onoma; ?></td></tr>
		<tr><td>ΜΗΝΑΣ</td><td>ΣΥΝΤ ΠΑΡ</td><td>ΣΥΝΤ ΑΠΟ</td> <td>ΣΥΝΤ BOD</td> <td>ΣΥΝΤ Ν</td> <td>ΣΥΝΤ Π</td></tr>
<?
		for ($i=1; $i<13; $i++) {
?>	
		<tr>
		<td><? echo $i; ?></td>
		<td><input type=text size="8" name="sint_paragogis_<? echo $i; ?>" value="<? echo $i; ?>"/></td>
		<td><input type=text size="8" name="sint_apovliton_<? echo $i; ?>" value="<? echo $i; ?>"/></td>
		<td><input type=text size="8" name="sint_bod_<? echo $i; ?>" value="<? echo $i; ?>"/></td>
		<td><input type=text size="8" name="sint_n_<? echo $i; ?>" value="<? echo $i; ?>"/></td>
		<td><input type=text size="8" name="sint_p_<? echo $i; ?>" value="<? echo $i; ?>"/></td>
		</tr>
<?
		}
?>						
    <tr><td><input name="SubmitBT" type=submit value="Καταχώρηση" /></td></tr>
	</table>
</form>  
<?
}
} // if (isset($_GET["new_proion])) {


/***********
  Edit Proion
  **********/
if (isset($_GET["edit_proion"])) { // called by dd_ops.js

$id = $_GET["edit_proion"];
$onoma = "";
$proti_ili_id = "";

$query_onoma = "SELECT onoma, proti_ili_id FROM xProionta WHERE id=" . $id ;
$rs_onoma = odbc_exec($conn,$query_onoma);
if (!$rs_onoma) {echo $query; exit("Error in SQL");}

while (odbc_fetch_row($rs_onoma)) {
	$onoma = out(odbc_result($rs_onoma,"onoma"));
	$proti_ili_id = out(odbc_result($rs_onoma,"proti_ili_id"));
}

$query = "SELECT * FROM xProionta WHERE onoma='" . in($onoma) . "' ORDER BY minas";
$rs = odbc_exec($conn,$query);
if (!$rs) {echo $query; exit("Error in SQL");}

$sint_paragogis = "";
$sint_apovliton = "";
$sint_bod = "";
$sint_n = "";
$sint_p = "";
$minas = "";
?>

<form method="POST" onsubmit="Prionta.php">
	<input type=hidden name="edit_proion" value=<? echo $id; ?>>
	<table>
		<tr><td>ONOMA:</td><td><input type=text size="20" name="onoma" value="<? echo $onoma ?>" /></td></tr>
    <tr><td>ΠΡΩΤΗ ΥΛΗ:</td><td><? dropdown("xProtes_Iles", "onoma", "", $proti_ili_id) ?></td></tr>
		<tr><td>ΜΗΝΑΣ</td><td>ΣΥΝΤ ΠΑΡ</td><td>ΣΥΝΤ ΑΠΟ</td> <td>ΣΥΝΤ BOD</td> <td>ΣΥΝΤ Ν</td> <td>ΣΥΝΤ Π</td></tr>
<?
while (odbc_fetch_row($rs)) {
	$sint_paragogis = out(odbc_result($rs,"sint_paragogis"));
	$sint_apovliton = out(odbc_result($rs,"sint_apovliton"));
	$sint_bod = out(odbc_result($rs,"sint_bod"));
	$sint_n = out(odbc_result($rs,"sint_n"));
	$sint_p = out(odbc_result($rs,"sint_p"));
	$minas = out(odbc_result($rs,"minas"));
?>
		<tr>
		<td><? echo $minas ?></td>
		<td><input type=text size="8" name="sint_paragogis_<? echo $minas; ?>" value="<? echo $sint_paragogis ?>" /></td>
		<td><input type=text size="8" name="sint_apovliton_<? echo $minas; ?>" value="<? echo $sint_apovliton ?>" /></td>
		<td><input type=text size="8" name="sint_bod_<? echo $minas; ?>" value="<? echo $sint_bod ?>" /></td>
		<td><input type=text size="8" name="sint_n_<? echo $minas; ?>" value="<? echo $sint_n ?>" /></td>
		<td><input type=text size="8" name="sint_p_<? echo $minas; ?>" value="<? echo $sint_p ?>" /></td>
		</tr>		
<?
}
?>
		<tr><td><input name="SubmitBT" type=submit value="Ενημέρωση" /></td></tr>
	</table>
</form>  
<?
}


/***********
  Delete Proion
  **********/
if (isset($_GET["del_proion"])) { // called by proion_ops.js
	$id = $_GET["del_proion"];
?>

<form method="POST" onsubmit="Prionta.php">
	<input type=hidden name="del_proion" value=<? echo $id; ?>>
	Είστε σίγουροι πως θέλεται να διαγραφούν και οι 12 μήνες αυτού του Προιόντος; (id = <? echo $id; ?> );
	
	<tr><td><input name="yes" type=submit value="ΝΑΙ" /></td>
	<td><input name="no" type=submit value="ΟΧΙ" /></td></tr>
</form>
<?
}


/**********
  View Proion
  *********/
  
if (isset($_GET["view_proion"])) { // called by proionta_ops.js
?>
<table>
  <tr>
    <th>id</th>
		<th>ΜΗΝΑΣ</th>
    <th>ΟΝΟΜΑ</th>
    <th>ΠΡΩΤΗ ΥΛΗ</th>
    <th>ΣΥΝΤ ΠΑΡ</th>
    <th>ΣΥΝΤ ΑΠΟ</th>
    <th>ΣΥΝΤ BOD</th>
    <th>ΣΥΝΤ Ν</th>
    <th>ΣΥΝΤ Π</th>
  </tr>
<?
$query = "SELECT * FROM xProionta ORDER BY id";
$rs = odbc_exec($conn,$query);
if (!$rs) {exit("Error in SQL");}

while (odbc_fetch_row($rs)) {
  echo "<tr>";
  
  echo "<td>";
  echo out(odbc_result($rs,"id"));
  echo "</td>";

	echo "<td>";
  echo out(odbc_result($rs,"minas"));
  echo "</td>";
  
	echo "<td>";
  echo out(odbc_result($rs,"onoma"));
  echo "</td>";
	
  echo "<td>";
  $query_temp = "SELECT onoma FROM xProtes_Iles WHERE id=" .odbc_result($rs,"proti_ili_id");
  $rs_tmp = odbc_exec($conn,$query_temp);
  if (!$rs_tmp) {exit("Error in SQL");}
  echo out(odbc_result($rs_tmp,"onoma"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"sint_paragogis"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"sint_apovliton"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"sint_bod"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"sint_n"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"sint_p"));
  echo "</td>";
  	
  echo "</tr>";
}
	echo "</table>";
} // if (isset($_GET["view"]))