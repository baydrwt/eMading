<?php
function opendb($server)
{
	switch ($server)
	{
		case "CONNECTION":
			$opendb=mysqli_connect("localhost","root","","emading","3308");
			break;
	}
	return $opendb;	
}

function closedb($connection)
{
	$closedb=mysqli_close($connection);
	return $closedb;	
}
function myQuery($con,$sql, $trace=0)
{
	$querydata=mysqli_query($con, $sql);
	if ($trace)
	{
		if (mysqli_errno($con))
		{
			echo "$sql \n".mysqli_error($con)."\n";
		}
	}
	return $querydata;	
}
function fetch($rs,$call)
{
	switch ($call)
	{
		case "name" : 
		$fetch=@mysqli_fetch_assoc($rs);	
		break;
		case "number" : 
		$fetch=@mysqli_fetch_row($rs);
	}	
	return $fetch;
}
