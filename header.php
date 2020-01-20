<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Movies HW</title>
<link rel="stylesheet" href="style_movies.css">
<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
<div class="row search" >       
        <div class="column_new">
                <img class="logo" src="images/imdb.jpg" alt="imdb">
        </div>
        <div class="column_r_new">
                <form action="searchresults.php" method="get"> 
                <input type="text" name="searched"  /> 
                <button type="submit" >search</button>
                </form>      
        </div>
</div> 
<div class="menu" style="padding: 30px; ">
        <div> <a href="index.php"> Home</a></div>
        <div> <a href="archive.php"> Movies</a></div>
        <div><a href="genres.php">Genres</a></div>
        <div>Contact</div>
</div>
</head>
<body>