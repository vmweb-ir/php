<?php
	if(!(isset($_GET['film_id']) && !empty($_GET['film_id']) && is_numeric($_GET['film_id']) && $_GET['film_id']!=0))
	{
		header("location:index.php");
	}
	else
	{
		require_once('function.php');
		$rff = read_file_film($_GET['film_id']);
		if($rff!==false)
		{
			header("location:film/" . $rff);
		}
		else
		{
			header("location:index.php");
		}
	}
?>