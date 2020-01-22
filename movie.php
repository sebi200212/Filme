<?php require_once('header.php');
	$movies_rating = json_decode(file_get_contents('movies_rating.txt'));


  $movieId = $_GET['movie_id'];
  if (isset($movieId) && $movieId && $movieId != "") {
    function get_movie($value) {
      global $movieId;
      return ($movieId == $value->id);
    }

    $moviesFiltrate = array_filter($movies, "get_movie");
    if (count($moviesFiltrate) > 0) {
      $movie = reset($moviesFiltrate);
    } else { ?>
      <h2>Nu există acest film. Mergi <a href="archive.php">înapoi la arhivă</a>.</h2>
    <?php }
  }

	if (isset($_POST['rating'])) {
		$rating = $_POST['rating'];
    file_put_contents('movies_rating.txt', json_encode(ratingSystem($movieId, $rating)));
  }
  echo '<pre>' . print_r($movies_rating) . '</pre>';

  file_put_contents('movies_rating.txt', json_encode($movies_rating));

  ?>
  <ul>
    <div class = "movie">
      <div class="image">
          <?php
          $external_link = $movie->posterUrl;
          if (@GetImageSize($external_link)) {
          $logo = $movie->posterUrl;
          } else {
          $logo = 'images\placeholder.png';
          }
          ?>
          <img src=<?php echo $logo; ?> height: 450px; width: 300px; style="border-radius: 9px;"/>
      </div>
      <div class = "container">
          <h2> <?php echo $movie->title; ?></h2>
          <div class="rating">
            <div class="rating-upper" style="width: 20%">
                <span>★</span>
                <span>★</span>
                <span>★</span>
                <span>★</span>
                <span>★</span>
            </div>
            <div class="rating-lower">
                <span>★</span>
                <span>★</span>
                <span>★</span>
                <span>★</span>
                <span>★</span>
            </div>
          </div>
            
          <h2><?php echo $movie->title; ?></h2>

          <?php
            if ($movie->year >= 2010 )
              echo  "<strong>".$movie->year."</strong>";
            else
              echo $movie->year;
          ?>

          <div class = "plot">
            <?php
              echo $movie->plot;
            ?>
            <br><br>
          </div>
          <div class = "actori">
            <ol>
              <?php
                $actors = $movie->actors;
                $actorsArr = explode(', ', $actors);
                for ($actorsIncrement = 0; $actorsIncrement < count($actorsArr); $actorsIncrement++) {
                    $actorsAllList[] = $actorsArr[$actorsIncrement];
              ?>
                <li>
                  <?php echo $actorsArr[$actorsIncrement] ?>
                </li>
              <?php
                }
              ?>
            </ol>
            <br>
          </div>
          <div class="director">
            <?php echo $movie->director."<br/><br/>"; ?>
          </div>
          <div class="">

            <?php
            $genres_count = count($movie->genres);
            $genresIncrement = 0;
            foreach ($movie->genres as $genre) {
              echo $genre;
              if($genresIncrement < $genres_count - 1)
                echo ', ';
            $genresIncrement++;
            } ?>
            <br>
            <br>
          </div>


          <div class="time">
            <?php
              echo runtime_calculator($movie->runtime);?>
              <div class="runtime-bar">
                  <div class="">
                    <div class="" style="width: <?php echo $movie->runtime * 100 / $max_runtime; ?>%">

                    </div>
                  </div>
              </div>
          </div>
          <div class="stars">

            <form action="movie.php?movie_id=<?php echo $movie->id;?>" method="POST">

              <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
              <label class="star star-5" title="Awesome - 5 stars" for="star-5"></label>
              <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
              <label class="star star-4" title="Pretty good - 4 stars" for="star-4"></label>
              <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
              <label class="star star-3" title="Meh - 3 stars" for="star-3"></label>
              <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
              <label class="star star-2" title="Kinda bad - 2 stars" for="star-2"></label>
              <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
              <label class="star star-1" title="Sucks big time - 1 star" for="star-1"></label>
              <button style="vertical-align:middle" class="buttonSubmit" type="submit" formmethod="POST"><span>Submit </span></button>
            </form>
            <?php
            /*
              $star = $_POST['star'];
              $array = array($movie->id, $star);
              $encoded = json_encode($array);
              file_put_contents('movies_rating.txt', $encoded);
              */
            ?>
          </div>

        </div>
      </div>
    </ul>
