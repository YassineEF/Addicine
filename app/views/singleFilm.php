<?php

    //save the get from other page
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    //include all the classes
    include '../includes/autoloader.inc.php';
    
    //function to convert minutes in a format where we have hours and minute
    function convertToHoursMins($time) {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return   $hours. " hours ".$minutes." minutes";
    }
    function convertDate($dateAmerican){
        $timestamp = strtotime($dateAmerican);
        $dateFrench = date("d-m-Y", $timestamp);
        return $dateFrench;
    }
    //Env variable
    (new DotEnv(__DIR__.'/.env'))->load();
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- META -->
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TITLE -->
    <title>Addicine</title>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../../public/assets/css/main.css">
    <!-- FONT-AWSOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
    <header>
    <div class="left">
           <a href="./home.php"><img src="../../public/assets/img/Logo.png" alt="Logo Addicine"></a> 
        </div>
        <div class="center">
            <ul>
                <li>Film</li>
                <li>Séries</li>
                <li>Genres</li>
            </ul>
        </div>
    </header>
    <main>
        <?php
            $SingleFilm = new SingleFilmContr($id);
            $Single = $SingleFilm->checkData();
            $video = $SingleFilm->getVideos();
        ?>
    <div class="singleFilmUp">
        <h1 class="title"><?= $Single['title']; ?></h1>
        <p><?= $Single['status']; ?><p>
    </div>
        <div class="singleFilmCenter">
            <div class="singleFilmLeft">
                <?php
                    echo '<img src="https://image.tmdb.org/t/p/w500'.$Single['poster_path'] .'" alt="'.$Single['title'].'" >';
                ?>
            </div>
            <div class="singleFilmCenter">
                <h2>Production Companies:</h2>
                <?php 
                    foreach($Single['production_companies'] as  $production_companie){
                        echo '<img src="https://image.tmdb.org/t/p/w45'.$production_companie['logo_path'] .'" alt="Logo '.$production_companie['name'].'" >';
                        echo '<p>'.$production_companie['name'].'</p>';
                    }
                ?>
            </div>
            <div class="singleFilmRight">
                <div class="info">
                    <?php 
                        if($Single['runtime'] == 0){
                            echo '<p>Duration not available</p>';
                        }else{
                            echo '<p>'.convertToHoursMins($Single['runtime']).'</p>';

                        }
                        echo "<p>".convertDate($Single['release_date'])."</p>";
                        echo "<p>".$Single['vote_average']."/10</p>";
                        echo "<p>Budget: ".number_format($Single['budget'],3, ',', ' ')."$</p>";
                        echo "<p>Revenue: ".number_format($Single['revenue'],3, ',', ' ')."$</p>";
                        
                    ?>  
                </div>
            </div>
        </div>
    </main>
</body>
</html>
<?php
    $SingleFilm->close(); 
?>