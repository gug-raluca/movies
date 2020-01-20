<?php
  include("header.php");
  include_once("functions.php");
  
?>
    <?php
    $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies; ?>


    <?php
            $max_runtime=longest($movies);
    ?>
    <div class="row"> 
    <ul>
     <?php  
           $all_actors;
           $big_count=0;
           if(isset($_GET['genre']) && $_GET['genre'] && $_GET['genre']!=""){
           ?> 
            <h1> Filme din genul: <?php echo $_GET['genre'];?> </h1>
            <?php function get_movie_genre($value){
               if( in_array($_GET['genre'], $value->genres)) return true;
           }
           $movies= array_filter($movies,'get_movie_genre');}

     ?>
    
    <?php foreach($movies as $movie)
    {?>
        
        <?php
       
        
        $year=$movie->year;
        $plot=$movie->plot;
        $poster_ad=$movie->posterUrl;
        ?>
        <li>

            <div class="column_l">
                 <div class="column1">
                     <?php if( checkRemoteFile($poster_ad)==true) { 
                      echo '<img src= "' . $poster_ad . '" alt="poster" />'; ?>
                     <?php }else{ ?>
                        <img src="http://www.theprintworks.com/wp-content/themes/psBella/assets/img/film-poster-placeholder.png" alt="placeholder" >
                            <?php } ?> 
                 </div>
                 <div class="column2" >
                      <h2> <?php echo $movie->title; ?> </h2> 
                        <p class="year">
                        <?php if($year >= 2010) 
                         { ?>
                            <strong> <?php echo '('.$year.')'; ?> </strong>
        
                            <?php }else{
						    echo '('.$year.')';
                         }?> 
                        </p>
                        <br/>
       
                         <?php if (strlen($plot)>100)
                         echo substr($plot,0,100)."...";
                         else echo $plot; ?>
                    
                         <br/>
        
                         <h3><?php echo "Genres: "; ?></h3>
                         <?php  $genres_nb=count($movie->genres);
                         $i=0;
                         for ($i=0; $i<$genres_nb-1;$i++)
                          {echo $movie->genres[$i].", ";}
                             echo $movie->genres[$genres_nb-1];
                          ?>
           
                        <h3>Actors:</h3>
                        <?php $actori=explode(",", $movie->actors);?>
                         <ol>
                         <?php for($i=0; $i<count($actori)-1; $i++){?>
                         <li> <?php echo $actori[$i]; 
                         $all_actors[]=$actori[$i];
                          } ?>
                         </li>
                        </ol>

                        <h3>Runtime:
                        <span class="notbold">
                         <?php 
                         echo runtime($movie->runtime);
                        ?> 
                        <div class="progress">
                             <span style="width: <?php echo $movie->runtime*100/$max_runtime;?>%"></span>
                        </div> 
                         </span>
                         </h3>  
                         <?php ?>
                         <form action="single.php" method="get">
                         <button type="submit" style="float: right" name="id" value="<?php echo $movie->id;?>">Mai multe detalii</button>
                         </form>
                 </div>
                 <?php unset($genres_filtered);?>
                 </div>
         <?php } ?>
                 
     
    </li>
    </ul>
    <?php
                  if(empty($all_actors)){ ?> <div class="nue"><h2> acest gen nu exista</h2></div>
                  <?php }else{?>
    <div class="column_r">
        <div class="stick">
                  <?php
                  $all_actors=array_unique($all_actors);
                  sort($all_actors);
                  echo "<ul>";
                  foreach($all_actors as $actor)
                          echo "<li>".$actor."</li>";
                  echo "</ul>";
                  }?>
          </div>                   
    </div>
    </div> 
<?php include("footer.php"); ?>  
    
   
