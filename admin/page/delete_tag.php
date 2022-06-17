<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==14))
	{
		header('location:index.php');
	}

	if(isset($_GET['tag_id']))
	{
		$tag_id = ltrim(rtrim($_GET['tag_id']));

		if(empty($tag_id) || !is_numeric($tag_id))
		{
			header("location:../panel.php?id=14");
		}
		else
		{
			require_once("../function.php");
			delete_tag($tag_id);
			$_SESSION['tag'] = 1;
			header("location:../panel.php?id=14");
		}
	}

	header("location:../panel.php?id=14");
?>