<?php 
//Validation functions for user input data

//Validation of selected branch code
function validatebranch($in) {
	try 
	{
//if selected branch does not exist in the list of branches $_SESSION ['branches'] or the All Branch value 'allbr' throw exception
		if (!array_key_exists($in, $_SESSION ['branches'])) 
			{
				if ($in <> 'allbr')
					{
					throw new Exception ( "Incorrect branch code value - IDB Error No. 7" );
					}
			}
	} 

	catch ( exception $e ) 
		{
			echo '<h2>Message: ' . $e->getMessage () . '</h2>';
			$_SESSION ['error_flag'] = 1;
		}
}

function validatecompany($in) {
	try
	{	
		//if selected company does not exist in the list of companies $_SESSION ['companies']  throw exception
		if (!array_key_exists($in, $_SESSION['companies']))
		{
			throw new Exception ( "Incorrect company code value - IDB Error No. 8" );
		}
	}

	catch ( exception $e )
	{
		echo '<h2>Message: ' . $e->getMessage () . '</h2>';
		$_SESSION ['error_flag'] = 1;
	}
}

function validatequeryno($in) {
	try
	{
		//if requested query no is not within limits or is not a number throw exception
		if ($in <1 || $in > 30)
		{
			throw new Exception ( "Incorrect query number request - IDB Error No. 9" );
		}
	}

	catch ( exception $e )
	{
		echo '<h2>Message: ' . $e->getMessage () . '</h2>';
		$_SESSION ['error_flag'] = 1;
	}
}
?>