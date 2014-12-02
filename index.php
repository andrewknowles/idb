<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
   <head>
      <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
      <title>Dashboard - Home Page</title>
      <meta http-equiv="Content-Language" content="en-us" />
      <meta http-equiv="imagetoolbar" content="no" />
      <meta name="MSSmartTagsPreventParsing" content="true" />
      <meta name="description" content="Description" />
      <meta name="keywords" content="Keywords" />
      <meta name="author" content="Fred" />
      <style type="text/css" media="all">@import "css/idbmaster.css";</style>
      <script type="text/javascript">
         function select_company()
         {
         document.cpyname.submit();
         }
      </script>
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
         <h1>Irium Dashboard</h1>
         <?php
            session_start();
//These includes in turn include dbMylib2.php and 
            include('includes/Ifconnect.php');
            include('includes/Myconnect.php');
//Get list of companies from Informix database
            unset($_SESSION['cpy']);
            unset($_SESSION['companies']);
            include('CompanyList.php');
//initialise $_SESSION['error_flag']
            $_SESSION['error_flag'] = 0;
//$_SESSION['error_flag'] is set when a critical error occurs - in this case when the database connection fails
            if ($_SESSION['error_flag'] === 1)
            {
            	echo '<h2>Critical IDB Error No. 3 Program Halted</h2>';
            	unset($_SESSION['error_flag']);
            	exit;	
            }
            unset($_SESSION['branches']);
            
            unset($_SESSION['branch']);
            
            if (!isset($_SESSION['message1']))
            {
            $_SESSION['message'] = 'Please select a company';
            } else {
			$_SESSION['message'] = 'No Company Selected - Please select a company';
			}
            ?>
         <form name = 'cpyname' action = '' method='get'>
            <select name="company" onchange='select_company()'>
               <option value="">Select a company:</option>
               <?php
                  session_start();
                  foreach($_SESSION['companies'] as $x=>$x_value) {?>
               <option value="<?php echo "'".$x."'";?>"><?php echo $x_value;?></option>
               <?php }?>
            </select>
         </form>
         <h2><?php if(!isset($_GET['company'])) {echo $_SESSION['message']; } ?></h2>
         <?php
            //if user has clicked on a company
            if(isset($_GET['company']))
            {
            //create session variable for currently selected company - need to trim and remove extra '' returned by the GET
            $_SESSION['cpy'] = str_replace("'", "",trim($_GET['company']));
            //display the company name
            echo '<h2>Selected company is - '.$_SESSION['companies'][$_SESSION['cpy']].'</h2>';
            include('BranchList.php');
            }
            
            ?>

         <div id="menutable">
            <table>
               <col width="300">
               <col width="300">
               <col width="300">
               <col width="300">
               <col width="300">
               <tr>
                  <th>Parts</th>
                  <th>Service</th>
                  <th>Unit Sales</th>
                  <th>Finance</th>
                  <th>General</th>
               </tr>
               <tr>
                  <td><a href="quick_status.php">Quick Status</a></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><a href="query_editor2.php">Query Editor</a></td>
               </tr>
               <tr class="alt">
                  <td><a href="parts_report2.php">Control Reports</a></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
               </tr>
               <tr>
                  <td><a href="">Month End/WIP</a></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
               </tr>
               <tr class="alt">
                  <td><a href="">Stocks</a></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
               </tr>
               <tr>
                  <td><a href="">Sales</a></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
               </tr>
               <tr class="alt">
                  <td><a href="">Purchases</a></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
               </tr>
            </table>
         </div>
         <!--  <div id="footer">
            <div id="altnav">
               <a href="#">About</a> - 
               <a href="#">Services</a> - 
               <a href="#">Portfolio</a> - 
               <a href="#">Contact Us</a> - 
               <a href="#">Terms of Trade</a>
            </div>
            < Copyright © Almondway Consulting 2014 - Telephone: +33 6 46 48 58 48 - E Mail a.knowles@almondway.co.uk
         </div>-->
      </div>
   </body>
</html>
