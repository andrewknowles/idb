<?php
$res = odbc_exec($IfCLink, "select cpy.cpy_id, cpy.cpy_screen from  cpy  order by cpy.cpy_screen");
$_SESSION['companies'] = array();

while (odbc_fetch_row($res))
	{
		$code = trim(odbc_result($res, 1));
		$name = trim(odbc_result($res, 2));
		$_SESSION['companies'][$code]=$name;
	}
	
odbc_free_result($res);
odbc_close($IfCLink);

?>