<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==5))
	{
		header('location:index.php');
	}

	if(isset($_GET['genere_id']))
	{
		$genere_id = ltrim(rtrim($_GET['genere_id']));

		if(empty($genere_id) || !is_numeric($genere_id))
		{
			header("location:../panel.php?id=5");
		}
		else
		{
			require_once("../function.php");
			delete_genere($genere_id);
			$_SESSION['genere'] = 1;
			header("location:../panel.php?id=5");
		}
	}

	header("location:../panel.php?id=5");
?>