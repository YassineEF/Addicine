 <?php
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
             <a href="#"><img src="../../public/assets/img/Logo.png" alt="Logo Addicine"></a>
         </div>
         <div class="center">
             <ul>
                 <div class="dropdownMenu">
                     <li>Film</li>
                     <div class="dropdown-content">
                         <a href="./categoryFilm?category=latest">Latest</a>
                         <a href="./categoryFilm?category=top_rated">Top Rated</a>
                         <a href="./categoryFilm?category=popular">Popular</a>
                         <a href="./categoryFilm?category=upcoming">Upcoming</a>
                     </div>
                 </div>
                 <div class="dropdownMenu">
                     <li>Séries</li>
                     <div class="dropdown-content">
                         <a href="#">Latest</a>
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
     <main class="home">
         <article>"Movies can be an art<br>Let yourself be carried away"</article>
         <div class="carousel">
             <?php
                $filmPop = new FilmContr();
                foreach ($filmPop->checkData() as $key => $film) {
                    if ($key === 0) {
                        echo '<img src="https://image.tmdb.org/t/p/w500' . $film['backdrop_path'] . '" alt="' . $film['title'] . '" class="slider active">';
                        echo '<h2 class="titleFilmPopulaire active">' . $film['title'] . '</h2>';
                    } else {
                        echo '<img src="https://image.tmdb.org/t/p/w500' . $film['backdrop_path'] . '" alt="' . $film['title'] . '" class="slider ">';
                        echo '<h2 class="titleFilmPopulaire">' . $film['title'] . '</h2>';
                    }
                }
                ?>
             <div class="next">
                 <i class="fas fa-chevron-circle-right"></i>
             </div>
             <div class="previous">
                 <i class="fas fa-chevron-circle-left"></i>
             </div>
         </div>
         <div class="filmPopular">
             <h2>Popular Film</h2>
             <div class="sliderFilmPopulaire">
                 <?php
                    foreach ($filmPop->checkData() as $key => $film) {
                        echo '<figure>';
                        echo '<a href="./singleFilm?id=' . $film['id'] . '"><img src="https://image.tmdb.org/t/p/w500' . $film['poster_path'] . '" alt="' . $film['title'] . '" class="posterPopularFilm">';
                        echo '<figcaption>' . $film['title'] . '</figcaption></a>';
                        echo '</figure>';
                    }
                    ?>
             </div>

         </div>
         <div class="filmPopular">
             <h2>Popular Series</h2>
             <div class="sliderFilmPopulaire">
                 <?php
                    $SeriePop = new SerieContr();
                    foreach ($SeriePop->checkData() as $key => $serie) {
                        echo '<figure>';
                        echo '<a href="./SingleSerie?id=' . $serie['id'] . '"><img src="https://image.tmdb.org/t/p/w500' . $serie['poster_path'] . '" alt="' . $serie['name'] . '" class="posterPopularFilm">';
                        echo '<figcaption>' . $serie['name'] . '</figcaption></a>';
                        echo '</figure>';
                    }
                    ?>
             </div>

         </div>

     </main>

     <script src="../../public/assets/js/app.js"></script>
 </body>

 </html>
 <?php
    $filmPop->close();

    ?>