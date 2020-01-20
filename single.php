<?php
  include("header.php");
  include("functions.php");
   //include("archive-movie.php");
?>


<?php if( empty($_GET) || $_GET["id"]<0 || $_GET["id"]>146 ) {
	echo "Aceasta pagina nu exista. Inapoi spre" ?> <a href="archive.php"><b>arhiva</b></a>
<?php  } else {
?>
 <?php
    $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies; ?>
<?php 
$poster_ad=$movies[$_GET["id"]-1]->posterUrl;
$cookie_name="longest-movie-length";
if(isset($_COOKIE[$cookie_name])) {$max_runtime=$_COOKIE[$cookie_name];}
else{
        $max_runtime=longest($movies);
        $cookie_name="longest-movie-length";
        $cookie_value=$max_runtime;
        setcookie($cookie_name, $cookie_value);
    }

display_movie($movies[$_GET['id']-1] );?>
    <?php  } 
    echo "<br>";
 include("footer.php");?>
