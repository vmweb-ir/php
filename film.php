<?php
	if(!(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']!=0))
	{
		header("location:index.php");
	}
	else
	{
		require_once('header.php');
	}

	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['content']))
	{
		$film_id = $_GET['id'];
		$name = ltrim(rtrim($_POST['name']));
		$email = ltrim(rtrim($_POST['email']));
		$content = ltrim(rtrim($_POST['content']));
		if(empty($name) || empty($email) || empty($content))
		{
			$comment_error = 1;
		}
		elseif(strlen($name)>100 || strlen($email)>100 || strlen($content)>20000)
		{
			$comment_error = 2;
		}
		else
		{
			if(add_comment($film_id, $name, $email, $content))
			{
				$comment_error = 4;
			}
			else
			{
				$comment_error = 3;
			}
		}
	}
?>
<div class="right">
	<div class="my_content">
		<?php
			$sf = single_film($_GET['id']);
			if($sf===false)
			{
				echo "<p style='background:#67AF78; color:#fff; text-align:center; padding:25px;'>فیلم مورد نظر یافت نشد.</p>";
			}
			else
			{
				foreach ($sf as $foreach_sf) {
					$view = $foreach_sf['view']+1;
					echo '<div class="my_content_item">
					<h2><a href="film.php?id=' . $foreach_sf['id'] . '" title="دانلود فیلم + ادامه">' . $foreach_sf['title'] . '</a></h2>
					<div id="image_box"><img src="image/' . $foreach_sf['image'] . '" width="500" alt="' . $foreach_sf['title'] . '" title="' . $foreach_sf['title'] . '" /></div>
					<p>' . $foreach_sf['content'] . '</p>
					<div id="film_info">
						<table cell_padding="0" cellspacing="0">
							<tr>
								<td>نویسنده</td>
								<td>' . read_username() . '</td>
							</tr>
							<tr>
								<td>تاریخ ثبت</td>
								<td>' . date("Y/m/d", $foreach_sf['time']) . ' میلادی</td>
							</tr>
							<tr>
								<td>تعداد بازدید</td>
								<td>' . $view . ' بار نمایش</td>
							</tr>
							<tr>
								<td>تعداد نظرات</td>
								<td>' . count_post_comment($foreach_sf['id']) . ' نظر</td>
							</tr>
							<tr>
								<td>دسته فیلم</td>
								<td>' . read_category_name($foreach_sf['category_id']) . '</td>
							</tr>
							<tr>
								<td>ژانر فیلم</td>
								<td>' . read_genere_name($foreach_sf['genere_id']) . '</td>
							</tr>
							<tr>
								<td>سال ساخت</td>
								<td>سال ' . $foreach_sf['make_year'] . ' میلادی</td>
							</tr>
							<tr>
								<td>لینک دانلود</td>
								<td><a target="_blank" href="download.php?film_id=' . $foreach_sf['id'] .'" title="لینک مستقیم">لینک مستقیم</a></td>
							</tr>
							<tr>
								<td>تعداد دانلود</td>
								<td>' . $foreach_sf['download'] . ' بار دانلود</td>
							</tr>
							<tr>
								<td>زیرنویس ها</td>
								<td>';

								$rs = read_subtitle($foreach_sf['id']);
								if(!($rs===false))
								{
									$i = 1;
									foreach ($rs as $foreach_rs) {
										echo '- <a href="subtitle/' . $foreach_rs['url'] .'" title="' . $foreach_rs['description'] . '">دانلود زیر نویس ' . $i . '</a><br />';
										$i+=1;
									}
								}
								else
								{
									echo 'در حال حاظر زیرنویسی برای این فیلم موجود نیست.';
								}

								echo '</td>
							</tr>
						</table>
					</div>
					<div id="comment_form">
						<form action="" method="post">
							<table>
								<tr>
									<td><label for="name">نام</label></td>
									<td><input type="text" name="name" id="name" maxlength="100" /></td>
								</tr>
								<tr>
									<td><label for="email">ایمیل</label></td>
									<td><input type="text" name="email" id="email" maxlength="100" /></td>
								</tr>
								<tr>
									<td><label for="content">نظر</label></td>
									<td><textarea name="content" id="content" maxlength="20000"></textarea></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" value="ثبت نظر" /></td>
								</tr>
								<tr>
									<td colspan="2">';
										if(isset($comment_error))
										{
											switch ($comment_error) {
												case '1':
													echo '<p style="margin:20px; display:block; color:#f00">لطفا فیلد های بالا را خالی نگذارید.</p>';
												break;
												case '2':
													echo '<p style="margin:20px; display:block; color:#f00">حداکثر طول فیلدهای بالا را رعایت کنید.</p>';
												break;
												case '3':
													echo '<p style="margin:20px; display:block; color:#f00">نظر ثبت نشد.</p>';
												break;
												case '4':
													echo '<p style="margin:20px; display:block; color:#0c0">نظر ثبت شد.</p>';
												break;
											}
										}
									echo'</td>
								</tr>
							</table>
						</form>
					</div>
					<div id="comment_list">';
						$lfc = list_film_comment($_GET['id']);
						if($lfc===false)
						{
							echo "<p style='background:#67AF78; color:#fff; text-align:center; padding:25px;'>هیچ نظری برای این فیلم ثبت نشده است.</p>";
						}
						else
						{
							echo "<p style='background:#67AF78; color:#fff; text-align:center; padding:25px;'>لیست نظرات</p>";
							foreach ($lfc as $foreach_lfc) {
								echo '<p style="background:#67AF78; color:#fff; display:inline; padding:5px; margin-left:10px;">' . $foreach_lfc['name'] . ' گفته : </p><p>' . $foreach_lfc['content'] . '</p>';
							}
						}
					echo '</div>
					</div>';
				}
			}
		?>
	</div>
</div>
<?php require_once('footer.php'); ?>