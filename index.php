<?php
	if(!(isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']!=0))
	{
		$pagess=1;
	}
	else
	{
		$pagess = $_GET['page'];
	}
	require_once('header.php');
?>
<div class="right">
	<div class="my_content">
		<?php
			$rf_count = 7;
			$rf = read_film($pagess, $rf_count);
			if($rf===false)
			{
				echo "<p style='background:#67AF78; color:#fff; text-align:center; padding:25px;'>هیچ فیلمی موجود نیست.</p>";
			}
			else
			{
				foreach ($rf as $foreach_rf) {
					echo '<div class="my_content_item">
					<h2><a href="film.php?id=' . $foreach_rf['id'] . '" title="دانلود فیلم + ادامه">' . $foreach_rf['title'] . '</a></h2>
					<div id="image_box"><img src="image/' . $foreach_rf['image'] . '" width="500" alt="' . $foreach_rf['title'] . '" title="' . $foreach_rf['title'] . '" /></div>
					<p>' . word_cut($foreach_rf['content']) . '</p>
					<div id="film_key"><a href="film.php?id=' . $foreach_rf['id'] . '" title="دانلود فیلم + ادامه">دانلود فیلم + ادامه</a></div><div class="clear"></div>
					</div>';
					$rf_count-=1;
					if(!$rf_count)
						break;
				}
				echo '<div class="page_navi">';
				$page=1;
				$count=10;
				for($i=0;$i<=count_film();$i+=7)
				{
					echo '<p><a href="index.php?page=' . $page . '" title="صفحه ' . $page . '">' . $page . '</a></p>';
					$page+=1;

					if(fmod($page, $count)==0)
					{
						break;
					}
				}
				echo '</div>';
			}
		?>
	</div>
</div>
<?php require_once('footer.php'); ?>