<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==7))
	{
		header('location:index.php');
	}

	if(isset($_POST['old_password']) && isset($_POST['password']) && empty($old_password) && empty($password))
	{
		$old_password = ltrim(rtrim($_POST['old_password']));
		$password = ltrim(rtrim($_POST['password']));
		if(empty($old_password) || empty($password))
		{
			$panel_error=1;
		}
		elseif (strlen($old_password)>100 || strlen($password)>100)
		{
			$panel_error=2;
		}
		else
		{
			if(change_password($old_password, $password))
			{
				$panel_error=4;
			}
			else
			{
				$panel_error=3;
			}
		}
	}
	elseif(isset($_POST['old_password']) || isset($_POST['password']) || !empty($old_password) || !empty($password))
	{
		$panel_error=1;
	}

	if(isset($_POST['telegram']) || isset($_POST['instagram']))
	{
		$telegram = ltrim(rtrim($_POST['telegram']));
		$instagram = ltrim(rtrim($_POST['instagram']));
		if(empty($telegram) || empty($instagram))
		{
			$panel_erroring=1;
		}
		elseif (strlen($telegram)>255 || strlen($instagram)>255)
		{
			$panel_erroring=2;
		}
		else
		{
			if(edit_instagram($instagram))
			{
				if(edit_telegram($telegram))
				{
					$panel_erroring=4;
				}
				else
				{
					$panel_erroring=3;
				}
			}
			else
			{
				$panel_erroring=3;
			}
		}
	}
?>
<h2>بخش تنظیمات</h2>
<div class="form_data">
	<form action="" method="post" class="form">
		<table>
			<tr>
				<td><label for="old_password">رمز حال</label></td>
				<td><input type="password" name="old_password" id="old_password" maxlength="100" /></td>
			</tr>
			<tr>
				<td><label for="new_password">رمز جدید</label></td>
				<td><input type="password" name="password" id="password" maxlength="100" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value=" ثبت " /></td>
			</tr>
		</table>
	</form>
	<?php
		if(isset($panel_error))
		{
			switch ($panel_error) {
				case '1':
					echo '<p style="color:#f00">لطفا فیلد های زمز عبور را کامل پر کنید.</p>';
				break;
				case '2':
					echo '<p style="color:#f00">لطفا از حدمجاز کاراکترهای رمز عبور نگذرید.</p>';
				break;
				case '3':
					echo '<p style="color:#f00">رمز عبور جدید ثبت نشد. ممکن است رمز عبور حال را درست نزده باشید.</p>';
				break;
				case '4':
					echo '<p style="color:#0c0">رمز عبور جدید ثبت شد.</p>';
				break;
			}
		}
	?>
	<br /><hr /><br />
	<form action="" method="post" class="form">
		<table>
			<tr>
				<td><label for="telegram">تلگرام</label></td>
				<td><input style="text-align:left !important;" type="text" name="telegram" id="telegram" maxlength="255" value="<?php echo read_telegram(); ?>" /></td>
			</tr>
			<tr>
				<td><label for="instagram">اینستاگرام</label></td>
				<td><input style="text-align:left !important;" type="text" name="instagram" id="instagram" maxlength="255" value="<?php echo read_instagram(); ?>" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value=" ثبت " /></td>
			</tr>
		</table>
	</form>
	<?php
		if(isset($panel_erroring))
		{
			switch ($panel_erroring) {
				case '1':
					echo '<p style="color:#f00">لطفا فیلد ها را کامل پر کنید.</p>';
				break;
				case '2':
					echo '<p style="color:#f00">لطفا از حدمجاز کاراکترهای مجاز نگذرید.</p>';
				break;
				case '3':
					echo '<p style="color:#f00">ثبت نشد.</p>';
				break;
				case '4':
					echo '<p style="color:#0c0">ثبت شد.</p>';
				break;
			}
		}
	?>
</div>