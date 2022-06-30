<?php

//save the get from other page
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
//include all the classes
include '../includes/autoloader.inc.php';

//function to convert minutes in a format where we have hours and minute
function convertToHoursMins($time)
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return   $hours . " hours " . $minutes . " minutes";
}
function convertDate($dateAmerican)
{
    $timestamp = strtotime($dateAmerican);
    $dateFrench = date("d-m-Y", $timestamp);
    return $dateFrench;
}
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
    <main class="singleActor">
        <?php
        $actor = new SingleActorContr($id);
        $singleActor = $actor->checkData();
        $moviesActor = $actor->getMovies();
        ?>
        <div class="singleActorUp">
            <h1 class="singleActorTitle"><?= $singleActor['name']; ?></h1>
        </div>
        <div class="singleActorCenter">
            <div class="singleActorPhoto">
                <?php
                echo '<img src="https://image.tmdb.org/t/p/w185' . $singleActor['profile_path'] . '" alt="' . $singleActor['name'] . '" >';
                ?>
            </div>
            <div class="singleActorinfo">
                <?php
                echo '<p  class="miniTitle">biography:</p>';
                if ($singleActor['biography'] == '') {

                    echo '<p class="NotAvailable">Biography not available</p>';
                } else {
                    echo '<p>' . $singleActor['biography'] . '</p>';
                }
                echo '<p class="miniTitle">Birthday:</p>';
                echo '<p>' . convertDate($singleActor['birthday']) . '</p>';
                echo '<p class="miniTitle" >Deathday:</p>';
                if ($singleActor['deathday'] == null) {
                    echo '<p>Still alive</p>';
                } else {
                    echo '<p>' . convertDate($singleActor['deathday']) . '</p>';
                }
                echo '<p  class="miniTitle">Place of birth:</p>';
                echo '<p>' . $singleActor['place_of_birth'] . '</p>';
                


                ?>
            </div>
        </div>
        <div class="singleActorDown">
            <div class="singleActorMovie">
                <h3>Movie</h3>
                <?php
                foreach ($moviesActor as $movie) {
                    if ($movie['media_type'] == 'movie') {
                        if ($movie['release_date'] == '') {
                            echo "<p><a href='./singleFilm?id=".$movie['id']."'>Release date not available:  " . $movie['title'] . "  (" . $movie['character'] . ")</a></p>";
                        } else {
                            echo "<p><a href='./singleFilm?id=".$movie['id']."'>" . convertDate($movie['release_date']) . ":  " . $movie['title'] . "  (" . $movie['character'] . ")</a></p>";
                        }
                    }
                }
                ?>
            </div>
            <div class="singleActorMovie">
                <h3>Series</h3>
                <?php
                foreach ($moviesActor as $movie) {
                    if ($movie['media_type'] == 'tv') {
                        if ($movie['first_air_date'] == " ") {
                            echo "<p><a href='./singleSerie?id=".$movie['id']."'>First air date not available:  " . $movie['name'] . " (" . $movie['character'] . ")</a></p>";
                        } else {
                            echo "<p><a href='./singleSerie?id=".$movie['id']."'>" . convertDate($movie['first_air_date']) . ":  " . $movie['name'] . " (" . $movie['character'] . ")</a></p>";
                        }
                    }
                }


                ?>
            </div>

        </div>

    </main>
</body>

</html>
<?php
$actor->close();
?>