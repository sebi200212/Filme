<?php require_once('header.php'); ?>
      <div class="row">
        <div class="column">
          <ul style="list-style-type:none;">
            <?php
                $actorsAllList = array();
                if (isset($_GET['genre']))
                  $genreGet = $_GET['genre'];
                if (isset($genreGet) && $genreGet && $genreGet != "") {
                  function get_movie_genre($value) {
                    global $genreGet;
                    return in_array($genreGet, $value->genres);
                  }
                  $moviesFiltrate = array_filter($movies, "get_movie_genre");
                  if (count($moviesFiltrate) > 0) { ?>
                    <p class="search_results"><?php echo $genreGet .' movies'.'<br><br>' ?></p>
                    <?php $movies = $moviesFiltrate;
                  }
                } ?>
            <?php foreach ($movies as $movie){
              // Atribuim variabilei $movie_year valoarea cu anul pentru a ne folosi de această variabilă ulterior
              $movie_year=$movie->year;

              // dacă anul filmului este mai mic de 2000, părăsim această repetare de foreach și trecem direct la următorul film. Dacă filmul e din 2000 sau mai nou, executăm codul de mai jos.
              // Creăm variabila $plot cu descrierea filmului pentru a o folosi mai jos de câteva ori.
              $plot=$movie->plot;
              $id = $movie->id;
            
              $max_runtime = longest_movie($movies);
              include 'archive-movie.php';
            } ?>
          </ul>
        </div>
        <div class="column">
          <div class="fixed-sidebar-text">
            <?php
              $actorsAllListCleaned = array_unique($actorsAllList);
              sort($actorsAllListCleaned);
              foreach ($actorsAllListCleaned as $actor) {
            ?>
                <li><?php echo $actor; ?></li>
                <br>
            <?php } ?>
          </div>
        </div>
      </div>
<?php include('footer.php'); ?>