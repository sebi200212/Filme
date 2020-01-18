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
 ?>
