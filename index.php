<?php
include("header.php");
include("functions.php");
?>
 
 <p style="margin-left: 7%; font-size: 1.5rem;"> Vă punem la dispoziție o bază de <?php movies_count();?> filme împărțite în <?php genres_count();?> de genuri. </p>
 <div class="row">
        <div class="column_old"><?php ten_oldest()?></div>
        <div class="column_new"><?php ten_newest()?></div>
 </div>
 <?php include("footer.php")?>
