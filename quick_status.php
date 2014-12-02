<html>
   <head>
      <script>
         function SelectBranch(str) {
           if (str=="") {
             document.getElementById("txtHint").innerHTML="";
             return;
           } 
           if (window.XMLHttpRequest) {
             // code for IE7+, Firefox, Chrome, Opera, Safari
             xmlhttp=new XMLHttpRequest();
           } else { // code for IE6, IE5
             xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
           }
           xmlhttp.onreadystatechange=function() {
             if (xmlhttp.readyState==4 && xmlhttp.status==200) {
               document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
             }
           }
           xmlhttp.open("GET","quick_status_result.php?q="+str,true);
           xmlhttp.send();
         }
      </script>
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
         
         	<div id="sidebar-a">
			</BR></BR></BR>
			<button type="button" style="width:75px; height:75px" onClick="window.location='index.php';"> HOME </button></BR></BR>
			<button type="button" style="width:75px; height:75px" onClick="window.location='quick_status.php';"> RETURN </button></BR></BR>
         	</div>
         
         <h2><?php
         session_start();
         include('includes/validation.php');
         if(!isset($_SESSION['cpy']))
          { 
          	$_SESSION['message1'] = 'No Company Selected - Please select a company';
			header ("Location: index.php");
          }
         ?></h2>
         <h1> Quick Status</h1>
         <?php  
         if(isset($_SESSION['cpy']))
         {
         validatecompany($_SESSION['cpy']);
         
         if ($_SESSION['error_flag'] ==1)
         {
         	echo '<h2>Critical IDB Error No. 3 Program Halted</h2>';
         	unset($_SESSION['error_flag']);
         	exit;
         }
         
         echo '<h2>Selected company is - '.$_SESSION['companies'][$_SESSION['cpy']].'</h2>';
          } ?>
         <form>
            <select  name="branches" onchange="SelectBranch(this.value)">
               <option value="">Select a branch:</option>
               <?php
                  foreach($_SESSION['branches'] as $x=>$x_value) {
                  ?>
               <option value="<?php echo "'".$x."'";?>"><?php echo $x_value;?></option>
               <?php } ?>
               <option value="allbr"> All Branches</option>
            </select>
         </form>
      </div>
      <div id="txtHint"></b></div>
   </body>
</html>