<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==4))
	{
		header('location:index.php');
	}

	if(isset($_POST['category_name']))
	{
		$category_name = ltrim(rtrim($_POST['category_name']));

		if(empty($category_name))
		{
			$panel_error = 1;
		}
		elseif(strlen($category_name)>100)
		{
			$panel_error = 2;
		}
		else
		{
			if(add_category($category_name))
			{
				$panel_error = 4;
			}
			else
			{
				$panel_error = 3;
			}
		}
	}
?>
<h2>بخش دسته بندی ها</h2>
<div class="form_data">
	<form action="" method="post" class="form">
		<table>
			<tr>
				<td><label for="category_name">عنوان</label></td>
				<td><input type="text" name="category_name" id="category_name" maxlength="100"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="ثبت دسته بندی"></td>
			</tr>
		</table>
	</form>
	<?php
		if(isset($panel_error))
		{
			switch ($panel_error) {
				case '1':
					echo '<p style="color:#f00">لطفا فیلد ها کامل پر کنید.</p>';
				break;
				case '2':
					echo '<p style="color:#f00">لطفا از حدمجاز کاراکترها نگذرید.</p>';
				break;
				case '3':
					echo '<p style="color:#f00">دسته بندی جدید ثبت نشد.</p>';
				break;
				case '4':
					echo '<p style="color:#0c0">دسته بندی ثبت شد.</p>';
				break;
			}
		}
	?>
	<hr />
	<b>لیست دسته بندی ها:</b>
	<table class="form_database" cellspacing="0" cellpadding="0">
		<tr>
			<td>نام</td>
			<td>امکانات</td>
		</tr>
		<?php
			$rc = read_category();
			if($rc===false)
			{
				echo '<td>جدول دسته بندی خالی است.</td><td></td>';
			}
			else
			{
				foreach ($rc as $foreach_rc) {
					echo '<tr><td style="font-size:11px;">' . $foreach_rc['name'] . '</td><td><a id="edit" href="panel.php?id=10&category_id=' . $foreach_rc['id'] . '" title="ویرایش دسته بندی">ویرایش دسته بندی</a><a id="delete" href="page/delete_category.php?category_id=' . $foreach_rc['id'] .'" title="حذف دسته بندی">حذف دسته بندی</a></td></tr>';
				}
			}
		?>
	</table>
	<?php
		if(isset($_SESSION['category']))
		{
			unset($_SESSION['category']);
			echo '<p style="color:#0c0">عملیات انجام شد.</p>';
		}
	?>
</div>