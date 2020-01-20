<?php 
function checkRemoteFile($url)
            {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                // don't download content
                curl_setopt($ch, CURLOPT_NOBODY, 1);
                curl_setopt($ch, CURLOPT_FAILONERROR, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            
                $result = curl_exec($ch);
                curl_close($ch);
                if($result !== FALSE)
                {
                    return true;
                }
                else
                {
                    return false;
                }
          }
     ?>
<?php 
function runtime($runtime){
                         $h=intval($runtime/60);
                         if ($h==1) $return_value= $h." hour "; else $return_value= $h." hours ";
                         $min=$runtime%60;
                         if($min==1) $return_value=$return_value."and ".$min.' min';
                         else $return_value=$return_value."and ".$min.' mins';
                         return $return_value;
}
?>
<?php

function longest($movies){
     $cookie_name="longest-movie-length";
     if(isset($_COOKIE[$cookie_name])) {$max_runtime=$_COOKIE[$cookie_name];
                                        return $max_runtime;
                                       }
     else{       
          $movies_runtime=array_column($movies,"runtime");
          $max_runtime=max($movies_runtime);
          $cookie_name="longest-movie-length";
          $cookie_value=$max_runtime;
          setcookie($cookie_name, $cookie_value);
          return $max_runtime;
          }
}
?>
<?php
function movies_count(){
     $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
     echo count($movies);
}
?>
<?php
function genres_count(){
     $genres = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->genres;
     echo count($genres);
}
?>
<?php
function display_movie($moviep){ 
        ?> 
<?php
    $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies; ?>
<?php 
$poster_ad=$moviep->posterUrl;
$max_runtime=longest($movies);
?>
<div class="row">
<div class="column1">

<?php if( checkRemoteFile($poster_ad)==true) { 
                      echo '<img src= "' . $poster_ad . '" alt="poster" />'; ?>
                     <?php }else{ ?>
                        <img src="http://www.theprintworks.com/wp-content/themes/psBella/assets/img/film-poster-placeholder.png" alt="placeholder">
                            <?php } ?> 
</div>
<div class="column2" >
                      <h2> <?php 
                        echo $moviep->title; ?> </h2> 
                        <p class="year">
                        <?php $year=$moviep->year;
                         if($year >= 2010) 
                         { ?>
                            <strong> <?php echo '('.$year.')'; ?> </strong>
        
                            <?php }else{
						    echo '('.$year.')';
                         }?> 
                        </p>
                        <br/>
       
                         <?php  echo $moviep->plot; ?>
                    
                         <br/>
        
                         <h3><?php echo "Genres: "; ?></h3>
                         <?php  $genres_nb=count($moviep->genres);
                         $i=0;
                         for ($i=0; $i<$genres_nb-1;$i++)
                          {echo $moviep->genres[$i].", ";}
                             echo $moviep->genres[$genres_nb-1];
                          ?>

                        <h3>Actors:</h3>
                        <?php $actori=explode(",", $moviep->actors);?>
                         <ol>
                         <?php for($i=0; $i<count($actori); $i++){?>
                         <li> <?php echo $actori[$i]; 
                          } ?>
                         </li>
                        </ol>

                        <?php if($moviep->director !='N/A') {?>
                        <h3>Director:</h3>
                        <?php echo $moviep->director;}?>
           
                        <h3>Runtime:
                        <span class="notbold">
                         <?php 
                         echo runtime($moviep->runtime);
                        ?> 
                        <div class="progress">
                             <span style="width: <?php echo $moviep->runtime*100/$max_runtime;?>%"></span>
                        </div> 
                         </span>
                        </h3>
                       

</div>
    <?php }  ?>
<?php
function ten_oldest(){
     $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
     foreach($movies as $movie)
          $movie_old[$movie->id]=$movie->year;
     asort($movie_old);
     $i=0;
     echo "<h2> Cele mai vechi filme: </h2>";
     echo "<ul>";
      foreach($movie_old as $key => $value) {
           if ($i<10) { echo "<li>";?>
                        <a href="single.php?id=<?php echo $movies[$key-1]->id;?> " name="id";>
                        <?php echo $movies[$key-1]->title." (". $movies[$key-1]->year. ")";?> </a>
                        <?php $i++;
                        echo "</li>";
                      }
           else break;
       }
      echo "</ul>";     
}
function ten_newest(){
     $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
     foreach($movies as $movie)
          $movie_old[$movie->id]=$movie->year;
     arsort($movie_old);
    $i=0;
    echo "<h2> Cele mai noi filme: </h2>";
    echo "<ul>";
     foreach($movie_old as $key => $value) {
          if ($i<10) { echo "<li>";?>
                       <a href="single.php?id=<?php echo $movies[$key-1]->id;?> " name="id";>
                       <?php echo $movies[$key-1]->title." (". $movies[$key-1]->year. ")";?> </a>
                       <?php $i++;
                        echo "</li>";
                     }
          else break;
      }
     echo "</ul>";     
}
?>
