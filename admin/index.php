<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>پنل مدیریت سراج مووی</title>
		<link rel="stylesheet" href="../content/css/admin.css" />
		<link rel="stylesheet" href="../content/css/font-awesome.css">
		<link rel="stylesheet" href="../content/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/ico" href="../content/image/favicon.png">
	</head>
	<?php
		@session_start();
		if(isset($_SESSION['access']))
		{
			header("location:panel.php?page=1");
		}
		if(isset($_POST['username']) || isset($_POST['password']))
		{
			$username = ltrim(rtrim($_POST['username']));
			$password = ltrim(rtrim($_POST['password']));

			if(empty($username) || empty($password))
			{
				$login_error = 1;
			}
			elseif (strlen($username) > 100 || strlen($password) > 100) {
				$login_error = 2;
			}
			else
			{
				require_once('function.php');
				$login_admin = login_admin($username, $password);
				if($login_admin==true)
				{
					$_SESSION['access']=1;
					header("location:panel.php?id=1");
				}
				else
				{
					$login_error=3;
				}
			}
		}
	?>
	<body>
		<div class="login_form">
			<div class="logo">
				<img src="../content/image/logo.png" title="سراج مووی" alt="سراج مووی" />
			</div>
			<form action="" method="post">
				<table>
					<tr>
						<td><label for="username">نام کاربری</label></td>
						<td><input type="text" name="username" id="username" /></td>
					</tr>
					<tr>
						<td><label for="password">رمز عبور</label></td>
						<td><input type="password" name="password" id="password" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="ورود به پنل" /></td>
					</tr>
				</table>
			</form>
			<?php
				if(isset($login_error))
				{
					switch ($login_error) {
						case '1':
							echo '<p style="color:#f00">لطفا فیلد نام کاربری و رمز عبور را کامل پر کنید.</p>';
						break;
						case '2':
							echo '<p style="color:#f00">حداکثر اندازه فیلد نام کاربری و رمز عبور 100 کاراکتر می باشد.</p>';
						break;
						case '3':
							echo '<p style="color:#f00">نام کاربری یا رمزعبور وارد شده اشتباه است.</p>';
						break;
					}
				}
			?>
		</div>
	</body>
</html>