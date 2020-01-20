<?php
include('header.php'); 
include('functions.php');
$movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
   if (isset($_GET['searched']) && $_GET['searched'] && $_GET['searched']!="") {?>
         <h1>Rezultatele cautarii pentru: <?php echo $_GET['searched']?> </h1>
         <?php 
         function contains($value){
              if(strpos($value->title,$_GET['searched'])!==false) return true;
                                         }
          $movies=array_filter($movies,'contains');
          if(strlen($_GET["searched"])<3) echo "<h2>Folosiți cel puțin 3 caractere în câmpul de căutare<h2>";
         else foreach($movies as $movie)
             display_movie($movie);
           }
         if(empty($movies) && strlen($_GET["searched"])>3) echo "<h2>Nu s-a gasit nici un rezultat, incercati...</h2>";
          
include("footer.php")
?>  
