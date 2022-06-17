<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==11))
	{
		header('location:index.php');
	}

	if(isset($_POST['genere_name']))
	{
		$genere_name = ltrim(rtrim($_POST['genere_name']));

		if(empty($genere_name) || strlen($genere_name)>100)
		{
			$_SESSION['access']=5;
			header("location:panel.php?id=5");
		}
		else
		{
			edit_genere($_GET['genere_id'], $genere_name);
			$_SESSION['access']=5;
			$_SESSION['genere'] = 1;
			header("location:panel.php?id=5");
		}
	}

	if(isset($_GET['genere_id']))
	{
		if(empty($_GET['genere_id']) || !is_numeric($_GET['genere_id']))
		{
			$_SESSION['access']=5;
			header("location:panel.php?id=5");
		}
		else
		{
			$sc = single_genere($_GET['genere_id']);
			foreach ($sc as $foreach_sc) {
				$sc_name = $foreach_sc['name'];
			}
		}
	}
?>
<h2>ویرایش ژانر</h2>
<div class="form_data">
	<form action="" method="post" class="form">
		<table>
			<tr>
				<td><label for="genere_name">عنوان</label></td>
				<td><input type="text" name="genere_name" id="genere_name" maxlength="100" value="<?php echo $sc_name; ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="ویرایش ژانر"></td>
			</tr>
		</table>
	</form>
</div>