<?php
session_start();
include ('helper.php');

$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
if (!$conn) {exit("Connection Failed: " . $conn);}
	
/*********************
 *********************
 Dimotiko Diamerisma
 *********************
 *********************
 *********************/
  
/*********
  New DD  
 *********/
if (isset($_GET["new_paragogi"])) { // called by dd_ops.js
  $paragogi= $_GET["new_paragogi"];
	
	//echo "PIGI ID = " . $paragogi;
	$eidos_pigis_id = "";
 
  // Find Protes Iles that correspond to the type of Pigi Ripansis
	$query = "SELECT eidos_pigis_id FROM xPigi_ripansis WHERE id=$paragogi";
	$rs = odbc_exec($conn,$query);
	if (!$rs) {exit("Error in SQL");}
	while (odbc_fetch_row($rs)) {
		$eidos_pigis_id = out(odbc_result($rs,"eidos_pigis_id"));
	}

?>
<form method="POST" onsubmit="Paragogi.php">
	<input type=hidden name="new_paragogi" >
	<table>
		<tr><td><input type=hidden name="onoma" value=<? echo $paragogi; ?>></td></tr>
		
    <tr><td>ΠΡΩΤΗ ΥΛΗ:</td><td><? dropdown("xProtes_Iles","onoma", "id IN (SELECT id FROM xProtes_Iles WHERE eidos_pigis_id=$eidos_pigis_id)", "");  ?></td></tr>
		<tr><td>ΠΟΣΟΤΗΤΑ ΠΥ:</td><td><input type=text size="8" name="posotita_py" /></td></tr>
		<tr><td>ΠΡΟΙΟΝ:</td><td><? dropdown_distinct("xProionta","onoma", "proti_ili_id IN (SELECT id FROM xProtes_Iles WHERE eidos_pigis_id=$eidos_pigis_id)", "");  ?></td></tr>
		<tr><td>ΜΗΝΑΣ:</td><td><input type=text size="4" name="minas" /></td></tr>
		<tr><td>ΕΤΟΣ:</td><td><input type=text size="4" name="etos" /></td></tr>
	</td></tr>
			
    <tr><td><input name="SubmitBT" type=submit value="Καταχώρηση" /></td></tr>
	</table>
</form>
<?
} // if (isset($_GET["new_paragogi"]))



/***********
  Edit DD
  **********/
if (isset($_GET["edit_dd"])) { // called by dd_ops.js

$id = $_GET["edit_dd"];

$query = "SELECT * FROM xDim_Diamerisma WHERE id=" . $id ;
$rs = odbc_exec($conn,$query);
if (!$rs) {exit("Error in SQL");}

$onoma = "";
$dimos = "";
$emv = "";
$ohp = "";
$plith = "";
$sint = "";
$klines = "";
$adv = "";
$eel = "";

while (odbc_fetch_row($rs)) {
	$onoma = out(odbc_result($rs,"onoma"));
	$dimos = out(odbc_result($rs,"dimos_id"));
	$emv = out(odbc_result($rs,"emvado"));
	$ohp = out(odbc_result($rs,"ohp"));
	$plith = out(odbc_result($rs,"plithismos_2001"));
	$sint = out(odbc_result($rs,"sintelestis"));
	$klines = out(odbc_result($rs,"arithm_klinon"));
	$adv = out(odbc_result($rs,"ADV"));
	$eel = out(odbc_result($rs,"eel_id"));
}
?>
<form method="POST" onsubmit="DD_D_N.php">
	<input type=hidden name="edit_dd" value=<? echo $id; ?>>
	<table>
		<tr><td>ONOMA:</td><td><input type=text size="20" name="onoma" value="<? echo $onoma ?>" /></td></tr>
    <tr><td>ΔΗΜΟΣ:</td><td><? dropdown("xDimos", "onoma", "", $dimos) ?></td></tr>
		<tr><td>ΕΜΒΑΔΟ:</td><td><input type=text size="20" name="emv" value="<? echo $emv ?>" /></td></tr>
		<tr><td>ΟΗΠ:</td><td><input type=text size="20" name="ohp" value="<? echo $ohp ?>" /></td></tr>
		<tr><td>ΠΛΗΘΥΣΜΟΣ:</td><td><input type=text size="20" name="plith" value="<? echo $plith ?>" /></td></tr>
		<tr><td>ΣΥΝΤΕΛΕΣΤΗΣ:</td><td><input type=text size="20" name="sint" value="<? echo $sint ?>" /></td></tr>
		<tr><td>ΑΡ. ΚΛΙΝΩΝ:</td><td><input type=text size="20" name="klines" value="<? echo $klines ?>" /></td></tr>
		<tr><td>ADV:</td><td><input type=text size="20" name="adv" value="<? echo $adv ?>" /></td></tr>
		<tr><td>ΕΕΛ:</td><td>
    <?
      // Find EEL eidos_pigis ID
      $query_tmp = "SELECT id FROM xEidos_pigis_ripansis WHERE onoma='". in("ΕΕΛ") . "'";
      $rs_tmp = odbc_exec($conn,$query_tmp);
      if (!$rs_tmp) {exit("Error in SQL");}
      
			$eidos = " ";
      while (odbc_fetch_row($rs_tmp)) {
        $eidos = out(odbc_result($rs_tmp,"id"));
      }
			dropdown("xPigi_ripansis", "onoma", "eidos_pigis_id=$eidos", $eel);	  
	?>
	</td></tr>
			
    <tr><td><input name="SubmitBT" type=submit value="Ενημέρωση" /></td></tr>
	</table>
</form>  
<?
}


/***********
  Delete DD
  **********/
if (isset($_GET["del_dd"])) { // called by dd_ops.js
	$id = $_GET["del_dd"];
?>

<form method="POST" onsubmit="DD_D_N.php">
	<input type=hidden name="del_dd" value=<? echo $id; ?>>
	Είστε σίγουροι πως θέλεται να διαγραφεί αυτό το ΔΔ (id = <? echo $id; ?> );
	
	<tr><td><input name="yes" type=submit value="ΝΑΙ" /></td>
	<td><input name="no" type=submit value="ΟΧΙ" /></td></tr>
</form>
<?
}


/**********
  View DD
  *********/
  
if (isset($_GET["view_dd"])) { // called by dd_ops.js
?>
<table>
  <tr>
    <th>id</th>
    <th>dimos</th>
    <th>onoma</th>
    <th>emvado</th>
    <th>ohp</th>
    <th>plith</th>
    <th>sint</th>
    <th>tour</th>
    <th>adv</th>
    <th>ell</th>
  </tr>
<?
$query = "SELECT * FROM xDim_Diamerisma ORDER BY id DESC";
$rs = odbc_exec($conn,$query);
if (!$rs) {exit("Error in SQL");}

while (odbc_fetch_row($rs)) {
  echo "<tr>";
  
  echo "<td>";
  echo out(odbc_result($rs,"id"));
  echo "</td>";
  
  echo "<td>";
  $query_temp = "SELECT onoma FROM xDimos WHERE id=" .odbc_result($rs,"dimos_id");
  $rs_tmp = odbc_exec($conn,$query_temp);
  if (!$rs_tmp) {exit("Error in SQL");}
  echo out(odbc_result($rs_tmp,"onoma"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"onoma"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"emvado"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"ohp"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"plithismos_2001"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"sintelestis"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"arithm_klinon"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"adv"));
  echo "</td>";
  
  echo "<td>";
  $query_temp = "SELECT onoma FROM xPigi_ripansis WHERE id=" . out(odbc_result($rs,"eel_id"));
  $rs_tmp = odbc_exec($conn,$query_temp);
  if (!$rs_tmp) {exit("Error in SQL");}
  echo out(odbc_result($rs_tmp,"onoma"));
  echo "</td>";
	
  echo "</tr>";
}
	echo "</table>";
} // if (isset($_GET["view"]))


/******************
 ******************
  Dimos
 ******************
 ******************/

/***********
  New Dimos
 ***********/
  
if (isset($_GET["new_dimos"])) { // called by dd_ops.js
  $dimos = $_GET["new_dimos"];
  
  $query = "SELECT * FROM xDimos WHERE onoma='". in($dimos) . "'";
  $rs = odbc_exec($conn,$query);
  if (!$rs) {exit("Error in SQL");}		
  
  $num_rows=0;
  while($temp = odbc_fetch_into($rs,&$counter)) $num_rows++;
  
  if ($num_rows > 0) {
    echo "Το όνομα του Δήμου που εισάγατε είναι ήδη καταχωρημένο";
  }
  else {
?>
<form method="POST" onsubmit="DD_D_N.php">
	<input type=hidden name="new_dimos" >
	<table>
		<tr><td><input type=hidden name="onoma" value=<? echo $dimos; ?>></td></tr>
		<tr><td>ONOMA: <? echo $dimos; ?></td></tr>
    <tr><td>ΝΟΜΟΣ:</td><td><? dropdown("xNomos","onoma", "", "");  ?></td></tr>
		<tr><td>ΕΜΒΑΔΟ:</td><td><input type=text size="20" name="emv" /></td></tr>
		<tr><td>% ΛΕΚΑΝΗ:</td><td><input type=text size="20" name="poslek" /></td></tr>
		<tr><td>ΕΜΒΑΔΟ ΛΕΚΑΝΗ:</td><td><input type=text size="20" name="emvlek" /></td></tr>		
    <tr><td><input name="SubmitBT" type=submit value="Καταχώρηση" /></td></tr>
	</table>
</form>  
<?
}
} // if (isset($_GET["new_dimos"])) {


/*************
  Edit Dimos
  ************/
if (isset($_GET["edit_dimos"])) { // called by dd_ops.js

$id = $_GET["edit_dimos"];

$query = "SELECT * FROM xDimos WHERE id=" . $id ;
$rs = odbc_exec($conn,$query);
if (!$rs) {exit("Error in SQL");}

$onoma = "";
$dimos = "";
$emv = "";
$poslek = "";
$emvlek = "";

while (odbc_fetch_row($rs)) {
	$onoma = out(odbc_result($rs,"onoma"));
	$dimos = out(odbc_result($rs,"nomos_id"));
	$emv = out(odbc_result($rs,"emvado"));
	$poslek = out(odbc_result($rs,"posostostilek"));
	$emvlek = out(odbc_result($rs,"emvadostilek"));
}
?>
<form method="POST" onsubmit="DD_D_N.php">
	<input type=hidden name="edit_dimos" value=<? echo $id; ?>>
	<table>
		<tr><td>ONOMA:</td><td><input type=text size="20" name="onoma" value="<? echo $onoma ?>" /></td></tr>
    <tr><td>ΝΟΜΟΣ:</td><td><? dropdown("xNomos", "onoma", "", $nomos) ?></td></tr>
		<tr><td>ΕΜΒΑΔΟ:</td><td><input type=text size="20" name="emv" value="<? echo $emv ?>" /></td></tr>
		<tr><td>% ΛΕΚΑΝΗ:</td><td><input type=text size="20" name="poslek" value="<? echo $poslek ?>" /></td></tr>
		<tr><td>ΕΜΒ ΛΕΚΑΝΗ:</td><td><input type=text size="20" name="emvlek" value="<? echo $emvlek ?>" /></td></tr>
			
    <tr><td><input name="SubmitBT" type=submit value="Ενημέρωση" /></td></tr>
	</table>
</form>  
<?
}
?>

<?
/***************
  Delete Dimos
 ***************/
if (isset($_GET["del_dimos"])) { // called by dd_ops.js
	$id = $_GET["del_dimos"];
?>

<form method="POST" onsubmit="DD_D_N.php">
	<input type=hidden name="del_dimos" value=<? echo $id; ?>>
	Είστε σίγουροι πως θέλεται να διαγραφεί αυτός ο Δήμος(id = <? echo $id; ?> );
	
	<tr><td><input name="yes" type=submit value="ΝΑΙ" /></td>
	<td><input name="no" type=submit value="ΟΧΙ" /></td></tr>
</form>
<?
}
?>

<?
/************
  View Dimos
 ************/

if (isset($_GET["view_dimos"])) { // called by dd_ops.js
?>
<table>
  <tr>
    <th>id</th>
    <th>nomos</th>
    <th>onoma</th>
    <th>emvado</th>
    <th>% lek</th>
    <th>emv lek</th>
  </tr>
  
<?
$query = "SELECT * FROM xDimos ORDER BY id DESC";
$rs = odbc_exec($conn,$query);
if (!$rs) {exit("Error in SQL");}

while (odbc_fetch_row($rs)) {
  echo "<tr>";
  
  echo "<td>";
  echo out(odbc_result($rs,"id"));
  echo "</td>";
  
  echo "<td>";
  $query_temp = "SELECT onoma FROM xNomos WHERE id=" .odbc_result($rs,"nomos_id");
  $rs_tmp = odbc_exec($conn,$query_temp);
  if (!$rs_tmp) {exit("Error in SQL");}
  echo out(odbc_result($rs_tmp,"onoma"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"onoma"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"emvado"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"posostostilek"));
  echo "</td>";
  
  echo "<td>";
  echo out(odbc_result($rs,"emvadostilek"));
  echo "</td>";
  
  echo "</tr>";
}
	echo "</table>";
} // if (isset($_GET["view"]))


/******************
 ******************
  Nomos
 ******************
 ******************/

/************
  New Nomos
 ************/
 
if (isset($_GET["new_nomos"])) { // called by dd_ops.js
  $nomos = $_GET["new_nomos"];
  
  $query = "SELECT * FROM xNomos WHERE onoma='". in($nomos) . "'";
  $rs = odbc_exec($conn,$query);
  if (!$rs) {exit("Error in SQL");}		
  
  $num_rows=0;
  while($temp = odbc_fetch_into($rs,&$counter)) $num_rows++;
  
  if ($num_rows > 0) {
    echo "Το όνομα του Νομού που εισάγατε είναι ήδη καταχωρημένο";
  }
  else {
?>
<form method="POST" onsubmit="DD_D_N.php">
	<input type=hidden name="new_nomos" >
	<table>
		<tr><td><input type=hidden name="onoma" value=<? echo $nomos; ?>></td></tr>
		<tr><td>ONOMA: <? echo $nomos; ?></td></tr>
    <tr><td><input name="SubmitBT" type=submit value="Καταχώρηση" /></td></tr>
	</table>
</form>
<?
}
} // if (isset($_GET["new_nomos"])) {


/*************
  Edit Nomos
 *************/

if (isset($_GET["edit_nomos"])) { // called by dd_ops.js

$id = $_GET["edit_nomos"];

$query = "SELECT * FROM xNomos WHERE id=" . $id ;
$rs = odbc_exec($conn,$query);
if (!$rs) {exit("Error in SQL");}

$onoma = "";

while (odbc_fetch_row($rs)) {
	$onoma = out(odbc_result($rs,"onoma"));
}
?>
<form method="POST" onsubmit="DD_D_N.php">
	<input type=hidden name="edit_nomos" value=<? echo $id; ?>>
	<table>
		<tr><td>ONOMA:</td><td><input type=text size="20" name="onoma" value="<? echo $onoma ?>" /></td></tr>
    <tr><td><input name="SubmitBT" type=submit value="Ενημέρωση" /></td></tr>
	</table>
</form>  
<?
}
?>

<?
/***************
  Delete Nomos
 ***************/
  
if (isset($_GET["del_nomos"])) { // called by dd_ops.js
	$id = $_GET["del_nomos"];
?>

<form method="POST" onsubmit="DD_D_N.php">
	<input type=hidden name="del_nomos" value=<? echo $id; ?>>
	Είστε σίγουροι πως θέλεται να διαγραφεί αυτός ο Νομός (id = <? echo $id; ?> );
	
	<tr><td><input name="yes" type=submit value="ΝΑΙ" /></td>
	<td><input name="no" type=submit value="ΟΧΙ" /></td></tr>
</form>
<?
}
?>

<?
/*************
  View Nomos
 *************/
if (isset($_GET["view_nomos"])) { // called by dd_ops.js
?>
<table>
  <tr>
    <th>id</th>
    <th>onoma</th>
  </tr>
  
<?
$query = "SELECT * FROM xNomos ORDER BY id DESC";
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
 
  echo "</tr>";
}
	echo "</table>";
} // if (isset($_GET["view"]))
?>