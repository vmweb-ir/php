<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==2))
	{
		header('location:index.php');
	}

	if(isset($_POST['film_name']) && isset($_POST['film_content']) && isset($_POST['film_category']) && isset($_POST['film_genere']) && isset($_POST['film_refrence_title']) && isset($_POST['film_refrence_url']) && isset($_POST['film_year']))
	{
		$film_name = ltrim(rtrim($_POST['film_name']));
		$film_content = ltrim(rtrim($_POST['film_content']));
		$film_category = ltrim(rtrim($_POST['film_category']));
		$film_genere = ltrim(rtrim($_POST['film_genere']));
		$film_year = ltrim(rtrim($_POST['film_year']));
		$film_refrence_title = ltrim(rtrim($_POST['film_refrence_title']));
		$film_refrence_url = ltrim(rtrim($_POST['film_refrence_url']));

		if(empty($film_name) || empty($film_content) || empty($film_category) || empty($film_genere) || empty($film_refrence_title) || empty($film_refrence_url) || empty($film_year))
		{
			$panel_error = 1;
		}
		elseif(strlen($film_name)>100 || strlen($film_content)>20000 || strlen($film_refrence_title)>100 || strlen($film_refrence_url)>255)
		{
			$panel_error = 2;
		}
		else
		{
			if(isset($_FILES["film_file"]))
			{
				if ($_FILES["film_file"]["size"] > 8388608)
				{
					$panel_error=3;
				}
				elseif ($_FILES["film_file"]["error"] > 0)
				{
					$panel_error=3;
				}
				else
				{
					$filename="film_" . time() . $_FILES["film_file"]["name"];
					move_uploaded_file($_FILES["film_file"]["tmp_name"],"../film/" . $filename);
					$film_file = $filename;
				}
			}

			if(isset($_FILES["image_file"]))
			{
				if ($_FILES["image_file"]["size"] > 8388608)
				{
					$panel_error=3;
				}
				elseif ($_FILES["image_file"]["error"] > 0)
				{
					$panel_error=3;
				}
				else
				{
					$filename="image_" . time() . $_FILES["image_file"]["name"];
					move_uploaded_file($_FILES["image_file"]["tmp_name"],"../image/" . $filename);
					$image_file = $filename;
				}
			}
			
			if(!isset($image_file))
			{
				$image_file = "Hydrangeas.jpg";
			}
			if(!isset($film_file))
			{
				$film_file = "Wildlife.wmv";
			}

			if(add_film($film_name, $film_content, $film_category, $film_genere, $film_refrence_title, $film_refrence_url, $image_file, $film_file, $film_year))
			{
				$panel_error = 5;
			}
			else
			{
				$panel_error = 4;
			}
		}
	}
	elseif(isset($_POST['film_name']) || isset($_POST['film_content']) || isset($_POST['film_category']) || isset($_POST['film_genere']) || isset($_POST['film_refrence_title']) || isset($_POST['film_refrence_url']) || isset($_POST['film_year']))
	{
		$panel_error = 1;
	}
?>
<h2>بخش فیلم ها</h2>
<div class="form_data">
	<form action="" method="post" class="form" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label for="film_name">نام فیلم</label></td>
				<td><input type="text" name="film_name" id="film_name" maxlength="100"></td>
			</tr>
			<tr>
				<td><label for="film_content">محتوا</label></td>
				<td><textarea name="film_content" id="film_content" maxlength="50000"></textarea></td>
			</tr>
			<tr>
				<td><label for="film_category">دسته بندی</label></td>
				<td>
					<select name="film_category" id="film_category">
						<?php
							$rc = read_category();
							if($rc!==false)
							{
								foreach ($rc as $foreach_rc) {
									echo '<option value="' . $foreach_rc['id'] . '">' . $foreach_rc['name'] . '</option>';
								}
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="film_genere">ژانر</label></td>
				<td>
					<select name="film_genere" id="film_genere">
						<?php
							$rg = read_genere();
							if($rg!==false)
							{
								foreach ($rg as $foreach_rg) {
									echo '<option value="' . $foreach_rg['id'] . '">' . $foreach_rg['name'] . '</option>';
								}
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="film_year">سال ساخت</label></td>
				<td>
					<select name="film_year" id="film_year">
						<?php
							for($i=1990;$i<=2017;$i++) {
								echo '<option value="' . $i . '">' . $i . '</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="film_refrence_title">عنوان منبع</label></td>
				<td><input type="text" name="film_refrence_title" id="film_refrence_title" maxlength="100"></td>
			</tr>
			<tr>
				<td><label for="film_refrence_url">لینک منبع</label></td>
				<td><input style="text-align:left !important;" type="text" name="film_refrence_url" id="film_refrence_url" maxlength="255"></td>
			</tr>
			<tr>
				<td><label for="image_file">تصویر فیلم</label></td>
				<td><input type="file" name="image_file" id="image_file" /></td>
			</tr>
			<tr>
				<td><label for="film_file">فیلم</label></td>
				<td><input type="file" name="film_file" id="film_file" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="ثبت فیلم"></td>
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
					echo '<p style="color:#f00">فیلم جدید ثبت نشد.</p>';
				break;
				case '5':
					echo '<p style="color:#0c0">فیلم ثبت شد.</p>';
				break;
			}
		}
	?>
	<hr />
	<b>فیلم ها:</b>
	<table class="form_database" cellspacing="0" cellpadding="0">
		<tr>
			<td>نام</td>
			<td>امکانات</td>
		</tr>
		<?php
			$rf = read_film();
			if($rf===false)
			{
				echo '<td>جدول فیلم ها خالی است.</td><td></td>';
			}
			else
			{
				foreach ($rf as $foreach_rf) {
					echo '<tr><td style="font-size:11px;">' . $foreach_rf['title'] . '</td><td><a id="edit" href="panel.php?id=12&film_id=' . $foreach_rf['id'] . '" title="ویرایش فیلم">ویرایش فیلم</a><a id="delete" href="page/delete_film.php?film_id=' . $foreach_rf['id'] .'" title="حذف فیلم">حذف فیلم</a><a target="_blank" id="view" href="../film.php?id=' . $foreach_rf['id'] .'" title="مشاهده فیلم">مشاهده فیلم</a></td></tr>';
				}
			}
		?>
	</table>
	<?php
		if(isset($_SESSION['film']))
		{
			unset($_SESSION['film']);
			echo '<p style="color:#0c0">عملیات انجام شد.</p>';
		}
	?>
</div>