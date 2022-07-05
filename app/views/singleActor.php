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
                if($singleActor['profile_path'] == null){
                    echo '<img src="../../public/assets/img/ProfilePicNA.png" alt="' . $singleActor['name'] . '" >';
                }else{
                    echo '<img src="https://image.tmdb.org/t/p/w185' . $singleActor['profile_path'] . '" alt="' . $singleActor['name'] . '" >';
                }
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
                        // var_dump($movie['id']);
                        if (!array_key_exists('release_date', $movie)) {
                            echo "<p><a href='./singleFilm?id=" . $movie['id'] . "'>Release date not available:  " . $movie['title'] . "  (" . $movie['character'] . ")</a></p>";
                        } else {
                            if ($movie['release_date'] == '') {
                                echo "<p><a href='./singleFilm?id=" . $movie['id'] . "'>Release date not available:  " . $movie['title'] . "  (" . $movie['character'] . ")</a></p>";
                            } else {
                                echo "<p><a href='./singleFilm?id=" . $movie['id'] . "'>" . convertDate($movie['release_date']) . ":  " . $movie['title'] . "  (" . $movie['character'] . ")</a></p>";
                            }
                        }
                    }
                }
                ?>
            </div>
            <div class="singleActorMovie">
                <h3>Tv Series</h3>
                <?php
                foreach ($moviesActor as $movie) {
                    if ($movie['media_type'] == 'tv') {
                        if ($movie['first_air_date'] == " ") {
                            echo "<p><a href='./singleSerie?id=" . $movie['id'] . "'>First air date not available:  " . $movie['name'] . " (" . $movie['character'] . ")</a></p>";
                        } else {
                            echo "<p><a href='./singleSerie?id=" . $movie['id'] . "'>" . convertDate($movie['first_air_date']) . ":  " . $movie['name'] . " (" . $movie['character'] . ")</a></p>";
                        }
                    }
                }


                ?>
            </div>

        </div>
        <script src="../../public/assets/js/app.js"></script>
    </main>

    
</body>

</html>
<?php
$actor->close();
?>