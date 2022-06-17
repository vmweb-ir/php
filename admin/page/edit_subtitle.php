<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==13))
	{
		header('location:index.php');
	}

	if(isset($_POST['subtitle_film']) && isset($_POST['subtitle_description']))
	{
		$subtitle_film = ltrim(rtrim($_POST['subtitle_film']));
		$subtitle_description = ltrim(rtrim($_POST['subtitle_description']));

		if(empty($subtitle_film) || empty($subtitle_description) || !is_numeric($subtitle_film) || strlen($subtitle_description)>20000)
		{
			$_SESSION['access']=3;
			header("location:panel.php?id=3");
		}
		else
		{
			edit_subtitle($_GET['subtitle_id'], $subtitle_film, $subtitle_description);
			$_SESSION['access']=3;
			$_SESSION['subtitle']=1;
			header("location:panel.php?id=3");
		}
	}
	elseif(isset($_POST['subtitle_film']) && isset($_POST['subtitle_description']))
	{
		$_SESSION['access']=3;
		header("location:panel.php?id=3");
	}

	if(isset($_GET['subtitle_id']))
	{
		if(empty($_GET['subtitle_id']) || !is_numeric($_GET['subtitle_id']))
		{
			$_SESSION['access']=3;
			header("location:panel.php?id=3");
		}
		else
		{
			$ss = single_subtitle($_GET['subtitle_id']);
			foreach ($ss as $foreach_ss) {
				$ss_film = $foreach_ss['film_id'];
				$ss_content = $foreach_ss['description'];
			}
		}
	}
?>
<h2>ویرایش زیر نویس</h2>
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
									if($ss_film==$foreach_rf['id'])
									{
										echo '<option selected="select" value="' . $foreach_rf['id'] . '">' . $foreach_rf['title'] . '</option>';
									}
									else
									{
										echo '<option value="' . $foreach_rf['id'] . '">' . $foreach_rf['title'] . '</option>';
									}
								}
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="subtitle_description">توضیحات</label></td>
				<td><textarea name="subtitle_description" id="subtitle_description" maxlength="50000"><?php echo $ss_content; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="ویرایش زیرنویس"></td>
			</tr>
		</table>
	</form>
</div>