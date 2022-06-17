<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==14))
	{
		header('location:index.php');
	}

	if(isset($_POST['tag_name']))
	{
		$tag_name = ltrim(rtrim($_POST['tag_name']));

		if(empty($tag_name))
		{
			$panel_error = 1;
		}
		elseif(strlen($tag_name)>100)
		{
			$panel_error = 2;
		}
		else
		{
			if(add_tag($tag_name))
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
<h2>بخش برچسب ها</h2>
<div class="form_data">
	<form action="" method="post" class="form">
		<table>
			<tr>
				<td><label for="tag_name">عنوان</label></td>
				<td><input type="text" name="tag_name" id="tag_name" maxlength="100"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="ثبت برچسب"></td>
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
					echo '<p style="color:#f00">برچسب جدید ثبت نشد.</p>';
				break;
				case '4':
					echo '<p style="color:#0c0">برچسب بندی ثبت شد.</p>';
				break;
			}
		}
	?>
	<hr />
	<b>لیست برچسب ها:</b>
	<table class="form_database" cellspacing="0" cellpadding="0">
		<tr>
			<td>نام</td>
			<td>امکانات</td>
		</tr>
		<?php
			$rt = read_tag();
			if($rt===false)
			{
				echo '<td>جدول برچسب ها خالی است.</td><td></td>';
			}
			else
			{
				foreach ($rt as $foreach_rt) {
					echo '<tr><td style="font-size:11px;">' . $foreach_rt['name'] . '</td><td><a id="edit" href="panel.php?id=15&tag_id=' . $foreach_rt['id'] . '" title="ویرایش برچسب">ویرایش برچسب</a><a id="delete" href="page/delete_tag.php?tag_id=' . $foreach_rt['id'] .'" title="حذف برچسب">حذف برچسب</a></td></tr>';
				}
			}
		?>
	</table>
	<?php
		if(isset($_SESSION['tag']))
		{
			unset($_SESSION['tag']);
			echo '<p style="color:#0c0">عملیات انجام شد.</p>';
		}
	?>
</div>