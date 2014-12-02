<?php
/* 
EDIT.PHP
Allows user to edit specific entry in database
*/

// creates the edit record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($id, $title, $query, $query2, $query3, $type, $order, $link, $detail, $error)
  {
?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
 </head>
 <body>
 <button type="button" onClick="window.location='index.php';"> HOME </button>
 <?php
    // if there are any errors, display them
    if ($error != '')
      {
        echo '<div style="padding:4px; border:1px solid red; color:red;">' . $error . '</div>';
      }
    
?> 
 
 <form action="" method="post">
 <input type="hidden" name="id" value="<?php
    echo $id;
?>"/>
 <div>
 <p><strong>ID:</strong> <?php
    echo $id;
?></p>
 <strong>Title: *</strong> <input type="text" name="title" value="<?php
    echo $title;
?>"/><br/>
 <strong>Query: *<textarea rows="5" cols="100" name="query" ><?php
    echo $query;
?></textarea><br/>
 <strong>Query2: *<textarea rows="5" cols="100" name="query2" ><?php
    echo $query2;
?></textarea><br/>
 <strong>Query3: *<textarea rows="5" cols="100" name="query3" ><?php
    echo $query3;
?></textarea><br/>
 <strong>Type: *</strong> <input type="text" name="type" value="<?php
    echo $type;
?>"/><br/>
 <strong>Order: *</strong> <input type="text" name="order" value="<?php
    echo $order;
?>"/><br/>
 <strong>Link: *</strong> <input type="text" name="link" value="<?php
    echo $link;
?>"/><br/>
 <strong>Detail: *</strong> <input type="text" name="detail" value="<?php
    echo $detail;
?>"/><br/>
 <p>* Required</p>
 <input type="submit" name="submit" value="Submit">
 </div>
 </form> 
 </body>
 </html> 
 <?php
  }



// connect to the database
require('includes/table_lib.php');
include('includes/db_Mylib.php');

$myIniFile = parse_ini_file("includes/idb.ini", TRUE);

// create and open the MySQL connection
$Myconfig = new Myconfig($myIniFile['IDBMYSQL']['server'], $myIniFile['IDBMYSQL']['login'], $myIniFile['IDBMYSQL']['password'], $myIniFile['IDBMYSQL']['database'], $myIniFile['IDBMYSQL']['extension'], $myIniFile['IDBMYSQL']['mysqlformat']);
$Mydb     = new Mydb($Myconfig);
$Mydb->openConnection();

// check if the form has been submitted. If it has, process the form and save it to the database
if (isset($_POST['submit']))
  {
    // confirm that the 'id' value is a valid integer before getting the form data
    if (is_numeric($_POST['id']))
      {
        // get form data, making sure it is valid
        $id = $_POST['id'];
        
        
        $title  = $Mydb->escapeString(htmlspecialchars($_POST['title']));
        $query  = $Mydb->escapeString(htmlspecialchars($_POST['query']));
        $query2 = $Mydb->escapeString(htmlspecialchars($_POST['query2']));
        $query3 = $Mydb->escapeString(htmlspecialchars($_POST['query3']));
        $type   = $Mydb->escapeString(htmlspecialchars($_POST['type']));
        $order   = $Mydb->escapeString(htmlspecialchars($_POST['order']));
        $link   = $Mydb->escapeString(htmlspecialchars($_POST['link']));
        $detail   = $Mydb->escapeString(htmlspecialchars($_POST['detail']));
        
        // check that firstname/lastname fields are both filled in
        if ($title == '' || $query == '')
          {
            // generate error message
            $error = 'ERROR: Please fill in all required fields!';
            
            //error, display form
            renderForm($id, $title, $query, $query2, $type, $order, $link, $error);
          }
        else
          {
            $con   = mysqli_connect("localhost", "root", "", "idb");
            $query = mysqli_real_escape_string($con, $_POST['query']);
            // Check connection
            if (mysqli_connect_errno())
              {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }
            
            // Perform queries
            mysqli_query($con, "update idb_query set qry_title = '" . $title . "', qry_qry = '" . $query . "', qry_qry2 = '" . $query2. "',
			qry_qry3 = '" . $query3. "', qry_type = " . $type. ", qry_order = " . $order. ",  qry_link = " . $link . ", qry_detail = " .$detail. " where qry_id = " . $id);
            
            mysqli_close($con);
            
            // once saved, redirect back to the view page
            header("Location: query_editor2.php");
          }
      }
    else
      {
        // if the 'id' isn't valid, display an error
        echo 'Error!';
      }
  }
else
// if the form hasn't been submitted, get the data from the db and display the form
  {
    
    // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
    
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
      {
        
        // query db
        $id = $_GET['id'];
        echo "SELECT * FROM idb_query WHERE qry_id= " . $id;
        $Mysql1 = $Mydb->query1("SELECT * FROM idb_query WHERE qry_id=" . $id)
        // $result = mysqli_query($Mydb, "SELECT * FROM idb_query WHERE id=$id")
            or die(mysqli_error());
        
        // check that the 'id' matches up with a row in the databse
        if ($Mysql1)
          {
            foreach ($Mysql1 as $dataline1)
              {
                
                
                // get data from db
                $title  = $dataline1['qry_title'];
                $query  = $dataline1['qry_qry'];
                $query2 = $dataline1['qry_qry2'];
                $query3 = $dataline1['qry_qry3'];
                $type   = $dataline1['qry_type'];
                $order   = $dataline1['qry_order'];
                $link   = $dataline1['qry_link'];
                $detail   = $dataline1['qry_detail'];
              }
            // show form
            echo $title.$query.$query2.$type.$link;

            renderForm($id, $title, $query, $query2, $query3, $type, $order, $link, $detail, '');
          }
        else
        // if no match, display result
          {
            echo "No results!";
          }
      }
    else
    // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
      {
        echo 'Error!';
      }
  }
$Mydb->closeConnection();
?>