<?php require_once('header.php');?>
<div class="index_content">

  <p class="index_letters">
    We provide you a basis of <?php echo count($movies); ?> films divided into <?php echo count($genres); ?> genres.
  </p>
  <div class="index_row">

      <div class="index_column">
        <p class="search_results">The oldest movies</p>
        <?php
          usort($movies, 'comparatorFunc');
          for ($i=0; $i < 10; $i++) {
            $movie = $movies[$i];
            include 'archive-movie.php';
          }
        ?>
      </div>


      <div class="index_column">
        <p class="search_results">The newest movies</p>
          <?php
            for ($i = count($movies)-1; $i > count($movies)-11; $i--) {
              $movie = $movies[$i];
              include 'archive-movie.php';
            }
          ?>
      </div>

  </div>
</div>
<?php require_once('footer.php'); ?>
