<?php
session_start();
if (!isset($_SESSION["uname"])) {
  session_register ("uname");
}
	
include ('helper.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>DD</title>
<style type="text/css">
<!--
body {
	background-image: url();
	background-repeat: no-repeat;
  background-color: #99CCCC;
}
-->
</style></head>

<div align=center>
<title>Login</title>

<?php
	if (isset($_POST["username"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];

		$conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
		if (!$conn) {exit("Connection Failed: " . $conn);}
			
		$query = "SELECT username, dikaioma FROM xProsvasi WHERE username='" . $username . "' AND password='" . $password . "' ORDER BY dikaioma";
		$rs = odbc_exec($conn,$query);
		if (!$rs) {exit("Error in SQL");}
		
		/**************************************
		*  Gets number of rows of resultset   *
		**************************************/
		$num_rows=0;
		while($temp = odbc_fetch_into($rs,&$counter)) $num_rows++;
		
		if ($num_rows < 1) {
			echo "ΔΕΝ ΒΡΕΘΗΚΕ Ο ΧΡΗΣΤΗΣ " . $username;
			echo '<p><a href="login.php">Επιστροφή</a>';
		}
		else {
			$_SESSION["uname"] = odbc_result($rs,"username");
			$col_value2 = odbc_result($rs,"dikaioma");
			if ($col_value2 == '5') {
				echo '<meta http-equiv="refresh" content="0;URL=frameset.php">';
			}
			else {
				echo '<meta http-equiv="refresh" content="0;URL=frameset_0.php">';
			}
		}
	}
	else {
?>
  <p><strong>
  <!--  
  ΕΙΣΑΓΕΤΕ ΟΝΟΜΑ ΧΡΗΣΤΗ ΚΑΙ ΚΩΔΙΚΟ ΠΡΟΣΒΑΣΗΣ</strong></p>
  <p><strong> ΓΙΑ ΤΙΣ ΑΤΟΜΙΚΕΣ ΣΑΣ ΣΕΛΙΔΕΣ</strong></p>
  <p>&nbsp; </p>
  -->
  <form action="login.php" method="post" name="access_form">
  <table>
    <tr>
      <td><strong>Username</strong>:</td>
      <td><input type=text size="20" maxlength="10" name="username" /></td>
    </tr>
    <tr>
      <td><strong>Password</strong>:</td>
      <td><input type=password size="20" maxlength="10" name="password" /></td>
    </tr>
    <tr>
      <td colspan=2 align="center"><input name="Submit" type=submit id="SubmitBT" value="Είσοδος" />
        &nbsp;
        <input name="ResetBT" type=reset id="ResetBT" value="Καθαρισμος" />      </td>
    </tr>
  </table>
</form>
<?php
}
?>	
</div>
</html>