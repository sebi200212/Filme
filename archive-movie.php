<ul style="list-style-type: none;">
  <li class="li_movie">

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
            <img src=<?php echo $logo; ?> height: 450px;  width: 300px; style="border-radius: 9px;"/>
        </div>
        <div class = "container">
            <h2> <?php echo $movie->title; ?></h2>

            <?php
              if ($movie->year >= 2010 )
                echo  "<strong>".$movie->year."</strong>";
              else
                echo $movie->year;
             ?>

            <div class = "plot">
              <?php
              if(strlen($movie->plot) > 100){
                echo substr($movie->plot,0,100)."...";
              } else {
                echo $movie->plot;
              }
              echo "<br/><br>";
              ?>

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
                  <br/>
                <?php
                  }
                ?>
              </ol>
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

              <a href="movie.php?movie_id=<?php echo $movie->id; ?>" class="single">
                <button class="button button1">More details</button>
              </a>
              <br>
              <br>
        </div>
     </div>

  </li>
</ul>
