<?
session_start();
include ('helper.php');

$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
if (!$conn) {exit("Connection Failed: " . $conn);}
	
/*********************
 *********************
 Eidos Pigis Ripansis
 *********************
 *********************
 *********************/
  
/*********
  New Eidos  
 *********/
if (isset($_GET["new_eidos"])) { // called by eidos_ops.js
  $eidos= $_GET["new_eidos"];
  
  $query = "SELECT * FROM xEidos_pigis_ripansis WHERE onoma='". in($eidos) . "'";
  $rs = odbc_exec($conn,$query);
  if (!$rs) {exit("Error in SQL");}		
  
  $num_rows=0;
  while($temp = odbc_fetch_into($rs,&$counter)) $num_rows++;
  
  if ($num_rows > 0) {
    echo "Το όνομα του Είδους που εισάγατε είναι ήδη καταχωρημένο";
  }
  else {
?>
<form method="POST" onsubmit="Eidos_Pigis.php">
	<input type=hidden name="new_eidos" >
	<table>
		<tr><td><input type=hidden name="onoma" value=<? echo $eidos; ?>></td></tr>
		<tr><td>ΟΝΟΜΑ: <? echo $eidos; ?></td></tr>
		<tr>
		<input type="radio" name="simiaki" value="simiaki" checked="checked"/> Σημιακή
		<br />
		<input type="radio" name="simiaki" value="diaxiti" /> Διάχυτη
		</tr>
    <tr><td><input name="SubmitBT" type=submit value="Καταχώρηση" /></td></tr>
	</table>
</form>  
<?
}
} // if (isset($_GET["new_eidos"])) {


/***********
  Edit Eidos
  **********/
if (isset($_GET["edit_eidos"])) { // called by eidos_ops.js

$id = $_GET["edit_eidos"];

$query = "SELECT * FROM xEidos_pigis_ripansis WHERE id=" . $id ;
$rs = odbc_exec($conn,$query);
if (!$rs) {exit("Error in SQL");}

$onoma = "";
$simiaki = "";

while (odbc_fetch_row($rs)) {
	$onoma = out(odbc_result($rs,"onoma"));
	$simiaki = out(odbc_result($rs,"simiaki"));
}
?>
<form method="POST" onsubmit="Eidos_Pigis.php">
	<input type=hidden name="edit_eidos" value=<? echo $id; ?>>
	<table>
		<tr><td>ΟΝΟΜΑ:</td><td><input type=text size="20" name="onoma" value="<? echo $onoma ?>" /></td></tr>
		<tr>
		<input type="radio" name="simiaki" value="simiaki" <? if ($simiaki == 1) echo 'checked="checked"'; ?>/> Σημιακή
		<br />
		<input type="radio" name="simiaki" value="diaxiti" <? if ($simiaki == 0) echo 'checked="checked"'; ?>/> Διάχυτη
		</tr>
    <tr><td><input name="SubmitBT" type=submit value="Ενημέρωση" /></td></tr>
	</table>
</form>  
<?
}


/***********
  Delete Eidos
  **********/
if (isset($_GET["del_eidos"])) { // called by eidos_ops.js
	$id = $_GET["del_eidos"];
?>

<form method="POST" onsubmit="Eidos_Pigis.php">
	<input type=hidden name="del_eidos" value=<? echo $id; ?>>
	Είστε σίγουροι πως θέλεται να διαγραφεί αυτό το Είδος (id = <? echo $id; ?> );
	
	<tr><td><input name="yes" type=submit value="ΝΑΙ" /></td>
	<td><input name="no" type=submit value="ΟΧΙ" /></td></tr>
</form>
<?
}


/**********
  View Eidos
  *********/
  
if (isset($_GET["view_eidos"])) { // called by eidos_ops.js
?>
<table>
  <tr>
    <th>id</th>
    <th>onoma</th>
    <th>simiaki</th>
  </tr>
<?
$query = "SELECT * FROM xEidos_pigis_ripansis ORDER BY id";
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
  echo out(odbc_result($rs,"simiaki"));
  echo "</td>";

  echo "</tr>";
}
	echo "</table>";
} // if (isset($_GET["view_eidos"]))
?>