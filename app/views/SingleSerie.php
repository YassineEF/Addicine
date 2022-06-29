<?php

//save the get from other page
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
//include all the classes
include '../includes/autoloader.inc.php';

//function to convert minutes in a format where we have hours and minute
// function convertToHoursMins($time)
// {
//     if ($time < 1) {
//         return;
//     }
//     $hours = floor($time / 60);
//     $minutes = ($time % 60);
//     return   $hours . " hours " . $minutes . " minutes";
// }
// function convertDate($dateAmerican)
// {
//     $timestamp = strtotime($dateAmerican);
//     $dateFrench = date("d-m-Y", $timestamp);
//     return $dateFrench;
// }
//Env variable
(new DotEnv(__DIR__ . '/.env'))->load();
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
    <main class="singleMovie">
        <?php
            $SingleSerie = new SingleSerieContr($id);
            $Single = $SingleSerie->checkData();
            var_dump($Single);
        ?>
        <div class="singleFilmUp">
            <h1 class="singleFilmTitle"><?= $Single['name']; ?></h1>
            <p class="singleFilmStatus">(<?= $Single['status']; ?>)
            <p>
        </div>
        <div class="singleFilmMid">

            <div class="singleFilmPosterResume">
                <div class="singleFilmLeft">
                    <?php
                    echo '<img src="https://image.tmdb.org/t/p/w500' . $Single['poster_path'] . '" alt="' . $Single['name'] . '" >';
                    ?>
                </div>
                <div class="singleFilmCenterDown">
                    <?php
                    // echo '<img src="https://image.tmdb.org/t/p/w780'.$Single['backdrop_path'] .'" alt="'.$Single['title'].'" class="singleFilmCenterDownImg">';
                    echo '<p class="singleFilmCenterDownParag" >' . $Single['overview'] . '</p>';
                    ?>
                </div>
            </div>
            <div class="info">
                <div class="singleFilmCenter">
                    <h2>Production Companies:</h2>
                    <?php
                    foreach ($Single['production_companies'] as  $production_companie) {
                        echo '<p>-' . $production_companie['name'] . '</p>';
                        if ($production_companie['logo_path'] == null) {
                            echo '<img src="../../public/assets/img/NoLogoCompany.png" alt="Logo ' . $production_companie['name'] . '" >';
                        } else {
                            echo '<img src="https://image.tmdb.org/t/p/w45' . $production_companie['logo_path'] . '" alt="Logo ' . $production_companie['name'] . '" >';
                        }
                    }
                    ?>
                    <h2>Created By:</h2>
                    <?php
                    foreach ($Single['created_by'] as  $creator) {
                        echo '<p>-' . $creator['name'] . '</p>';
                        // if ($production_companie['logo_path'] == null) {
                        //     echo '<img src="../../public/assets/img/NoLogoCompany.png" alt="Logo ' . $production_companie['name'] . '" >';
                        // } else {
                        //     echo '<img src="https://image.tmdb.org/t/p/w45' . $production_companie['logo_path'] . '" alt="Logo ' . $production_companie['name'] . '" >';
                        // }
                    }
                    ?>
                </div>
                <div class="singleFilmRight">
                    <?php
                    echo "<p class='miniTitle'>Duration:</p>";
                    if ($Single['runtime'] == 0) {
                        echo '<p>&nbsp&nbsp&nbsp&nbspDuration not available</p>';
                    } else {
                        echo '<p>&nbsp&nbsp&nbsp&nbsp' . convertToHoursMins($Single['runtime']) . '</p>';
                    }
                    echo "<p class='miniTitle'>Release Date:</p>";
                    echo "<p>&nbsp&nbsp&nbsp&nbsp" . convertDate($Single['release_date']) . "</p>";
                    echo "<p class='miniTitle'>Vote Average:</p>";
                    echo "<p>&nbsp&nbsp&nbsp&nbsp" . $Single['vote_average'] . "/10</p>";
                    echo "<p class='miniTitle'>Budget:</p>";
                    $Budget = number_format($Single['budget'], 0, ',', ' ') . "$";
                    echo "<p>&nbsp&nbsp&nbsp&nbsp" . ($Single['budget'] == 0 ?  "Budget not available" : $Budget) . "</p>";
                    echo "<p class='miniTitle'>Revenue:</p>";
                    $Revenue = number_format($Single['revenue'], 0, ',', ' ') . "$";
                    echo "<p>&nbsp&nbsp&nbsp&nbsp" . ($Single['revenue'] === 0 ?  "Revenue not available" : $Revenue) . "</p>";

                    ?>
                </div>
                <div class='Trailer'>
                    <?php
                    echo  '<iframe width="520" height="345"  src=" https://www.youtube.com/embed/' . $video[0]['key'] . '"></iframe>';
                    ?>
                </div>
            </div>
            <div class="singleFilmDown">
                <h3 class='FilmActorTitle'>Actor</h3>
                <div class="actorsSingleFilm">
                <?php
                        // var_dump($actors);
                    foreach($actors as $actor){
                        echo '<article class = " singleFilmActor"> ';
                        if($actor['profile_path'] == null){
                            echo '<img src="../../public/assets/img/ProfilePicNA.png" alt="Actor: ' . $actor['name'] . '" >';
                        }else{
                            echo '<img src="https://image.tmdb.org/t/p/w185' . $actor['profile_path'] . '" alt="Actor: ' . $actor['name'] . '" >';
                        }
                        echo '<h4><span class="namePlaceholder">Name</span>:  '.$actor['name'].'</h4>';    
                        echo '<h4><span class="namePlaceholder">Character</span>:  '.$actor['character'].'</h4>';    
                        echo '</article>';
                    }
                    ?>
                    </div>
            </div>

        </div>
    </main>
</body>

</html>
<?php
$SingleSerie->close();
?>