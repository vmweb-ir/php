<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==4))
	{
		header('location:index.php');
	}

	if(isset($_GET['category_id']))
	{
		$category_id = ltrim(rtrim($_GET['category_id']));

		if(empty($category_id) || !is_numeric($category_id))
		{
			header("location:../panel.php?id=4");
		}
		else
		{
			require_once("../function.php");
			delete_category($category_id);
			$_SESSION['category'] = 1;
			header("location:../panel.php?id=4");
		}
	}

	header("location:../panel.php?id=4");
?>