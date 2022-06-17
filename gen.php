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
			$rpg = read_post_genere(ltrim(rtrim($_GET['id'])));
			if($rpg===false)
			{
				echo "<p style='background:#67AF78; color:#fff; text-align:center; padding:25px;'>هیچ فیلمی در این ژانر موجود نیست.</p>";
			}
			else
			{
				$rpg_count = 10;
				foreach ($rpg as $foreach_rpg) {
					echo '<div class="my_content_item">
						<h2><a href="film.php?id=' . $foreach_rpg['id'] . '" title="دانلود فیلم + ادامه">' . $foreach_rpg['title'] . '</a></h2>
						<div id="image_box"><img src="image/' . $foreach_rpg['image'] . '" width="500" alt="' . $foreach_rpg['title'] . '" title="' . $foreach_rpg['title'] . '" /></div>
						<p>' . word_cut($foreach_rpg['content']) . '</p>
						<div id="film_key"><a href="film.php?id=' . $foreach_rpg['id'] . '" title="دانلود فیلم + ادامه">دانلود فیلم + ادامه</a></div><div class="clear"></div>
						</div>';
					$rpg_count-=1;
					if(!$rpg_count)
						break;
				}
			}
		?>
	</div>
</div>
<?php require_once('footer.php'); ?>