<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==8))
	{
		header('location:index.php');
	}

	$view_film_onetime = false;
	if(isset($_POST['film_id']) && isset($_POST['start_year']) && isset($_POST['start_month']) && isset($_POST['start_day']))
	{
		if(empty($_POST['film_id']) || empty($_POST['start_year']) || empty($_POST['start_month']) || empty($_POST['start_day']))
		{
			$report_error = 1;
		}
		elseif(!is_numeric($_POST['film_id']) || !is_numeric($_POST['start_year']) || !is_numeric($_POST['start_month']) || !is_numeric($_POST['start_day']))
		{
			$report_error = 2;
		}
		else
		{
			$film_id = ltrim(rtrim($_POST['film_id']));
			$year = ltrim(rtrim($_POST['start_year']));
			$month = ltrim(rtrim($_POST['start_month']));
			$day = ltrim(rtrim($_POST['start_day']));
			$time=$year . '-' . $month . '-' . $day;

			$view_film_onetime = view_film_onetime($film_id, strtotime($time));
		}
	}
?>
<h2>بخش گزارش ها</h2>
<div class="form_data">
	<b>تعداد بازدید در بازه زمانی : </b><br />
	<form class="form" action="" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label for="title">فیلم</label></td>
				<td>
					<select name="film_id">
						<?php
							$rf = read_film();
							foreach ($rf as $my_rf) {
								echo '<option value="' . $my_rf['id'] . '">' . $my_rf['title'] . '</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="content">تاریخ</label></td>
				<td>
					<select name="start_year">
						<?php
							for($i=2015;$i<=2017;$i++)
							{
								echo '<option value="' . $i . '">' . $i . '</option>';
							}
						?>
					</select>
					<select name="start_month">
						<?php
							for($i=1;$i<=12;$i++)
							{
								echo '<option value="' . $i . '">' . $i . '</option>';
							}
						?>
					</select>
					<select name="start_day">
						<?php
							for($i=1;$i<=30;$i++)
							{
								echo '<option value="' . $i . '">' . $i . '</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<?php if($view_film_onetime!==false)
			{ ?>
			<tr>
				<td colspan="2">فیلم انتخابی از تاریخ <?php echo '<span dir="ltr">' . $time . '</span>'; ?> تا بحال <?php echo $view_film_onetime; ?> بار بازدید داشته است.</td>
			</tr>
			<?php } ?>
			<tr>
				<td></td>
				<td><input type="submit" value="محاسبه" /></td>
			</tr>
		</table>
	</form>

	<b>10 فیلم پربازدید : </b>
	<table class="form_database" cellspacing="0" cellpadding="0">
		<tr>
			<td>نام</td>
			<td>امکانات</td>
		</tr>
		<?php
			$rtv_count = 10;
			$rtv = read_top_view();
			if($rtv===false)
			{
				echo '<td>جدول فیلم ها خالی است.</td><td></td>';
			}
			else
			{
				foreach ($rtv as $foreach_rtv) {
					echo '<tr><td>' . $foreach_rtv['title'] . '</td><td><a target="_blank" id="view" href="../film.php?id=' . $foreach_rtv['id'] .'" title="مشاهده فیلم">مشاهده فیلم</a></td></tr>';
					$rtv_count-=1;
					if(!$rtv_count)
						break;
				}
			}
		?>
	</table>

	<br />
	<hr />
	<br />

	<b>10 فیلم پر دانلود : </b>
	<table class="form_database" cellspacing="0" cellpadding="0">
		<tr>
			<td>نام</td>
			<td>امکانات</td>
		</tr>
		<?php
			$rtd_count = 10;
			$rtd = read_top_download();
			if($rtd===false)
			{
				echo '<td>جدول فیلم ها خالی است.</td><td></td>';
			}
			else
			{
				foreach ($rtd as $foreach_rtd) {
					echo '<tr><td>' . $foreach_rtd['title'] . '</td><td><a target="_blank" id="view" href="../film.php?id=' . $foreach_rtd['id'] .'" title="مشاهده فیلم">مشاهده فیلم</a></td></tr>';
					$rtd_count-=1;
					if(!$rtd_count)
						break;
				}
			}
		?>
	</table>

	<br />
	<hr />
	<br />

	<b>10 فیلم پر بحث : </b>
	<table class="form_database" cellspacing="0" cellpadding="0">
		<tr>
			<td>نام</td>
			<td>امکانات</td>
		</tr>
		<?php
			$rtc_count = 10;
			$rtc = read_top_comment();
			if($rtc===false)
			{
				echo '<td>جدول فیلم ها خالی است.</td><td></td>';
			}
			else
			{
				foreach ($rtc as $foreach_rtc) {
					echo '<tr><td>' . $foreach_rtc['title'] . '</td><td><a target="_blank" id="view" href="../film.php?id=' . $foreach_rtc['id'] .'" title="مشاهده فیلم">مشاهده فیلم</a></td></tr>';
					$rtc_count-=1;
					if(!$rtc_count)
						break;
				}
			}
		?>
	</table>
</div>