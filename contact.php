<?php require_once('header.php'); ?>
<div class="right">
<style>
*{
box-sizing: border-box;
}
.container{
width: 100%;
}
input,select,textarea{
width: 100%;
margin: 0 0 10px 0;
padding: 10px;
}
.btn1{
background-color: green;
color: #fff;
}
</style>
	<div class="my_content">
		<div class="my_content_item">
			<h2>تماس با ما</h2>
			
<div class="container">
<form action="/action_page.php" method="post">
<label for="fname">اسم</label>
<input type="text" id="fname" name="firstname" placeholder="نام خود را وارد نمایید...">
<label for="lname">شهرت</label>
<input type="text" id="lname" name="lastname" placeholder="نام خانوادگی خود را وارد نمایید...">
<label for="city">شهر</label>
<select id=" city " name=" شهر ">
<option value="shiraz"> تبریز </option>
<option value="tehran"> ارومیه </option>
<option value="ahvaz"> اردبیل </option>
</select>
<label for="subject">توضیحات</label>
<textarea id="subject" name="subject" placeholder="پیام خود را وارد نمایید" style="height:200px"></textarea>
<input class="btn1" type="submit" value="ارسال">
</form>
</div>
			
			
			
			<p>با استفاده از فرم بالا می توانید با طراحان سایت در ارتباط باشید</p>
		</div>
	</div>
</div>
<?php require_once('footer.php'); ?>