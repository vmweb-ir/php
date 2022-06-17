<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==2))
	{
		header('location:index.php');
	}

	if(isset($_GET['film_id']))
	{
		$film_id = ltrim(rtrim($_GET['film_id']));

		if(empty($film_id) || !is_numeric($film_id))
		{
			header("location:../panel.php?id=2");
		}
		else
		{
			require_once("../function.php");
			delete_film($film_id);
			$_SESSION['film'] = 1;
			header("location:../panel.php?id=2");
		}
	}

	header("location:../panel.php?id=2");
?>