<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title>Almondway Consultanting - Home Page</title>
    <meta http-equiv="Content-Language" content="en-us" />
    
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    
    <meta name="description" content="Description" />
    <meta name="keywords" content="Keywords" />
    
    <meta name="author" content="Almondway Consultants" />
    <style type="text/css" media="all">@import "css/idbmaster.css";</style>  


</head>

<body>
<div id="page-container">

    <div id="main-nav">
   		 <dl>
			<dt id="about"><a href="#">About</a></dt>
			<dt id="services"><a href="#">Services</a></dt>
			<dt id="portfolio"><a href="#">Portfolio</a></dt>
			<dt id="contact"><a href="#">Contact Us</a></dt>
		</dl>
	</div>

    <div id="header">
		<!--  <h1><img src="images/almonddway1.png" 
		width="600" height="64" alt="Almondway Consulting" border="0" /></h1>-->
	</div>
<button type="button" onClick="window.location='index.php';"> HOME </button>
<h1> Parts Reports</h1>

</div>
<form action="report_run.php" method ="post">
<div id="reporttable">
<table>
<tr><td>
<select name="branches">
<option value="">Select a branch:</option>
<?php
$allbranch = '';
if (!isset($_SESSION['branches']))
{
echo 'xxxxxy';
exit;	
} else {
var_dump($_SESSION['branches']);
echo 'aa';
exit;
foreach($_SESSION['branches'] as $x=>$x_value) {
$allbranch = $allbranch."'".$x_value['bra_id']."',";
}
?>
<option value="<?php 

echo "'".$x_value['bra_id']."'";?>"><?php echo $x_value['cpy_screen'].'-'.$x_value['bra_screen'];?></option><?php 
}
?>
<option value="<?php 
$allbranch = substr($allbranch,0,(strlen($allbranch)-1));
echo $allbranch; ?>">All Branches</option>

</select></td>
<td>
<input type="checkbox" name="idb_part_report[]" value="DelNotInv">Delivered Not Invoiced</td></tr>
<tr><td></td><td>
<input type="checkbox" name="idb_part_report[]" value="InvNotPrint">Invoiced Not Printed</td></tr> 
<tr><td></td><td>
<input type="checkbox" name="idb_part_report[]" value="InvNotInt">Invoiced Not Integrated</td></tr> 
<tr><td></td><td>
<input type="checkbox" name="idb_part_report[]" value="RecNotInt">Receipt Not Integrated</td></tr> 
<tr><td></td><td>
<input type="submit" value="Submit"></td></tr> 
</table>
</div>
</form>

</body>