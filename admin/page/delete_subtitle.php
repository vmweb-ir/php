<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==3))
	{
		header('location:index.php');
	}

	if(isset($_GET['subtitle_id']))
	{
		$subtitle_id = ltrim(rtrim($_GET['subtitle_id']));

		if(empty($subtitle_id) || !is_numeric($subtitle_id))
		{
			header("location:../panel.php?id=3");
		}
		else
		{
			require_once("../function.php");
			delete_subtitle($subtitle_id);
			$_SESSION['subtitle'] = 1;
			header("location:../panel.php?id=3");
		}
	}

	header("location:../panel.php?id=3");
?>