<?php

class IfxConfig2
{
	public $odbc;
	public $username;
	public $password;

	function __construct(
			$odbc = null,
			$username = null,
			$password = null)

	{
		$this->odbc = !empty($odbc) ? $odbc : "";
		$this->username = !empty($username) ? $username : "";
		$this->password = !empty($password) ? $password : "";
	}

	function __destruct()
	{

	}
}

class IfxDb2
{
	private $connection;
	private $selectdb;
	private $config;

	function __construct($config)
	{
		$this->config = $config;
	}

	function __destruct()
	{

	}

	public function openConnection()
	{
//		error_reporting(0);
		
		try
		{
		
				if (!($this->connection = odbc_connect($this->config->odbc, $this->config->username, $this->config->password)))
			{
				throw new Exception("Unable to connect to database - IDB Error No. 2");
			} else {
			return $this->connection; }
		}
		catch (Exception $e)
		{
			echo '<h2>Message: ' . $e->getMessage().'</h2>';
			$_SESSION['error_flag']= 1;
		}
	}

	public function closeConnection()
	{
		odbc_close($this->connection);
	}
//-------------------------------------------------------------------------------------------------------------------------	
		public function query0($enteredquery)
		{
//			echo $enteredquery;
//			error_reporting(0);
			try
			{
				if(empty($this->connection))
				{
					$this->openConnection();
				}
				$this->lastQuery = odbc_exec($this->connection, $enteredquery);

				if (!$this->lastQuery)
				{
					throw new Exception("Informix query failed - IDB Error No. 5");
				}
				else 
				{				
				return $this->lastQuery;
				}
			}
			catch(exception $e)
			{
				echo '<h2>Message: ' . $e->getMessage().'</h2>';
				$_SESSION['error_flag']= 1;
			}
		}
//------------------------------------------------------------------------------------------------------------------------
		public function query1($enteredquery, $par1)
		{
			//			echo $enteredquery. '-----'.$par1;
			//			error_reporting(0);

			try
			{
				if(empty($this->connection))
				{
					$this->openConnection();
				}
				$queryresult = odbc_prepare($this->connection, $enteredquery);

					$res = odbc_execute($queryresult, array($par1));
		
				if (!$queryresult || !$res)
				{
					throw new Exception("Informix query failed - IDB Error No. 6");
				}
				else
				{
					return $queryresult;
				}
			}
			catch(exception $e)
			{
				echo '<h2>Message: ' . $e->getMessage().'</h2></BR>';
				echo $par1.'</BR>';
				echo $enteredquery.'</BR>';
				$_SESSION['error_flag']= 1;
			}
		}
		//------------------------------------------------------------------------------------------------------------------------
		public function lastQuery()
		{
			return $this->lastQuery;
		}
	
}
?>