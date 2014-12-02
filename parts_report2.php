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

<!--  <select name="branches">
<option value="">Select a branch:</option>-->
<form action="report_run.php" method ="post">

<?php
session_start();
         include('includes/validation.php');
         if(!isset($_SESSION['cpy']))
          { 
          	$_SESSION['message1'] = 'No Company Selected - Please select a company';
			header ("Location: index.php");
          }
       

         if(isset($_SESSION['cpy']))
         {
         validatecompany($_SESSION['cpy']);
         
         if ($_SESSION['error_flag'] ==1)
         {
         	echo '<h2>Critical IDB Error No. 3 Program Halted</h2>';
         	unset($_SESSION['error_flag']);
         	exit;
         }
         
         if (!isset($_SESSION['branches']))
         {
         	echo '<h2>Critical IDB Error No. 10 Program Halted</h2>';
         	unset($_SESSION['error_flag']);
         	exit;
         } else {
         echo '<h2>Selected company is - '.$_SESSION['companies'][$_SESSION['cpy']].'</h2>';
          } ?>

            <select  name="branches" onchange="SelectBranch(this.value)">
               <option value="">Select a branch:</option>
               <?php
                  foreach($_SESSION['branches'] as $x=>$x_value) {
                  ?>
               <option value="<?php echo "'".$x."'";?>"><?php echo $x_value;?></option>
               <?php }} ?>
               <option value="allbr"> All Branches</option>
            </select>




<div id="reporttable">
<table>
<tr><td>
<div id="reporttable">
<table>
<tr>
<td><input type="checkbox" name="idb_part_report[]" value=5>Part Lines On Wait</td>
<td><input type="checkbox" name="idb_part_report[]" value=22>Part Lines On Req.</td>
</tr>
<tr>
<td><input type="checkbox" name="idb_part_report[]" value=24>Part Lines On Transfer</td>
<td><input type="checkbox" name="idb_part_report[]" value=26>Part Lines On Transfer 2</td>
</tr>
<tr>
<td><input type="checkbox" name="idb_part_report[]" value=23>Proforma Invoice Not Cancelled</td>
<td><input type="checkbox" name="idb_part_report[]" value=9>Part Lines Delivered Not Invoiced</td>
</tr>
<tr>
<td><input type="checkbox" name="idb_part_report[]" value=11>Invoices Generated Not Printed</td>
<td><input type="checkbox" name="idb_part_report[]" value=27>Invoices Printed Not Integrated</td>
</tr>
<tr>
<td><input type="checkbox" name="idb_part_report[]" value=8>Receipts In Progress</td>
<td><input type="checkbox" name="idb_part_report[]" value=7>Receipts Not Integrated</td>
</tr>
<tr>
<td><input type="checkbox" name="idb_part_report[]" value=16>PO Invoices In Progress</td>
<td><input type="checkbox" name="idb_part_report[]" value=6>PO Invoices Not Integrated</td>
<tr><td></td><td>
<input type="submit" value="Submit"></td></tr> 
</table>
</div>
</form>

</body>
