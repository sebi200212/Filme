<?php
  function runtime_calculator($run) {
    $h = intval($run/60);
    if ($h == 1)
      $return_value = $h." hour ";
    else
      $return_value = $h." hours ";
    $min = $run%60;
    if ($min == 1)
      $return_value = $return_value."and ".$min." minute";
    else
      $return_value = $return_value."and ".$min." minutes";
    return $return_value;
	}
	
  function longest_movie ($movies) {
    if (!isset($_COOKIE['longest-movie-length'])) {
      $movies_runtime = array_column($movies, "runtime");
      $max_runtime = max($movies_runtime);
      setcookie("longest-movie-length", $max_runtime);
      return $max_runtime;
    }else {
      $max_runtime = $_COOKIE['longest-movie-length'];
      return $max_runtime;
    }
  }

  // check if a table is present
  function check_table ($id) {
    $db = db_connect();
    $query = "SELECT id FROM `m$id` WHERE 1";
    if ($db->query($query) == FALSE) {
      $query = "
        CREATE TABLE `movies`.`m$id`
        (`rating` INT  NOT NULL,
         `date`   DATE NOT NULL);
      ";
			return $db->query($query);
		}
		$db->close();
  }

  // set new rating of a movie
  function set_rating($id, $rating) {
    $db = db_connect();
		check_table($id);
		$date  = date('Y-m-d');
		$query = "INSERT INTO `movies` . `m$id` (`rating`, `date`) VALUES ($rating, DATE '$date');";
		$db->query($query);
    $db->close();
  }

	// get the rating of a movie and return it
	function get_rating ($id) {
    // init db
    $db = db_connect();

		// average of all ratings from specific movie table
    $query  = "SELECT AVG(ALL rating) AS `average` FROM `movies`.`m$id`;";
		$result = $db->query($query);
		$db->close();
		$result = $result->fetch_assoc();
		$result = $result['average'];
		$result = intval($result);
		return $result;
  }
  
  function db_connect ($host = 'localhost', $name = 'php_user', $pass = '', $database = 'movies') {
    return new mysqli($host, $name, $pass, $database);
  }
?>
