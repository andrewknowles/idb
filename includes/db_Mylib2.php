<?php
class MyConfig2
  {
    public $hostname;
    public $username;
    public $password;
    public $database;
    
    function __construct($hostname = null, $username = null, $password = null, $database = null)
      {
        
        $this->hostname = !empty($hostname) ? $hostname : "";
        $this->username = !empty($username) ? $username : "";
        $this->password = !empty($password) ? $password : "";
        $this->database = !empty($database) ? $database : "";
      }
    
    function __destruct()
      {
        
      }
  }

class MyDb2
  {
    private $connection;
    private $config;
    
    function __construct($config)
      {
        $this->config = $config;
      }
    
    function __destruct()
      {
        
      }
//------------------------------------------------------------------------------------------------------------------------    
    public function openConnection()
      {
        //		error_reporting(0);
        
        $this->connection = mysqli_connect($this->config->hostname, $this->config->username, $this->config->password, $this->config->database);
        try
          {
            if (mysqli_connect_errno())
              {
                throw new Exception("Unable to connect to database - IDB Error No. 1");
//                throw new Exception("Unable to connect to database -IDB Error No. 0001  " . mysqli_connect_error());
              }
            return $this->connection;
          }
        catch (Exception $e)
          {
            echo '<h2>Message: ' . $e->getMessage().'</h2>';
            $_SESSION['error_flag']= 1;
          }
      }
      
//--------------------------------------------------------------------------------------------------------------------------      
      public function closeConnection()
      {
      	mysqli_close($this->connection);
      }
//--------------------------------------------------------------------------------------------------------------------------      
      //returns query string from qry table using qry_id
        public function idbquerybytype($querytype)
      {
      	try 
      	{
      		if (!$stmt = mysqli_prepare($this->connection,'SELECT qry_title, qry_qry, qry_qry2, qry_qry3, qry_link, qry_detail FROM idb_query where qry_type = ? order by qry_order'))
      		{ 
      			throw new Exception("Failed to select queries by type - IDB Error No. 4");
      		} 
      		else 
      		{
				$stmt->bind_param('i', $querytype);
				$stmt->execute();
				$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
				$result =  $stmt->get_result();
				return $result;
      		}
      	}     	
      	catch (Exception $e)
      	{
      		echo '<h2>Message: ' . $e->getMessage().'</h2>';
      		$_SESSION['error_flag']= 1;
      	}
      }
      
//-------------------------------------------------------------------------------------------------------------------------- 
      //returns query string from qry table using qry_id
      public function idbquerybyno($queryno)
      {
      	try
      	{
      		if (!$stmt = mysqli_prepare($this->connection,'select qry_title, qry_qry, qry_qry2, qry_qry3, qry_link, qry_detail from idb_query where qry_id = ?'))
      			{
      				throw new Exception("Failed to select queries by number - IDB Error No. 4");
      			}
      			else
      			{
      				$stmt->bind_param('i', $queryno);
      				$stmt->execute();
      				$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
      				$result =  $stmt->get_result();
      				return $result;
      			}
      			}
      			catch (Exception $e)
      			{
      				echo '<h2>Message: ' . $e->getMessage().'</h2>';
      				$_SESSION['error_flag']= 1;
      	}
      }

//--------------------------------------------------------------------------------------------------------------------------------
      	public function escapeString($string)
      	{
      		return addslashes($string);
      	}
//---------------------------------------------------------------------------------------------------------------------------      
    
  }
?>