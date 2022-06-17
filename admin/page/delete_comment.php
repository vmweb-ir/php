<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==6))
	{
		header('location:index.php');
	}

	if(isset($_GET['comment_id']))
	{
		$comment_id = ltrim(rtrim($_GET['comment_id']));

		if(empty($comment_id) || !is_numeric($comment_id))
		{
			header("location:../panel.php?id=6");
		}
		else
		{
			require_once("../function.php");
			delete_comment($comment_id);
			$_SESSION['comment'] = 1;
			header("location:../panel.php?id=6");
		}
	}

	header("location:../panel.php?id=6");
?>