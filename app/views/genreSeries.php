<?php
//save the get from other page
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $genre = $_GET['genre'];
}
include '../includes/autoloader.inc.php';

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
            <a href="./home"><img src="../../public/assets/img/Logo.png" alt="Logo Addicine"></a>
        </div>
        <div class="center">
            <ul>
                <div class="dropdownMenu">
                    <li>Film</li>
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
                <li>Genres</li>
            </ul>
        </div>
        <div class="right">
            <form action="find.php" method="get" class="searchBar">
                <input type="text" class="search" required>
                <i class="fa fa-search"></i>
            </form>
        </div>
    </header>
    <div class="line"> </div>
    <main>
        <h2 class="FilmCategoryTitle"><?= $genre ?></h2>
        <div class="FilmCategory">
            <?php
            $genreSerie = new genreSerieContr($id);
            $allSerieGenre = $genreSerie->checkData();
            foreach ($allSerieGenre as $serieParGenre) {
                // var_dump($oneTvCat);
                echo '<figure>';
                echo '<a href="./singleSerie?id=' . $serieParGenre['id'] . '"><img src="https://image.tmdb.org/t/p/w342' . $serieParGenre['poster_path'] . '"alt="' . $serieParGenre['name'] . '" class="">';
                echo '<figcaption>' . $serieParGenre['name'] . '</figcaption></a>';
                echo '</figure>';
            }
            ?>
        </div>

    </main>

    <script src="../../public/assets/js/app.js"></script>
</body>

</html>
<?php
$genreSerie->close();

?>