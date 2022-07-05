<?php

//include all the classes
include '../includes/autoloader.inc.php';
//save the get from other page
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

//Env variable
(new DotEnv(__DIR__ . '/.env'))->load();
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

$SingleSerie = new SingleSerieContr($id);
$Single = $SingleSerie->checkData();
if (sizeof($Single) <= 3) {
    header("Location: ./Error.php", true, 301);
} else {


    $video = $SingleSerie->getVideos();
    $actors = $SingleSerie->getActor();
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
            <div class="headerUp">

                <div class="left">
                    <a href="./home.php"><img src="../../public/assets/img/Logo.png" alt="Logo Addicine"></a>
                </div>
                <form action="./find.php" method="get" class="searchBar" id="searchForm">
                    <input type="text" class="search" name="keyWord" id="keyWord" required>
                    <i class="fa fa-search" id="searchLogo"></i>
                </form>
                <ul class="menu-nav">
                    <div class="dropdownMenu">
                        <li>Movie</li>
                        <div class="dropdown-content">
                            <a href="./categoryFilm?category=top_rated">Top Rated</a>
                            <a href="./categoryFilm?category=popular">Popular</a>
                            <a href="./categoryFilm?category=upcoming">Upcoming</a>
                        </div>
                    </div>
                    <div class="dropdownMenu">
                        <li>Tv series</li>
                        <div class="dropdown-content">
                            <a href="./categoryTv?category=top_rated">Top Rated</a>
                            <a href="./categoryTv?category=popular">Popular</a>
                            <a href="./categoryTv?category=on_the_air">On the air</a>
                        </div>
                    </div>

                </ul>
                <div class="menu-btn">
                    <span class="menu-btn_burger"></span>
                </div>
            </div>
            <div class="headerDown">
                <div class="listGenre">
                    <h4>Movie Genres</h4>
                    <div class="listGenre-content">
                        <?php
                        $filmPop = new FilmContr();
                        $movieGenres = $filmPop->getGenres();
                        foreach ($movieGenres as $movieGenre) {
                            echo ' <a href="./genreMovie?id=' . $movieGenre['id'] . '">' . $movieGenre['name'] . '</a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="listGenre">
                    <h4>Tv series Genres</h4>
                    <div class="listGenre-content">
                        <?php
                        $tvGenres = $filmPop->getGenresTv();
                        foreach ($tvGenres as $tvGenre) {
                            echo ' <a href="./genreSeries?id=' . $tvGenre['id'] . '">' . $tvGenre['name'] . '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </header>
        <main class="singleMovie">
            <?php


            ?>
            <div class="singleFilmUp">
                <h1 class="singleFilmTitle"><?= $Single['name']; ?></h1>
                <p class="singleFilmStatus">(<?= $Single['status']; ?>)</p>
            </div>
            <div class="singleFilmMid">

                <div class="singleFilmPosterResume">
                    <div class="singleFilmLeft">
                        <?php
                        if ($Single['poster_path'] == null) {
                            echo '<img src="../../public/assets/img/ProfilePicNA.png" alt="' . $Single['name'] . '" >';
                        } else {

                            echo '<img src="https://image.tmdb.org/t/p/w500' . $Single['poster_path'] . '" alt="' . $Single['name'] . '" >';
                        }
                        ?>
                    </div>
                    <div class="singleFilmCenterDown">
                        <?php
                        if ($Single['overview'] == "") {
                            echo '<p class="singleFilmCenterDownParag" >Resume not available</p>';
                        } else {
                            echo '<p class="singleFilmCenterDownParag" >' . $Single['overview'] . '</p>';
                        }
                        // echo '<img src="https://image.tmdb.org/t/p/w780'.$Single['backdrop_path'] .'" alt="'.$Single['title'].'" class="singleFilmCenterDownImg">';
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
                        }
                        ?>
                        <h2>Networks:</h2>
                        <?php
                        foreach ($Single['networks'] as  $network) {
                            echo '<p>-' . $network['name'] . '</p>';
                            if ($network['logo_path'] == null) {
                                echo '<img src="../../public/assets/img/NoLogoCompany.png" alt="Logo ' . $network['name'] . '" >';
                            } else {
                                echo '<img src="https://image.tmdb.org/t/p/w45' . $network['logo_path'] . '" alt="Logo ' . $network['name'] . '" >';
                            }
                        }
                        ?>
                    </div>
                    <div class="singleFilmRight">
                        <?php
                        echo "<p class='miniTitle'>average episode Duration:</p>";
                        foreach ($Single['episode_run_time'] as $avgTime) {
                            if ($avgTime == 0) {
                                echo '<p>&nbsp&nbsp&nbsp&nbspDuration not available</p>';
                            } else {
                                echo '<p>&nbsp&nbsp&nbsp&nbsp' . convertToHoursMins($avgTime) . '</p>';
                            }
                        }
                        echo "<p class='miniTitle'>First Release Date:</p>";
                        echo "<p>&nbsp&nbsp&nbsp&nbsp" . convertDate($Single['first_air_date']) . "</p>";
                        echo "<p class='miniTitle'>Vote Average:</p>";
                        echo "<p>&nbsp&nbsp&nbsp&nbsp" . $Single['vote_average'] . "/10</p>";
                        echo "<p class='miniTitle'>Total season:</p>";
                        echo "<p>&nbsp&nbsp&nbsp&nbsp" . $Single['number_of_seasons'] . "</p>";
                        echo "<p class='miniTitle'>Total episodes:</p>";
                        echo "<p>&nbsp&nbsp&nbsp&nbsp" . $Single['number_of_episodes'] . "</p>";

                        ?>
                    </div>
                    <div class='Trailer'>
                        <?php
                        // var_dump($video);
                        if (sizeof($video) == 0) {
                            echo '<p class="NotAvailable">Video not available</p>';
                        } else {
                            echo  '<iframe width="520" height="345"  src=" https://www.youtube.com/embed/' . $video[0]['key'] . '"></iframe>';
                        }
                        ?>
                    </div>
                </div>
                <div class="singleFilmDown">
                    <h3 class='FilmActorTitle'>Cast</h3>
                    <div class="actorsSingleFilm">
                        <?php
                        if (sizeof($actors) == 0) {
                            echo '<h4>Actors not available</h4>';
                        } else {
                            foreach ($actors as $actor) {
                                echo '<article class = "singleFilmActor"> ';
                                if ($actor['profile_path'] == null) {
                                    echo '<a href="./singleActor?id=' . $actor['id'] . '"><img src="../../public/assets/img/ProfilePicNA.png" alt="Actor: ' . $actor['name'] . '" >';
                                } else {
                                    echo '<a href="./singleActor?id=' . $actor['id'] . '"><img src="https://image.tmdb.org/t/p/w185' . $actor['profile_path'] . '" alt="Actor: ' . $actor['name'] . '" >';
                                }
                                echo '<h4><span class="namePlaceholder">Name</span>:  ' . $actor['name'] . '</h4>';
                                echo '<h4><span class="namePlaceholder">Character</span>:  ' . $actor['character'] . '</h4></a>';
                                echo '</article>';
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
            <script src="../../public/assets/js/app.js"></script>
        </main>
    </body>

    </html>
<?php
    $SingleSerie->close();
}
?>