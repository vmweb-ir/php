<?php
	if(!(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']!=0))
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
			$rpf = read_post_category(ltrim(rtrim($_GET['id'])));
			if($rpf===false)
			{
				echo "<p style='background:#67AF78; color:#fff; text-align:center; padding:25px;'>هیچ فیلمی در این دسته موجود نیست.</p>";
			}
			else
			{
				$rpf_count = 10;
				foreach ($rpf as $foreach_rpf) {
					echo '<div class="my_content_item">
						<h2><a href="film.php?id=' . $foreach_rpf['id'] . '" title="دانلود فیلم + ادامه">' . $foreach_rpf['title'] . '</a></h2>
						<div id="image_box"><img src="image/' . $foreach_rpf['image'] . '" width="500" alt="' . $foreach_rpf['title'] . '" title="' . $foreach_rpf['title'] . '" /></div>
						<p>' . word_cut($foreach_rpf['content']) . '</p>
						<div id="film_key"><a href="film.php?id=' . $foreach_rpf['id'] . '" title="دانلود فیلم + ادامه">دانلود فیلم + ادامه</a></div><div class="clear"></div>
						</div>';
					$rpf_count-=1;
					if(!$rpf_count)
						break;
				}
			}
		?>
	</div>
</div>
<?php require_once('footer.php'); ?>