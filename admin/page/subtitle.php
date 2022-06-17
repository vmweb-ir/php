<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==3))
	{
		header('location:index.php');
	}

	if(isset($_POST['subtitle_film']) && isset($_POST['subtitle_description']))
	{
		$subtitle_film = ltrim(rtrim($_POST['subtitle_film']));
		$subtitle_description = ltrim(rtrim($_POST['subtitle_description']));

		if(empty($subtitle_film) || empty($subtitle_description))
		{
			$panel_error = 1;
		}
		elseif(!is_numeric($subtitle_film) || strlen($subtitle_description)>20000)
		{
			$panel_error = 2;
		}
		else
		{
			if(isset($_FILES["subtitle_file"]))
			{
				if ($_FILES["subtitle_file"]["size"] > 20971520)
				{
					$error=3;
				}
				elseif ($_FILES["subtitle_file"]["error"] > 0)
				{
					$error=3;
				}
				else
				{
					$filename="subtitle_" . time() . $_FILES["subtitle_file"]["name"];
					move_uploaded_file($_FILES["subtitle_file"]["tmp_name"],"../subtitle/" . $filename);
					$subtitle_file = $filename;
				}
			}
			
			if(!isset($subtitle_file))
			{
				$subtitle_file = "subtitle.srt";
			}

			if(add_subtitle($subtitle_film, $subtitle_description, $subtitle_file))
			{
				$panel_error = 5;
			}
			else
			{
				$panel_error = 4;
			}
		}
	}
	elseif(isset($_POST['subtitle_film']) && isset($_POST['subtitle_description']))
	{
		$panel_error = 1;
	}
?>
<h2>بخش زیر نویس ها</h2>
<div class="form_data">
	<form action="" method="post" class="form" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label for="subtitle_film">فیلم</label></td>
				<td>
					<select name="subtitle_film" id="subtitle_film">
						<?php
							$rf = read_film();
							if($rf!==false)
							{
								foreach ($rf as $foreach_rf) {
									echo '<option value="' . $foreach_rf['id'] . '">' . $foreach_rf['title'] . '</option>';
								}
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="subtitle_description">توضیحات</label></td>
				<td><textarea name="subtitle_description" id="subtitle_description" maxlength="50000"></textarea></td>
			</tr>
			<tr>
				<td><label for="subtitle_file">زیر نویس</label></td>
				<td><input type="file" name="subtitle_file" id="subtitle_file" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="ثبت زیرنویس"></td>
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
					echo '<p style="color:#f00">فایل های شما قابل آپلود نیستند.</p>';
				break;
				case '4':
					echo '<p style="color:#f00">زیرنویس جدید ثبت نشد.</p>';
				break;
				case '5':
					echo '<p style="color:#0c0">زیرنویس ثبت شد.</p>';
				break;
			}
		}
	?>
	<hr />
	<b>زیرنویس:</b>
	<table class="form_database" cellspacing="0" cellpadding="0">
		<tr>
			<td>نام</td>
			<td>امکانات</td>
		</tr>
		<?php
			$rs = read_subtitle();
			if($rs===false)
			{
				echo '<td>جدول زیرنویس ها خالی است.</td><td></td>';
			}
			else
			{
				foreach ($rs as $foreach_rs) {
					echo '<tr><td style="font-size:11px;">' . $foreach_rs['url'] . '</td><td><a id="edit" href="panel.php?id=13&subtitle_id=' . $foreach_rs['id'] . '" title="ویرایش زیرنویس">ویرایش زیرنویس</a><a id="delete" href="page/delete_subtitle.php?subtitle_id=' . $foreach_rs['id'] .'" title="حذف زیرنویس">حذف زیرنویس</a></td></tr>';
				}
			}
		?>
	</table>
	<?php
		if(isset($_SESSION['subtitle']))
		{
			unset($_SESSION['subtitle']);
			echo '<p style="color:#0c0">عملیات انجام شد.</p>';
		}
	?>
</div>