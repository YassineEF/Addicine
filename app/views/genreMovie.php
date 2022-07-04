<?php
include '../includes/autoloader.inc.php';

//Env variable
(new DotEnv(__DIR__ . '/.env'))->load();
//save the get from other page
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // $genre = $_GET['genre'];
    // var_dump($id, $genre);
}

if (!isset($_GET['page'])) {
    
    $page = 1;
    $pagePrevious = 1;
} else {
    $page = $_GET['page'];
    $pagePrevious = $_GET['page'];
}

$genreMovie = new genreMovieContr($id, $page);
$allFilmGenre = $genreMovie->checkData();
$listGenre = $genreMovie->getGenres();
if(sizeof($allFilmGenre) <= 3 || !is_numeric($id)){
    header("Location: ./Error.php");
}else{


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
                        echo ' <a href="./genreSeries?id=' . $tvGenre['id'] .'">' . $tvGenre['name'] . '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>
    <div class="line"> </div>
    <main>
        <h2 class="FilmCategoryTitle"><?php
            foreach($listGenre as $genreActual){
                if($genreActual['id'] == $id){
                    echo $genreActual['name'];
                }
            }
        ?></h2>
        <div class="FilmCategory">
            <?php
            
            foreach ($allFilmGenre as $filmParGenre) {
                // var_dump($oneTvCat);
                echo '<figure>';
                if($filmParGenre['poster_path']  == null){
                    echo '<a href="./singleFilm?id=' . $filmParGenre['id'] . '"><img src="../../public/assets/img/ProfilePicNA.png"alt="' . $filmParGenre['title'] . '" class="">';
                }else{
                    echo '<a href="./singleFilm?id=' . $filmParGenre['id'] . '"><img src="https://image.tmdb.org/t/p/w342' . $filmParGenre['poster_path'] . '"alt="' . $filmParGenre['title'] . '" class="">';
                }
                echo '<figcaption>' . $filmParGenre['title'] . '</figcaption></a>';
                echo '</figure>';
            }
            ?>
        </div>
        <div class="buttonsPages">
            <?php
            if ($pagePrevious <= 1) {
                echo '<a href="#">No previous pages</a>';
            } else {
                $pagePrevious -=  1;
                echo '<a href="./genreMovie?id='.$id.'&page=' . $pagePrevious . '" > <i class="fas fa-chevron-circle-left"></i> Previous</a>';
            }
            if ($page == 500) {
                echo '<a href="#" >No more pages</a>';
            } else {
                $page +=  1;
                echo '<a href="./genreMovie?id='.$id.'&page=' . $page . '" >Next <i class="fas fa-chevron-circle-right"></i></a>';
            }
            // if($category == 'upcoming'){
            //     if ($page == 20) {
            //         echo '<a href="#" >No more pages</a>';
            //     } else {
            //         $page +=  1;
            //         echo '<a href="./genreMovie?id=' . $movieGenre['id'] . '&genre=' . $movieGenre['name'] . '"&page=' . $page . '" >Next <i class="fas fa-chevron-circle-right"></i></a>';
            //     }
            // }else{
            
            // }


            ?>
        </div>
    </main>

    <script src="../../public/assets/js/app.js"></script>
</body>

</html>
<?php
$genreMovie->close();
}
?>