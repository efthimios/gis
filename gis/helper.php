<?
session_start();
//Database encoding conversion functions
// insert to db
function in($in) {
	$out = iconv ("UTF-8", "windows-1253", $in);	
  return $out;
}
	
// extract from db
function out($in) {
  $out = iconv ("windows-1253", "UTF-8", $in);
  return $out;
}

// Form drop-down menu
function dropdown($table, $column, $where, $preselected) {
  $conn=odbc_connect('gis','admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}
  
  $query = "SELECT id,$column FROM $table";
  if ($where != "") {
    $query .= " WHERE " . $where;
  }
  
  //echo "<br>QUERY = " . $query;
  //echo "<br>PRESELECTED = " . $preselected;

  $rs = odbc_exec($conn,$query);
  if (!$rs) {exit("Error in SQL");}		
  
  $dropd = "<select name=" . $table . ">";
  while (odbc_fetch_row($rs)) {
    $id = odbc_result($rs,"id");
    $col = out(odbc_result($rs,$column));
		if (($preselected != "") && ($preselected == $id)) {
			$dropd .= "<option value=" . $id. " selected>" . $col ."</option>";
		}
		else {
			$dropd .= "<option value=" . $id. ">" . $col ."</option>";
		}
  }    
  $dropd .= '</select>';
  
  echo $dropd;
}

// Form DISTINCT drop-down menu
function dropdown_distinct($table, $column, $where, $preselected) {
  $conn=odbc_connect('gis','Admin','',SQL_CUR_USE_ODBC);
  if (!$conn) {exit("Connection Failed: " . $conn);}
  	
	$onomata = array();
	$preselected_onoma = "";

  $query_distinct = "SELECT DISTINCT $column FROM $table ";
  if ($where != "") {
    $query_distinct .= " WHERE " . $where;
  }
	 
  $rs_distinct = odbc_exec($conn,$query_distinct);
  if (!$rs_distinct) {exit("Error in SQL");}		
  
	while (odbc_fetch_row($rs_distinct)) {
		$onomata[] = out(odbc_result($rs_distinct,$column));
	}
	//print_r($onomata);
	$count = count($onomata);
	
	$dropd = "<select name=" . $table . ">";
	
	for ($i=0;$i<$count;$i++) {
	
		$query = "SELECT id,$column FROM $table WHERE $column='" . in($onomata[$i]) . "'";
//		echo $query;

		$rs = odbc_exec($conn,$query);
		if (!$rs) {exit("Error in SQL");}
		
		while (odbc_fetch_row($rs)) {
			$id = odbc_result($rs,"id");			
			$col = out(odbc_result($rs,$column));
			if ($preselected != "") {
				$query_presel= "SELECT $column FROM $table WHERE id=$preselected";
				$rs_presel = odbc_exec($conn,$query_presel);
				if (!$rs_presel) {exit("Error in SQL");}		
				
				while (odbc_fetch_row($rs_presel)) {
					$preselected_onoma = out(odbc_result($rs_presel,$column));
				}
				
				if ($preselected_onoma == $column) {
					$dropd .= "<option value=" . $id. " selected>" . $col ."</option>";
				}
			}
			else {
				$dropd .= "<option value=" . $id. ">" . $col ."</option>";
			}
			break;
		}
	}
	
	$dropd .= '</select>';
		
	echo $dropd;
}

 
?>