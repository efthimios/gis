<?
session_start();
include ('helper.php');

$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
if (!$conn) {exit("Connection Failed: " . $conn);}
	
/*********************
 *********************
 Pigi Ripansis
 *********************
 *********************
 *********************/
  
/*********
  New Pigi  
 *********/
if (isset($_GET["new_pigi"])) { // called by eidos_ops.js
  $pigi= $_GET["new_pigi"];
  
  $query = "SELECT * FROM xPigi_ripansis WHERE onoma='". in($pigi) . "'";
  $rs = odbc_exec($conn,$query);
  if (!$rs) {exit("Error in SQL");}		
  
  $num_rows=0;
  while($temp = odbc_fetch_into($rs,&$counter)) $num_rows++;
  
  if ($num_rows > 0) {
    echo "Το όνομα της Πηγής Ρύπανσης που εισάγατε είναι ήδη καταχωρημένο";
  }
  else {
?>
<form method="POST" onsubmit="Pigi_Ripansis.php">
	<input type=hidden name="new_pigi" >
	<table>
		<tr><td><input type=hidden name="onoma" value=<? echo $pigi; ?>></td></tr>
		<tr><td>ΟΝΟΜΑ: </td><td><? echo $pigi; ?></td></tr>
		<tr><td>ΤΗΛ: </td><td><input type=text size="10" name="til"/></td>
		<tr><td>ΔΔ:</td><td><? dropdown("xDim_Diamerisma","onoma", "", "");  ?></td></tr>
		<tr><td>ΛΕΙΤΟΥΡΓΙΑ: </td>
		<input type="radio" name="leitourgei" value="nai" checked="checked"/> Λειτουργεί
		<br />
		<input type="radio" name="leitourgei" value="oxi" /> Δεν Λειτουργεί
		</tr>
		<tr><td>ΕΙΔΟΣ ΠΗΓΗΣ: </td><td><? dropdown("xEidos_pigis_ripansis","onoma", "", "");  ?></td></tr>
		<tr><td>ΣΥΝΤ Χ: </td><td><input type=text size="8" name="X"/></td></td></tr>
		<tr><td>ΣΥΝΤ Υ: </td><td><input type=text size="8" name="Y"/></td></td></tr>
		
    <tr><td><input name="SubmitBT" type=submit value="Καταχώρηση" /></td></tr>
	</table>
</form>  
<?
}
} // if (isset($_GET["new_pigi"])) {


/***********
  Edit Pigi
  **********/
if (isset($_GET["edit_pigi"])) { // called by eidos_ops.js

$id = $_GET["edit_pigi"];

$query = "SELECT * FROM xPigi_ripansis WHERE id=" . $id ;
$rs = odbc_exec($conn,$query);
if (!$rs) {exit("Error in SQL");}

$onoma = "";
$leitourgei = "";

while (odbc_fetch_row($rs)) {
	$onoma = out(odbc_result($rs,"onoma"));
	$leitourgei = out(odbc_result($rs,"leitourgei"));
}
?>
<form method="POST" onsubmit="Pigi_Ripansis.php">
	<input type=hidden name="edit_pigi" value=<? echo $id; ?>>
	<table>
		<tr><td>ΟΝΟΜΑ:</td><td><input type=text size="20" name="onoma" value="<? echo $onoma ?>" /></td></tr>
		<tr><td>ΤΗΛ:</td><td><input type=text size="20" name="til" value="<? echo out(odbc_result($rs,"til")) ?>" /></td></tr>
		<tr><td>ΔΗΜ.ΔΙΑΜ.:</td><td><? dropdown("xDim_Diamerisma", "onoma", "", odbc_result($rs,"dim_diamerisma_id")) ?></td></tr>
		<tr>
		<input type="radio" name="leitourgei" value="nai" <? if ($leitourgei == 1) echo 'checked="checked"'; ?>/> Λειτουργεί
		<br />
		<input type="radio" name="leitourgei" value="oxi" <? if ($leitourgei == 0) echo 'checked="checked"'; ?>/> Δεν Λειτουργεί
		</tr>
		<tr><td>ΕΙΔΟΣ ΠΗΓΗΣ:</td><td><? dropdown("xEidos_pigis_ripansis", "onoma", "", odbc_result($rs,"eidos_pigis_id")) ?></td></tr>
		<tr><td>Χ:</td><td><input type=text size="8" name="X" value="<? echo out(odbc_result($rs,"X")) ?>" /></td></tr>
		<tr><td>Υ:</td><td><input type=text size="8" name="Y" value="<? echo out(odbc_result($rs,"Y")) ?>" /></td></tr>
		
    <tr><td><input name="SubmitBT" type=submit value="Ενημέρωση" /></td></tr>
	</table>
</form>  
<?
}


/***********
  Delete Pigi 
  **********/
if (isset($_GET["del_pigi"])) { // called by eidos_ops.js
	$id = $_GET["del_pigi"];
?>

<form method="POST" onsubmit="Pigi_Ripansis.php">
	<input type=hidden name="del_pigi" value=<? echo $id; ?>>
	Είστε σίγουροι πως θέλεται να διαγραφεί αυτή τη Πηγή Ρύπανσης (id = <? echo $id; ?> );
	
	<tr><td><input name="yes" type=submit value="ΝΑΙ" /></td>
	<td><input name="no" type=submit value="ΟΧΙ" /></td></tr>
</form>
<?
}


/**********
  View Pigi
  *********/
  
if (isset($_GET["view_pigi"])) { // called by eidos_ops.js
?>
<table>
  <tr>
    <th>id</th>
    <th>onoma</th>
		<th>til</th>
		<th>dim_diamerisma_id</th>
		<th>leitourgei</th>
		<th>eidos_pigis_id</th>
		<th>X</th>
		<th>Y</th>
  </tr>
<?
$query = "SELECT * FROM xPigi_ripansis ORDER BY id";
$rs = odbc_exec($conn,$query);
if (!$rs) {exit("Error in SQL");}

while (odbc_fetch_row($rs)) {
  echo "<tr>";
  
  echo "<td>";
  echo out(odbc_result($rs,"id"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"onoma"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"til"));
  echo "</td>";
	
	echo "<td>";
  echo out(odbc_result($rs,"dim_diamerisma_id"));
  echo "</td>";
	
	echo "<td>";
  echo out(odbc_result($rs,"leitourgei"));
  echo "</td>";
	
	echo "<td>";
  echo out(odbc_result($rs,"eidos_pigis_id"));
  echo "</td>";
	
	echo "<td>";
  echo out(odbc_result($rs,"X"));
  echo "</td>";
	
	echo "<td>";
  echo out(odbc_result($rs,"Y"));
  echo "</td>";
	
  echo "</tr>";
}

echo "</table>";
} // if (isset($_GET["view_pigi"]))
?>