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
             <!-- <label for="check" class="bar">
                 <span class="fa fa-bars" id="bars"></span>
                 <span class="fa fa-times" id="times"></span>
             </label> -->
             <!-- <div class="menu-btn">
                 <span class="menu-btn_burger"></span>
             </div> -->
             <!-- <nav class="navbar">
                 <div class="center">
                     <ul class="menu-nav">
                         <div class="dropdownMenu">
                             <li>Movie</li>
                             <div class="dropdown-content">
                                 <a href="./categoryFilm?category=top_ratedwith dropdown menu
                             ">Top Rated</a>
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
                 </div>

                 <div class="right">
                     <form action="./find.php" method="get" class="searchBar" id="searchForm">
                         <input type="text" class="search" name="keyWord" id="keyWord" required>
                         <i class="fa fa-search" id="searchLogo"></i>
                     </form>
                 </div>
             </nav> -->
         </div>
         <div class="headerDown">
             <div class="listGenre">
                 <h4>Movie Genres</h4>
                 <div class="listGenre-content">
                     <?php
                        $filmPop = new FilmContr();
                        $movieGenres = $filmPop->getGenres();
                        foreach ($movieGenres as $movieGenre) {
                            echo ' <a href="./genreMovie?id=' . $movieGenre['id'] . '&genre=' . $movieGenre['name'] . '">' . $movieGenre['name'] . '</a>';
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
                            echo ' <a href="./genreSeries?id=' . $tvGenre['id'] . '&genre=' . $tvGenre['name'] . '">' . $tvGenre['name'] . '</a>';
                        }
                        ?>
                 </div>
             </div>
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