<html>
<head>
<script>
function listquery(str) {
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

  xmlhttp.open("GET","query_editor1.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>

<?php
session_start();
include('includes/db_Mylib.php');
$myIniFile = parse_ini_file("includes/idb.ini", TRUE);

//create the MySQL connection and open it
    $Myconfig = new Myconfig($myIniFile['IDBMYSQL']['server'], $myIniFile['IDBMYSQL']['login'], $myIniFile['IDBMYSQL']['password'], 
    $myIniFile['IDBMYSQL']['database'], $myIniFile['IDBMYSQL']['extension'],$myIniFile['IDBMYSQL']['mysqlformat']); 
  	$Mydb = new Mydb($Myconfig);
    $Mydb->openConnection();

$Mysql = $Mydb->query1("select qry_id, qry_title from idb_query");

$_SESSION['queries'] = array();

while($myRow = mysqli_fetch_array( $Mysql)){
    $_SESSION['queries'][] = $myRow;
}

?>
<form>
<select name="queries" onchange="listquery(this.value)">
<option value="">Select a query:</option>
<?php
session_start();
$allbranch = '';
foreach($_SESSION['queries'] as $x=>$x_value) {
?>
<option value="<?php 

echo "'".$x_value['qry_id']."'";?>"><?php echo $x_value['qry_title'];?></option><?php 
}
?>

</select>
</form>
<div id="txtHint"></b></div>
</body>
</html>