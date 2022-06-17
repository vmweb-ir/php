<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==15))
	{
		header('location:index.php');
	}

	if(isset($_POST['tag_name']))
	{
		$tag_name = ltrim(rtrim($_POST['tag_name']));

		if(empty($tag_name) || strlen($tag_name)>100)
		{
			$_SESSION['access']=14;
			header("location:panel.php?id=14");
		}
		else
		{
			edit_tag($_GET['tag_id'], $tag_name);
			$_SESSION['access']=14;
			$_SESSION['tag'] = 1;
			header("location:panel.php?id=14");
		}
	}

	if(isset($_GET['tag_id']))
	{
		if(empty($_GET['tag_id']) || !is_numeric($_GET['tag_id']))
		{
			$_SESSION['access']=14;
			header("location:panel.php?id=14");
		}
		else
		{
			$sc = single_tag($_GET['tag_id']);
			foreach ($sc as $foreach_sc) {
				$sc_name = $foreach_sc['name'];
			}
		}
	}
?>
<h2>ویرایش برچسب</h2>
<div class="form_data">
	<form action="" method="post" class="form">
		<table>
			<tr>
				<td><label for="tag_name">عنوان</label></td>
				<td><input type="text" name="tag_name" id="tag_name" maxlength="100" value="<?php echo $sc_name; ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="ویرایش برچسب"></td>
			</tr>
		</table>
	</form>
</div>