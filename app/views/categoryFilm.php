<?php
//save the get from other page
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}
if (!isset($_GET['page'])) {

    $page = 1;
    $pagePrevious = 1;
} else {
    $page = $_GET['page'];
    $pagePrevious = $_GET['page'];
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
                    <li>Séries</li>
                    <div class="dropdown-content">
                        <a href="#">Top Rated</a>
                        <a href="#">Latest</a>
                        <a href="#">Latest</a>
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
        <h2 class="FilmCategoryTitle"><?= $category == 'top_rated' ? 'top rated' : $category ?></h2>
        <div class="FilmCategory">
            <?php
            $filmCategory = new CategoryFilmContr($category, $page);
            $allFilmCat = $filmCategory->checkData();
            foreach ($allFilmCat as $oneFilmCat) {
                echo '<figure>';
                echo '<a href="./singleFilm?id=' . $oneFilmCat['id'] . '"><img src="https://image.tmdb.org/t/p/w342' . $oneFilmCat['poster_path'] . '"alt="' . $oneFilmCat['title'] . '" class="">';
                echo '<figcaption>' . $oneFilmCat['title'] . '</figcaption></a>';
                echo '</figure>';
            }
            ?>
        </div>

        <div class="buttonsPages">
            <?php
            if ($pagePrevious <= 1) {
                echo '<a href="#">This is the first page</a>';
            } else {
                $pagePrevious -=  1;
                echo '<a href="./categoryFilm?category=' . $category . '&page=' . $pagePrevious . '">Previous</a>';
            }
            if ($page == 500) {
                echo '<a href="#">This is the last page</a>';
            } else {
                $page +=  1;
                echo '<a href="./categoryFilm?category=' . $category . '&page=' . $page . '">Next</a>';
            }

            ?>
        </div>
    </main>

    <script src="../../public/assets/js/app.js"></script>
</body>

</html>
<?php
$filmCategory->close();

?>