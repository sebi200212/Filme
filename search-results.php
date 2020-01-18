<?php require_once('header.php');
  $movieTitle = $_GET['s'];
  $GET_COPY = $_GET['s'];
  $movieTitle = ucwords($movieTitle);
  if ($movieTitle) {
    function get_search_results($value) {
      global $movieTitle;
      if(strstr($value->title, $movieTitle)                                                                                                                                                                                                                                                                                                                               ) {
        return TRUE;
      }else {
        return FALSE;
      }
    }
    $moviesFiltrate = array_filter($movies, "get_search_results");?>
    <ul><?php
    if ($movieTitle) {
        if (strlen($GET_COPY) >= 3) {
              ?>
            <p class="search_results"><?php echo 'Search results for: '.$GET_COPY.'<br><br>' ?></p>
            <?php foreach ($moviesFiltrate as $movie) { ?>

            <?php include 'archive-movie.php'; ?>

      <?php }
      }else {
          ?>
            <br><br>
            <p class="text">Please enter at least 3 characters!</p><br><br>
          <?php
        }
    }
    if (count($moviesFiltrate) > 0) {
      $movie = reset($moviesFiltrate);
    }else { ?>
       <p class="text">Nu exista acest film. Mergi <a href="archive.php">inapoi la arhiva</a>.<br><br></p>
    <?php }
  }else{
    ?>
    <br><br>
    <p class="text">Please enter an existent movie title!</p><br><br>
    <?php
  }
  ?>
<?php require_once('footer.php');?>
