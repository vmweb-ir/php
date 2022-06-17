<?php
	function database()
	{
		if(!@$sql = mysqli_connect('localhost','root','','seraj'))
		{
			echo 'NO CONNECT...!!';
			die('');
		}
		else
		{
			mysqli_query($sql,'SET CHARACTER SET utf8;');
			return $sql;
		}
	}

	function read_film($page=1, $rf_count)
	{
		$sql = database();
		$page = (ltrim(rtrim($page)));
		if(empty($page) || !is_numeric($page) || $page==0 || $page==1)
		{
			$page = 1;
			$query = "SELECT * FROM `tbl_film` ORDER BY `id` DESC";
		}
		else
		{
			$a = (($page-1)*7)+1;
			$b = $rf_count;
			$query = "SELECT * FROM `tbl_film` ORDER BY `id` DESC LIMIT " . $a . ", " . $b;
		}
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			return $return;
		}
		else
		{
			return false;
		}
	}

	function read_list_film()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_film` ORDER BY `id` DESC";
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			return $return;
		}
		else
		{
			return false;
		}
	}
	
	function single_film($id)
	{
		$sql = database();
		$id = ($id);
		$query = "SELECT * FROM `tbl_film` WHERE `id`=" . $id;
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			$data = mysqli_fetch_array($return);
			$view = $data['view']+1;
			$query = "UPDATE `tbl_film` SET `view`=" . $view . " WHERE `id`=" . $id;
			mysqli_query($sql, $query);
			new_film_view($id);
			return $return;
		}
		else
		{
			return false;
		}
	}

	function read_file_film($id)
	{
		$sql = database();
		$id = ($id);
		$query = "SELECT * FROM `tbl_film` WHERE `id`=" . $id;
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			$data = mysqli_fetch_array($return);
			$file_download = $data['file_download'];
			$download = $data['download']+1;
			$query = "UPDATE `tbl_film` SET `download`=" . $download . " WHERE `id`=" . $id;
			mysqli_query($sql, $query);
			return $file_download;
		}
		else
		{
			return false;
		}
	}

	function count_film()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_film` ORDER BY `id` DESC";
		$return = mysqli_query($sql, $query);
		return mysqli_num_rows($return);
	}

	function read_post_category($id)
	{
		$sql = database();
		$id = ($id);
		$query = "SELECT * FROM `tbl_film` WHERE `category_id`='" . $id . "' ORDER BY `id` DESC";
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return))
		{
			return $return;
		}
		else
		{
			return false;
		}
	}

	function read_post_genere($id)
	{
		$sql = database();
		$id = ($id);
		$query = "SELECT * FROM `tbl_film` WHERE `genere_id`='" . $id . "' ORDER BY `id` DESC";
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return))
		{
			return $return;
		}
		else
		{
			return false;
		}
	}

	function read_category()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_category` ORDER BY `id` DESC";
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			return $return;
		}
		else
		{
			return false;
		}
	}

	function read_category_name($id)
	{
		$sql = database();
		$id = ($id);
		$query = "SELECT * FROM `tbl_category` WHERE `id`=" . $id;
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			$return = mysqli_fetch_array($return);
			return $return['name'];
		}
		else
		{
			return false;
		}
	}
	
	function read_genere()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_genere` ORDER BY `id` DESC";
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			return $return;
		}
		else
		{
			return false;
		}
	}

	function read_genere_name($id)
	{
		$sql = database();
		$id = ($id);
		$query = "SELECT * FROM `tbl_genere` WHERE `id`=" . $id;
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			$return = mysqli_fetch_array($return);
			return $return['name'];
		}
		else
		{
			return false;
		}
	}
	
	function read_subtitle($id)
	{
		$sql = database();
		$id = ($id);
		$query = "SELECT * FROM `tbl_subtitle` WHERE `film_id`=" . $id;
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			return $return;
		}
		else
		{
			return false;
		}
	}

	function read_comment()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_comment`";
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			return $return;
		}
		else
		{
			return false;
		}
	}

	function count_comment()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_comment`";
		$return = mysqli_query($sql, $query);
		return mysqli_num_rows($return);
	}

	function count_post_comment($id)
	{
		$sql = database();
		$id = ($id);
		$query = "SELECT * FROM `tbl_comment` WHERE `film_id`=" . $id;
		$return = mysqli_query($sql, $query);
		return mysqli_num_rows($return);
	}

	function read_username()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_user`";
		$return = mysqli_query($sql, $query);
		$return = mysqli_fetch_array($return);
		return $return['username'];
	}

	function read_instagram()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_user`";
		$return = mysqli_query($sql, $query);
		$return = mysqli_fetch_array($return);
		return $return['instagram'];
	}

	function read_telegram()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_user`";
		$return = mysqli_query($sql, $query);
		$return = mysqli_fetch_array($return);
		return $return['telegram'];
	}

	function read_tag()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_tag`";
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			return $return;
		}
		else
		{
			return false;
		}
	}

	function view()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_view`";
		$result = mysqli_query($sql, $query);
		if(mysqli_num_rows($result)>0)
		{
			foreach ($result as $my_result) {
				$today = $my_result['today'];
				$yesterday = $my_result['yesterday'];
				$total = $my_result['total'];
				$last = $my_result['last'];
			}

			$now = date('y') . date('n') . date('j');
			if($last==$now)
			{
				$today = $today+1;
				$total = $total+1;
				$query = "UPDATE `tbl_view` SET `today`='" . $today . "', `total`='" . $total . "' WHERE 1";
			}
			else
			{
				$yesterday = $today;
				$today = 1;
				$total = $total+1;
				$last =  date('y') . date('n') . date('j');
				$query = "UPDATE `tbl_view` SET `today`='" . $today . "',`yesterday`='" . $yesterday . "',`total`='" . $total . "',`last`='" . $last . "' WHERE 1";
			}
			@mysqli_query($sql, $query);

			return array($today, $yesterday, $total);
		}
	}

	function add_comment($film_id, $name, $email, $content)
	{
		$sql = database();
		$name = ($name);
		$email = ($email);
		$content = ($content);

		$query = "INSERT INTO `tbl_comment`(`film_id`, `status`, `name`, `email`, `content`) VALUES ('" . $film_id . "', '0', '" . $name . "', '" . $email . "', '" . $content . "')";
		if(mysqli_query($sql, $query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function list_film_comment($film_id)
	{
		$sql = database();
		$film_id = ($film_id);
		$query = "SELECT * FROM `tbl_comment` WHERE `film_id`=" . $film_id . " AND `status`=1";
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return))
		{
			return $return;
		}
		else
		{
			return false;
		}
	}

	function search_film($search)
	{
		$sql = database();
		$search = "%" . ($search) . "%";
		$query = "SELECT * FROM `tbl_film` WHERE `content` LIKE '" . $search . "'";
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			return $return;
		}
		else
		{
			return false;
		}
	}

	function new_film_view($id)
	{
		if(empty($id) || !is_numeric($id))
		{
			header("location:index.php");
		}
		$id = ($id);
		$sql = database();
		$query = "INSERT INTO `tbl_film_view`(`film_id`, `view_timespan`) VALUES ('" . $id . "', '" . time() . "')";
		mysqli_query($sql, $query);
		return true;
	}

	function word_cut($str)
	{
		preg_match('/^\s*+(?:\S++\s*+){1,' . 100 . '}/', $str, $matches);
		return rtrim($matches[0]) . '&nbsp; &#8230;';
	}
?>