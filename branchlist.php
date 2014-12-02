<?php

$res = odbc_exec($IfCLink, "select bra.bra_id, bra.bra_screen from bra where bra.cpy_id = '".$_SESSION['cpy']."' order by bra.bra_screen");

$_SESSION['branches'] = array();

while(odbc_fetch_row( $res))
	{
		$code = trim(odbc_result($res, 1));
		$name = trim(odbc_result($res, 2));
		$_SESSION['branches'][$code]=$name;
	}
	
odbc_free_result($res);
//odbc_close($IfCLink);
?>