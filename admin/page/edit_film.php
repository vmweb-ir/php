<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==12))
	{
		header('location:index.php');
	}

	if(isset($_POST['film_name']) && isset($_POST['film_content']) && isset($_POST['film_category']) && isset($_POST['film_genere']) && isset($_POST['film_refrence_title']) && isset($_POST['film_refrence_url']) && isset($_POST['film_year']))
	{
		$film_name = ltrim(rtrim($_POST['film_name']));
		$film_content = ltrim(rtrim($_POST['film_content']));
		$film_category = ltrim(rtrim($_POST['film_category']));
		$film_genere = ltrim(rtrim($_POST['film_genere']));
		$film_refrence_title = ltrim(rtrim($_POST['film_refrence_title']));
		$film_refrence_url = ltrim(rtrim($_POST['film_refrence_url']));
		$film_year = ltrim(rtrim($_POST['film_year']));

		if(empty($film_name) || empty($film_content) || empty($film_category) || empty($film_genere) || empty($film_refrence_title) || empty($film_refrence_url) || strlen($film_name)>100 || strlen($film_content)>20000 || strlen($film_refrence_title)>100 || strlen($film_refrence_url)>255)
		{
			$_SESSION['access']=2;
			header("location:panel.php?id=2");
		}
		else
		{
			if(isset($_FILES["film_file"]))
			{
				if ($_FILES["film_file"]["size"] > 8388608)
				{
					$_SESSION['access']=2;
					header("location:panel.php?id=2");
				}
				elseif ($_FILES["film_file"]["error"] > 0)
				{
					$_SESSION['access']=2;
					header("location:panel.php?id=2");
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
					$_SESSION['access']=2;
					header("location:panel.php?id=2");
				}
				elseif ($_FILES["image_file"]["error"] > 0)
				{
					$_SESSION['access']=2;
					header("location:panel.php?id=2");
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
				$image_file = "";
			}
			if(!isset($film_file))
			{
				$film_file = "";
			}

			edit_film($_GET['film_id'], $film_name, $film_content, $film_category, $film_genere, $film_refrence_title, $film_refrence_url, $film_year, $image_file, $film_file);
			$_SESSION['access']=2;
			$_SESSION['film']=1;
			header("location:panel.php?id=2");
		}
	}
	elseif(isset($_POST['film_name']) || isset($_POST['film_content']) || isset($_POST['film_category']) || isset($_POST['film_genere']) || isset($_POST['film_refrence_title']) || isset($_POST['film_refrence_url']) || isset($_POST['film_year']))
	{
		$_SESSION['access']=2;
		header("location:panel.php?id=2");
	}

	if(isset($_GET['film_id']))
	{
		if(empty($_GET['film_id']) || !is_numeric($_GET['film_id']))
		{
			$_SESSION['access']=2;
			header("location:panel.php?id=2");
		}
		else
		{
			$sp = single_film($_GET['film_id']);
			foreach ($sp as $foreach_sp) {
				$sp_name = $foreach_sp['title'];
				$sp_content = $foreach_sp['content'];
				$sp_category = $foreach_sp['category_id'];
				$sp_genere = $foreach_sp['genere_id'];
				$sp_refrence_title = $foreach_sp['refrence_title'];
				$sp_refrence_url = $foreach_sp['refrence_url'];
				$sp_year = $foreach_sp['make_year'];
			}
		}
	}
?>
<h2>ویرایش فیلم</h2>
<div class="form_data">
	<form action="" method="post" class="form" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label for="film_name">نام فیلم</label></td>
				<td><input type="text" name="film_name" id="film_name" maxlength="100" value="<?php echo $sp_name; ?>"></td>
			</tr>
			<tr>
				<td><label for="film_content">محتوا</label></td>
				<td><textarea name="film_content" id="film_content" maxlength="50000"><?php echo $sp_content; ?></textarea></td>
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
									if($sp_category==$foreach_rc['id'])
									{
										echo '<option selected="select" value="' . $foreach_rc['id'] . '">' . $foreach_rc['name'] . '</option>';
									}
									else
									{
										echo '<option value="' . $foreach_rc['id'] . '">' . $foreach_rc['name'] . '</option>';
									}
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
									if($sp_genere==$foreach_rg['id'])
									{
										echo '<option selected="select" value="' . $foreach_rg['id'] . '">' . $foreach_rg['name'] . '</option>';
									}
									else
									{
										echo '<option value="' . $foreach_rg['id'] . '">' . $foreach_rg['name'] . '</option>';
									}
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
								if($sp_year==$i)
								{
									echo '<option selected="select" value="' . $i . '">' . $i . '</option>';
								}
								else
								{
									echo '<option value="' . $i . '">' . $i . '</option>';
								}
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="film_refrence_title">عنوان منبع</label></td>
				<td><input type="text" name="film_refrence_title" id="film_refrence_title" maxlength="100" value="<?php echo $sp_refrence_title; ?>"></td>
			</tr>
			<tr>
				<td><label for="film_refrence_url">لینک منبع</label></td>
				<td><input style="text-align:left !important;" type="text" name="film_refrence_url" id="film_refrence_url" maxlength="255"  value="<?php echo $sp_refrence_url; ?>"></td>
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
				<td><input type="submit" value="ویرایش فیلم"></td>
			</tr>
		</table>
	</form>
</div>