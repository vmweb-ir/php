<?php
	if(!(isset($_GET['search']) && !empty($_GET['search'])))
	{
		header("location:index.php");
	}
	else
	{
		require_once('header.php');
	}
?>
<div class="right">
	<div class="my_content">
		<?php
			$sf = search_film(ltrim(rtrim($_GET['search'])));
			if($sf===false)
			{
				echo "<p style='background:#67AF78; color:#fff; text-align:center; padding:25px;'>هیچ چیزی یافت نشد.</p>";
			}
			else
			{
				$sf_count = 10;
				foreach ($sf as $foreach_sf) {
					echo '<div class="my_content_item">
						<h2><a href="film.php?id=' . $foreach_sf['id'] . '" title="دانلود فیلم + ادامه">' . $foreach_sf['title'] . '</a></h2>
						<div id="image_box"><img src="image/' . $foreach_sf['image'] . '" width="500" alt="' . $foreach_sf['title'] . '" title="' . $foreach_sf['title'] . '" /></div>
						<p>' . word_cut($foreach_sf['content']) . '</p>
						<div id="film_key"><a href="film.php?id=' . $foreach_sf['id'] . '" title="دانلود فیلم + ادامه">دانلود فیلم + ادامه</a></div><div class="clear"></div>
						</div>';
					$sf_count-=1;
					if(!$sf_count)
						break;
				}
			}
		?>
	</div>
</div>
<?php require_once('footer.php'); ?>