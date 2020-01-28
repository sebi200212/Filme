<?php
  // movie entry in ratings db

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
  function longest_movie($movies) {
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
  function comparatorFunc( $x, $y) {
        // If $x is equal to $y it returns 0
        if ($x->year== $y->year)
            return 0;

        // if x is less than y then it returns -1
        // else it returns 1
        if ($x->year < $y->year)
            return -1;
        else
            return 1;
  }

  // set new rating of a movie
  function ratingSystem($id, $rating) {
    $rating_db = json_decode(file_get_contents('movies_rating.txt'));
    $rating_db[$id - 1][$rating - 1]++;
    return $rating_db;
  }

	// create a movie database with no ratings
  function create_db ($movies) {
    // open file for writing (or create it)
    $file = fopen('movies_rating.txt', 'w');
    // make a new array containing all movies
    $rating_db = array();
    // add a field for each movie
    for ($id = 0; $id < sizeof($movies); $id++) {
      $rating_db[$id] = array(
  		  0 => 0,
  		  1 => 0,
  		  2 => 0,
  		  3 => 0,
  		  4 => 0
		  );
    }
    // write database in json form to movie
    fwrite($file, json_encode($rating_db));
    // close the file
    fclose($file);
		return $rating_db;
	}

	// get the rating of a movie and return it
	function get_rating ($id) {
    // get database from file
    $rating_db = json_decode(file_get_contents('movies_rating.txt'));
    // initialise empty temp variables
    $rating = 0;
    $people = 0;
    for ($i = 1; $i < 6; $i++) {
      // rating is a sum of all stars (1 * 3votes, 2 * 5votes, etc)
      $rating += $rating_db[$id - 1][$i - 1] * $i;
      $people += $rating_db[$id - 1][$i - 1];
    }
    if ($people)
      $rating /= $people;
    return $rating;
	}
?>
