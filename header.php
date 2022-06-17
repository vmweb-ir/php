<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>پروژه طراحی سایت / سراج</title>
		<link rel="stylesheet" href="content/css/layout.css" />
		<link rel="stylesheet" href="content/css/font-awesome.css">
		<link rel="stylesheet" href="content/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/ico" href="content/image/favicon.png">
	</head>
	<?php
		require_once('function.php');
	?>
	<body>
		<div class="header">
			<h1><a href="#" title="کاکتوس مووی">وبسایت مدیریت و انتشار ویدیو</a></h1>
			<p>در این وبسایت فیلم های ایرانی و خارجی بصورت رایگان منتشر خواهد شد.</p>
		</div>
	
		<div id="nav">
			<div class="menu">
				<ul>
					<li><a href="index.php" title="صفحه اصلی">صفحه اصلی</a></li>
					<li><a href="<?php echo read_telegram(); ?>" title="کانال تلگرامی سایت">کانال تلگرامی سایت</a></li>
					<li><a href="<?php echo read_instagram(); ?>" title="صفحه اینستاگرام سایت">صفحه اینستاگرام سایت</a></li>
					<li><a href="about.php" title="درباره ما">درباره ما</a></li>
					<li><a href="contact.php" title="تماس با ما">تماس با ما</a></li>
				</ul>
				<div class="social">
					<a style="color:#2ca4df;" href="<?php echo read_telegram(); ?>" title="کانال تلگرامی سایت" target="_blank"><span style="background:#fff; border-radius:15px;" class="fa fa-2x fa-telegram"></a>
					<a style="color:#de5145;" href="<?php echo read_instagram(); ?>" title="صفحه اینستاگرام سایت" target="_blank"><span style="background:#fff; border-radius:15px;" class="fa fa-2x fa-instagram"></a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	
	<div class="main">
		<div class="left">
			<div class="left_block">
				<h3>سراج مووی</h3>
				<div class="logo">
					<img src="content/image/logo.png" width="200" title="سراج مووی" alt="سراج مووی" />
				</div>
			</div>

			<div class="left_block">
				<h3>جستجو</h3>
				<form action="search.php" method="get">
					<input id="search" type="text" name="search" placeholder="تایپ + اینتر" />
				</form>
			</div>

			<div class="left_block">
				<h3>آخرین فیلم ها</h3>
				<table>
					<?php 
						$rlf = read_list_film();
						$rlf_count = 5;
						foreach ($rlf as $foreach_rlf) {
							echo '<tr><td><span class="fa fa-circle-o fa-lg"></span></td><td><a href="film.php?id=' . $foreach_rlf['id'] . '" title="' . $foreach_rlf['title'] . '">' . $foreach_rlf['title'] . '</a></td></tr>';
							$rlf_count-=1;
							if(!$rlf_count)
								break;
						}
					?>
				</table>
			</div>

			<div class="left_block">
				<h3>موضوعات</h3>
				<table>
					<?php 
						$rc = read_category();
						$rc_count = 0; #unlimited
						foreach ($rc as $foreach_rc) {
							echo '<tr><td><span class="fa fa-circle-o fa-lg"></span></td><td><a href="cat.php?id=' . $foreach_rc['id'] . '" title="' . $foreach_rc['name'] . '">' . $foreach_rc['name'] . '</a></td></tr>';
							$rc_count-=1;
							if(!$rc_count)
								break;
						}
					?>
				</table>
			</div>

			<div class="left_block">
				<h3>ژانرها</h3>
				<table>
					<?php 
						$rg = read_genere();
						$rg_count = 0; #unlimited
						foreach ($rg as $foreach_rg) {
							echo '<tr><td><span class="fa fa-circle-o fa-lg"></span></td><td><a href="gen.php?id=' . $foreach_rg['id'] . '" title="' . $foreach_rg['name'] . '">' . $foreach_rg['name'] . '</a></td></tr>';
							$rc_count-=1;
							if(!$rc_count)
								break;
						}
					?>
				</table>
			</div>

			<div class="left_block">
				<h3>آمار سایت</h3>
				<table>
					<tr>
						<td><span class="fa fa-circle-o fa-lg"></span> تعداد فیلم ها:</td>
						<td><?php echo count_film(); ?></td>
					</tr>
					<tr>
						<td><span class="fa fa-circle-o fa-lg"></span> تعداد نظرات:</td>
						<td><?php echo count_comment(); ?></td>
					</tr>
					<?php $view=view(); ?>
					<tr>
						<td><span class="fa fa-circle-o fa-lg"></span> بازدید امروز:</td>
						<td><?php echo $view[0]; ?></td>
					</tr>
					<tr>
						<td><span class="fa fa-circle-o fa-lg"></span> بازدید دیروز:</td>
						<td><?php echo $view[1]; ?></td>
					</tr>
					<tr>
						<td><span class="fa fa-circle-o fa-lg"></span> بازدید کل:</td>
						<td><?php echo $view[2]; ?></td>
					</tr>
				</table>
			</div>

			<div class="left_block">
				<h3>کلمات کلیدی</h3>
				<table>
					<tr>
						<td>
							<?php 
								$rg = read_tag();
								$rg_count = 0; #unlimited
								foreach ($rg as $foreach_rg) {
									echo '<a href="index.php" title="' . $foreach_rg['name'] . '"><b>' . $foreach_rg['name'] . '</b></a> - ';
									$rg_count-=1;
									if(!$rg_count)
										break;
								}
							?>
						</td>
					</tr>
				</table>
			</div>
		</div>