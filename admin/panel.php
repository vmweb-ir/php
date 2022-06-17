<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>پنل مدیریت سراج مووی</title>
		<link rel="stylesheet" href="../content/css/admin.css" />
		<link rel="stylesheet" href="../content/css/font-awesome.css">
		<link rel="stylesheet" href="../content/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/ico" href="../content/image/favicon.png">
	</head>
	<?php
		@session_start();
		if(!isset($_SESSION['access']))
		{
			header("location:index.php");
		}
		else
		{
			require_once("function.php");
		}
	?>
	<body>
		<div class="panel">
			<div class="admin_menu">
				<ul>
					<li><a href="panel.php?id=1" title="پنل مدیریت">پنل مدیریت</a></li>
					<li><a href="panel.php?id=2" title="فیلم ها">فیلم ها</a></li>
					<li><a href="panel.php?id=3" title="زیرنویس ها">زیرنویس ها</a></li>
					<li><a href="panel.php?id=4" title="دسته بندی ها">دسته بندی ها</a></li>
					<li><a href="panel.php?id=5" title="ژانرها">ژانرها</a></li>
					<li><a href="panel.php?id=6" title="نظرات">نظرات</a></li>
					<li><a href="panel.php?id=7" title="تنظیمات">تنظیمات</a></li>
					<li><a href="panel.php?id=14" title="برچسب ها">برچسب ها</a></li>
					<li><a href="panel.php?id=8" title="گزارش ها">گزارش ها</a></li>
					<li><a target="_blank" href="../index.php" title="مشاهده سایت">مشاهده سایت</a></li>
					<li><a href="panel.php?id=9" title="خروج">خروج</a></li>
				</ul>
			</div>

			<div class="panel_content">
				<?php
					if(isset($_GET['id']) || is_numeric($_GET['id']))
					{
						$page_id = $_GET['id'];
						if($page_id==1)
						{
							$_SESSION['access']=1;
							include_once('page/home.php');
						}
						elseif($page_id==2)
						{
							$_SESSION['access']=2;
							include_once('page/film.php');
						}
						elseif($page_id==3)
						{
							$_SESSION['access']=3;
							include_once('page/subtitle.php');
						}
						elseif($page_id==4)
						{
							$_SESSION['access']=4;
							include_once('page/category.php');
						}
						elseif($page_id==5)
						{
							$_SESSION['access']=5;
							include_once('page/genere.php');
						}
						elseif($page_id==6)
						{
							$_SESSION['access']=6;
							include_once('page/comment.php');
						}
						elseif($page_id==7)
						{
							$_SESSION['access']=7;
							include_once('page/setting.php');
						}
						elseif($page_id==8)
						{
							$_SESSION['access']=8;
							include_once('page/report.php');
						}
						elseif($page_id==9)
						{
							unset($_SESSION['access']);
							header("location:index.php");
						}
						elseif($page_id==10)
						{
							$_SESSION['access']=10;
							include_once('page/edit_category.php');
						}
						elseif($page_id==11)
						{
							$_SESSION['access']=11;
							include_once('page/edit_genere.php');
						}
						elseif($page_id==12)
						{
							$_SESSION['access']=12;
							include_once('page/edit_film.php');
						}
						elseif($page_id==13)
						{
							$_SESSION['access']=13;
							include_once('page/edit_subtitle.php');
						}
						elseif($page_id==14)
						{
							$_SESSION['access']=14;
							include_once('page/tag.php');
						}
						elseif($page_id==15)
						{
							$_SESSION['access']=15;
							include_once('page/edit_tag.php');
						}
					}
					else
					{
						header("location:panel.php?id=1");
					}
				?>
			</div>
			<div class="clear"></div>
		</div>
	</body>
</html>