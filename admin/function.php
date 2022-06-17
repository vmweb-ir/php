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

	function login_admin($username, $password)
	{
		$sql = database();
		$username = ($username);
		$password = sha1(($password));

		$query = "SELECT * FROM `tbl_user`";
		$result = mysqli_query($sql, $query);
		foreach ($result as $my_result) {
			if($my_result['username']==$username && $my_result['password']==$password)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	function add_film($film_name, $film_content, $film_category, $film_genere, $film_refrence_title, $film_refrence_url, $image_file, $film_file, $film_year)
	{
		$sql = database();
		$film_name = ($film_name);
		$film_content = ($film_content);
		$film_category = ($film_category);
		$film_genere = ($film_genere);
		$film_refrence_title = ($film_refrence_title);
		$film_refrence_url = ($film_refrence_url);
		$image_file = ($image_file);
		$film_file = ($film_file);
		$film_year = ($film_year);

		$query = "INSERT INTO `tbl_film`(`title`, `content`, `time`, `category_id`, `genere_id`, `refrence_title`, `refrence_url`, `view`, `download`, `image`, `file_download`, `make_year`) VALUES ('" . $film_name . "', '" . $film_content . "','" . time() . "', '" . $film_category . "','" . $film_genere . "', '" . $film_refrence_title . "', '" . $film_refrence_url . "', 0, 0, '" . $image_file . "', '" . $film_file . "', '" . $film_year . "')";
		if(mysqli_query($sql, $query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function read_film()
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

	function delete_film($id)
	{
		$sql = database();
		$id = ($id);
		$query = "DELETE FROM `tbl_film` WHERE `id`=" . $id;
		@mysqli_query($sql, $query);
	}

	function edit_film($id, $film_name, $film_content, $film_category, $film_genere, $film_refrence_title, $film_refrence_url, $make_year, $image_file, $film_file)
	{
		$sql = database();
		$id = ($id);
		$film_name = ($film_name);
		$film_content = ($film_content);
		$film_category = ($film_category);
		$film_genere = ($film_genere);
		$film_refrence_title = ($film_refrence_title);
		$film_refrence_url = ($film_refrence_url);
		$make_year = ($make_year);
		$image_file = ($image_file);
		$film_file = ($film_file);

		if($image_file==" " && $film_file==" ")
		{
			$query = "UPDATE `tbl_film` SET `title`='" . $film_name . "',`content`='" . $film_content . "',`category_id`='" . $film_category . "',`genere_id`='" . $film_genere . "',`refrence_title`='" . $film_refrence_title . "',`refrence_url`='" . $film_refrence_url . "',`make_year`='" . $make_year . "' WHERE `id`=" . $id;
		}
		elseif(!empty($image_file) && !empty($film_file))
		{
			$query = "UPDATE `tbl_film` SET `title`='" . $film_name . "',`content`='" . $film_content . "',`category_id`='" . $film_category . "',`genere_id`='" . $film_genere . "',`refrence_title`='" . $film_refrence_title . "',`refrence_url`='" . $film_refrence_url . "',`make_year`='" . $make_year . "', `image`='" . $image_file . "', `file_download`='" . $film_file . "' WHERE `id`=" . $id;
		}
		elseif(!empty($image_file))
		{
			$query = "UPDATE `tbl_film` SET `title`='" . $film_name . "',`content`='" . $film_content . "',`category_id`='" . $film_category . "',`genere_id`='" . $film_genere . "',`refrence_title`='" . $film_refrence_title . "',`refrence_url`='" . $film_refrence_url . "',`make_year`='" . $make_year . "', `image`='" . $image_file . "' WHERE `id`=" . $id;
		}
		elseif(!empty($film_file))
		{
			$query = "UPDATE `tbl_film` SET `title`='" . $film_name . "',`content`='" . $film_content . "',`category_id`='" . $film_category . "',`genere_id`='" . $film_genere . "',`refrence_title`='" . $film_refrence_title . "',`refrence_url`='" . $film_refrence_url . "',`make_year`='" . $make_year . "', `file_download`='" . $film_file . "' WHERE `id`=" . $id;
		}
		@mysqli_query($sql, $query);
	}

	function single_film($id)
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_film` WHERE `id`=" . $id;
		$id = ($id);
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

	function add_category($category_name)
	{
		$sql = database();
		$category_name = ($category_name);

		$query = "INSERT INTO `tbl_category`(`name`) VALUES ('" . $category_name . "')";
		if(mysqli_query($sql, $query))
		{
			return true;
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

	function delete_category($id)
	{
		$sql = database();
		$id = ($id);
		$query = "DELETE FROM `tbl_category` WHERE `id`=" . $id;
		@mysqli_query($sql, $query);
	}

	function single_category($id)
	{
		$sql = database();
		$id = ($id);
		$query = "SELECT * FROM `tbl_category` WHERE `id`=" . $id;
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

	function edit_category($id, $name)
	{
		$sql = database();
		$id = ($id);
		$name = ($name);
		$query = "UPDATE `tbl_category` SET `name`='" . $name . "' WHERE `id`=" . $id;
		@mysqli_query($sql, $query);
	}

	function add_genere($genere_name)
	{
		$sql = database();
		$genere_name = ($genere_name);

		$query = "INSERT INTO `tbl_genere`(`name`) VALUES ('" . $genere_name . "')";
		if(mysqli_query($sql, $query))
		{
			return true;
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

	function delete_genere($id)
	{
		$sql = database();
		$id = ($id);
		$query = "DELETE FROM `tbl_genere` WHERE `id`=" . $id;
		@mysqli_query($sql, $query);
	}

	function single_genere($id)
	{
		$sql = database();
		$id = ($id);
		$query = "SELECT * FROM `tbl_genere` WHERE `id`=" . $id;
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

	function edit_genere($id, $name)
	{
		$sql = database();
		$id = ($id);
		$name = ($name);
		$query = "UPDATE `tbl_genere` SET `name`='" . $name . "' WHERE `id`=" . $id;
		@mysqli_query($sql, $query);
	}

	function add_subtitle($film_id, $subtitle_content, $subtitle_file)
	{
		$sql = database();
		$film_id = ($film_id);
		$subtitle_content = ($subtitle_content);
		$subtitle_file = ($subtitle_file);
		
		$query = "INSERT INTO `tbl_subtitle`(`film_id`, `description`, `url`) VALUES ('" . $film_id . "', '" . $subtitle_content . "', '" . $subtitle_file . "')";
		if(mysqli_query($sql, $query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function read_subtitle()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_subtitle` ORDER BY `id` DESC";
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

	function delete_subtitle($id)
	{
		$sql = database();
		$id = ($id);
		$query = "DELETE FROM `tbl_subtitle` WHERE `id`=" . $id;
		@mysqli_query($sql, $query);
	}

	function edit_subtitle($id, $film_id, $subtitle_content)
	{
		$sql = database();
		$id = ($id);
		$film_id = ($film_id);
		$subtitle_content = ($subtitle_content);

		$query = "UPDATE `tbl_subtitle` SET `film_id`='" . $film_id . "',`description`='" . $subtitle_content . "' WHERE `id`=" . $id;
		@mysqli_query($sql, $query);
	}

	function single_subtitle($id)
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_subtitle` WHERE `id`=" . $id;
		$id = ($id);
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
		$query = "SELECT * FROM `tbl_comment` ORDER BY `id` DESC";
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

	function delete_comment($id)
	{
		$sql = database();
		$id = ($id);
		$query = "DELETE FROM `tbl_comment` WHERE `id`=" . $id;
		@mysqli_query($sql, $query);
	}

	function accept_comment($id)
	{
		$sql = database();
		$id = ($id);

		$query = "UPDATE `tbl_comment` SET `status`=1 WHERE `id`=" . $id;
		@mysqli_query($sql, $query);
	}

	function read_instagram()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_user`";
		$return = mysqli_query($sql, $query);
		$return = mysqli_fetch_array($return);
		return $return['instagram'];
	}

	function edit_instagram($url)
	{
		$sql = database();
		$url = ($url);
		$query = "UPDATE `tbl_user` SET `instagram`='" . $url . "' WHERE 1";
		@mysqli_query($sql, $query);
		return true;
	}

	function read_telegram()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_user`";
		$return = mysqli_query($sql, $query);
		$return = mysqli_fetch_array($return);
		return $return['telegram'];
	}

	function edit_telegram($url)
	{
		$sql = database();
		$url = ($url);
		$query = "UPDATE `tbl_user` SET `telegram`='" . $url . "' WHERE 1";
		@mysqli_query($sql, $query);
		return true;
	}

	function change_password($old_password, $password)
	{
		$sql = database();
		$old_password = sha1(($old_password));
		$password = sha1(($password));

		$query = "SELECT * FROM `tbl_user`";
		$return = mysqli_query($sql, $query);
		$return = mysqli_fetch_array($return);
		if($return['password']==$old_password)
		{
			$query = "UPDATE `tbl_user` SET `password`='" . $password ."' WHERE `id`='1'";
			if(mysqli_query($sql, $query))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function add_tag($tag_name)
	{
		$sql = database();
		$tag_name = ($tag_name);

		$query = "INSERT INTO `tbl_tag`(`name`) VALUES ('" . $tag_name . "')";
		if(mysqli_query($sql, $query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function read_tag()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_tag` ORDER BY `id` DESC";
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

	function delete_tag($id)
	{
		$sql = database();
		$id = ($id);
		$query = "DELETE FROM `tbl_tag` WHERE `id`=" . $id;
		@mysqli_query($sql, $query);
	}

	function single_tag($id)
	{
		$sql = database();
		$id = ($id);
		$query = "SELECT * FROM `tbl_tag` WHERE `id`=" . $id;
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

	function edit_tag($id, $name)
	{
		$sql = database();
		$id = ($id);
		$name = ($name);
		$query = "UPDATE `tbl_tag` SET `name`='" . $name . "' WHERE `id`=" . $id;
		@mysqli_query($sql, $query);
	}

	function read_top_view()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_film` ORDER BY `view` DESC";
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

	function read_top_download()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_film` ORDER BY `download` DESC";
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

	function read_top_comment()
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_film`";
		$return = mysqli_query($sql, $query);
		if(mysqli_num_rows($return)!=0)
		{
			$i=0;
			foreach ($return as $my_return) {
				$data[$i] = $my_return;
				$query = "SELECT * FROM `tbl_comment` WHERE `film_id`='" . $my_return['id'] . "'";
				$result = mysqli_query($sql, $query);
				if(mysqli_num_rows($result)>0)
				{
					$count = 0;
					foreach ($result as $my_result) {
						$count+=1;
					}
					
					$result = $count;
				}
				else
				{
					$result =  0;
				}
				$data[$i]['comment_count'] = $result;
				$i+=1;
			}
			$data = array_sort($data, 'comment_count', SORT_DESC);
			$returnss = $data;
			return $returnss;
		}
		else
		{
			return false;
		}
	}

	function array_sort($array, $on, $order = SORT_ASC)
	{
	    $new_array = array();
	    $sortable_array = array();
	    if (count($array) > 0)
	    {
	        foreach ($array as $k => $v)
	        {
	            if (is_array($v))
	            {
	                foreach ($v as $k2 => $v2)
	                {
	                    if ($k2 == $on)
	                    {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else
	            {
	                $sortable_array[$k] = $v;
	            }
	        }
	        switch ($order)
	        {
	            case SORT_ASC:
	                asort($sortable_array);
	                break;
	            case SORT_DESC:
	                arsort($sortable_array);
	                break;
	        }
	        foreach ($sortable_array as $k => $v)
	        {
	            $new_array[$k] = $array[$k];
	        }
	    }
	    return $new_array;
	}

	function view_film_onetime($id, $time)
	{
		$sql = database();
		$query = "SELECT * FROM `tbl_film_view` WHERE `film_id`=$id AND `view_timespan`>$time";
		$return = mysqli_query($sql, $query);
		
		if(mysqli_num_rows($return)>0)
		{
			$counter=0;
			foreach ($return as $my_return) {
				$counter+=1;
			}
			return $counter;
		}
		else
		{
			return 0;
		}
	}
?>