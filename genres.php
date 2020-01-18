<?php require_once('header.php');?>
<div class="row genres">
  <?php
    foreach ($genres as $genre) {?>
      <a href="archive.php?genre=<?php echo $genre; ?>" class="genre" style="background-color:#9688<?php echo rand(10, 50) ;?>">
        <?php echo $genre; ?>
      </a>
  <?php } ?>
</div>
<?php require_once('footer.php');?>
