<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==10))
	{
		header('location:index.php');
	}

	if(isset($_POST['category_name']))
	{
		$category_name = ltrim(rtrim($_POST['category_name']));

		if(empty($category_name) || strlen($category_name)>100)
		{
			$_SESSION['access']=4;
			header("location:panel.php?id=4");
		}
		else
		{
			edit_category($_GET['category_id'], $category_name);
			$_SESSION['access']=4;
			$_SESSION['category'] = 1;
			header("location:panel.php?id=4");
		}
	}

	if(isset($_GET['category_id']))
	{
		if(empty($_GET['category_id']) || !is_numeric($_GET['category_id']))
		{
			$_SESSION['access']=4;
			header("location:panel.php?id=4");
		}
		else
		{
			$sc = single_category($_GET['category_id']);
			foreach ($sc as $foreach_sc) {
				$sc_name = $foreach_sc['name'];
			}
		}
	}
?>
<h2>ویرایش دسته بندی</h2>
<div class="form_data">
	<form action="" method="post" class="form">
		<table>
			<tr>
				<td><label for="category_name">عنوان</label></td>
				<td><input type="text" name="category_name" id="category_name" maxlength="100" value="<?php echo $sc_name; ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="ویرایش دسته بندی"></td>
			</tr>
		</table>
	</form>
</div>