<?php

  // movie entry in ratings db
  class movie_rating {
    public $rating = 0;
    public $nr_ratings = 0;
  }

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

  function ratingSystem($id, $rating) {
    $rating_db = json_decode(file_get_contents('movies_rating.txt'));

    if (isset($rating_db[$id - 1])) {
      $crt_movie = $rating_db[$id - 1];
      $crt_movie->rating = round((($crt_movie->rating * $crt_movie->nr_ratings + $rating) / ++$crt_movie->nr_ratings), 0);
  function ratingSystem($id, $rating) {
    $rating_db = json_decode(file_get_contents('movies_rating.txt'))->movies;

    if (isset($rating_db[$id])) {
      $crt_movie = $rating_db[$id];
      $crt_movie->rating = round((($crt_movie->rating * $crt_movie->nr_ratings + $rating) / ++$crt_movie->nr_ratings), 2);
    } else {
      $rating_db[$id] = new stdClass();
      $crt_movie = $rating_db[$id];
      $crt_movie->id = $id;
      $crt_movie->rating = $rating;
      $crt_movie->nr_ratings = 1;
    }
  // set new rating of a movie
  function ratingSystem($id, $rating) {
    $rating_db = json_decode(file_get_contents('movies_rating.txt'));

    $crt_movie = $rating_db[$id - 1];
		$crt_movie->rating = round((($crt_movie->rating * $crt_movie->nr_ratings + $rating) / ++$crt_movie->nr_ratings), 2);

    return $rating_db;
  }

	// create a movie database with no ratings
  function create_db ($movies) {
    $rating_db = array();
    for ($id = 0; $id < sizeof($movies); $id++) {
      $rating_db[$id] = new movie_rating;
		}
		return $rating_db;
	}

	// get the rating of a movie and return it
	function get_rating ($id) {
		$rating_db = json_decode(file_get_contents('movies_rating.txt'));
		return $rating_db[$id - 1]->rating;
	}
 ?>
