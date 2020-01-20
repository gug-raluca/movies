<?php
  include("header.php");

?>
<?php
 $genres = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->genres; ?>
 <div class="row genres">
    <?php foreach($genres as $genre) { ?>
      
       <a href="archive.php?genre=<?php echo $genre; ?>"  method="get" class="genre" style="background-color: #<?php echo rand(10,99)?>dadb">
       <?php  echo $genre;
       ?> </a>
       
 <?php } ?>
 </div>
<?php require_once('footer.php');
?>