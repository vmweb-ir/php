<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==5))
	{
		header('location:index.php');
	}

	if(isset($_POST['genere_name']))
	{
		$genere_name = ltrim(rtrim($_POST['genere_name']));

		if(empty($genere_name))
		{
			$panel_error = 1;
		}
		elseif(strlen($genere_name)>100)
		{
			$panel_error = 2;
		}
		else
		{
			if(add_genere($genere_name))
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
<h2>بخش ژانرها</h2>
<div class="form_data">
	<form action="" method="post" class="form">
		<table>
			<tr>
				<td><label for="genere_name">عنوان</label></td>
				<td><input type="text" name="genere_name" id="genere_name" maxlength="100"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="ثبت ژانر"></td>
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
					echo '<p style="color:#f00">ژانر جدید ثبت نشد.</p>';
				break;
				case '4':
					echo '<p style="color:#0c0">ژانر ثبت شد.</p>';
				break;
			}
		}
	?>
	<hr />
	<b>لیست ژانر ها:</b>
	<table class="form_database" cellspacing="0" cellpadding="0">
		<tr>
			<td>نام</td>
			<td>امکانات</td>
		</tr>
		<?php
			$rg = read_genere();
			if($rg===false)
			{
				echo '<td>جدول ژانر خالی است.</td><td></td>';
			}
			else
			{
				foreach ($rg as $foreach_rg) {
					echo '<tr><td style="font-size:11px;">' . $foreach_rg['name'] . '</td><td><a id="edit" href="panel.php?id=11&genere_id=' . $foreach_rg['id'] . '" title="ویرایش ژانر">ویرایش ژانر</a><a id="delete" href="page/delete_genere.php?genere_id=' . $foreach_rg['id'] .'" title="حذف ژانر">حذف ژانر</a></td></tr>';
				}
			}
		?>
	</table>
	<?php
		if(isset($_SESSION['genere']))
		{
			unset($_SESSION['genere']);
			echo '<p style="color:#0c0">عملیات انجام شد.</p>';
		}
	?>
</div>