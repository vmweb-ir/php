<?php
	@session_start();
	if(!(isset($_SESSION['access']) && $_SESSION['access']==6))
	{
		header('location:index.php');
	}
?>
<h2>بخش نظرات</h2>
<div class="form_data">
<b>لیست نظرات:</b>
	<table class="form_database" cellspacing="0" cellpadding="0">
		<tr>
			<td>نام</td>
			<td>نظر</td>
			<td>عملیات</td>
		</tr>
		<?php
			$rc = read_comment();
			if($rc===false)
			{
				echo '<td>جدول نظرات خالی است.</td><td></td><td></td>';
			}
			else
			{
				foreach ($rc as $foreach_rc) {
					echo '<tr><td style="font-size:11px;">' . $foreach_rc['name'] . '</td><td style="font-size:11px;">' . $foreach_rc['content'] . '</td><td><a id="accept" href="page/accept_view.php?comment_id=' . $foreach_rc['id'] . '" title="تایید نمایش نظر">تایید نمایش نظر</a><a id="site" href="../film.php?id=' . $foreach_rc['id'] . '" title="نمایش فیلم">نمایش فیلم</a><a id="delete" href="page/delete_comment.php?comment_id=' . $foreach_rc['id'] .'" title="حذف نظر">حذف نظر</a></td></tr>';
				}
			}
		?>
	</table>
	<?php
		if(isset($_SESSION['comment']))
		{
			unset($_SESSION['comment']);
			echo '<p style="color:#0c0">عملیات انجام شد.</p>';
		}
	?>
</div>