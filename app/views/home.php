 <?php
     include '../includes/autoloader.inc.php';
    
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
            <img src="../../public/assets/img/Logo.png" alt="Logo Addicine">
        </div>
        <div class="center">
            <ul>
                <li>Film</li>
                <li>Séries</li>
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
        <article>"Movies can be an art<br>Let yourself be carried away"</article>
        <div class="carousel">
            <?php
                $filmPop = new FilmContr();
                foreach($filmPop->checkData() as $key => $film){
                    if($key === 0 ){
                        echo '<img src="https://image.tmdb.org/t/p/w500'.$film['backdrop_path'] .'" alt="'.$film['title'].'" class="slider active">';
                        echo '<h2 class="titleFilmPopulaire active">'. $film['title'].'</h2>';
                    }else{
                        echo '<img src="https://image.tmdb.org/t/p/w500'.$film['backdrop_path'] .'" alt="'.$film['title'].'" class="slider ">';
                        echo '<h2 class="titleFilmPopulaire">'. $film['title'].'</h2>';
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
                foreach($filmPop->checkData() as $key => $film){
                    echo '<figure>';
                        echo '<a href="#"><img src="https://image.tmdb.org/t/p/w500'.$film['poster_path'] .'" alt="'.$film['title'].'" class="posterPopularFilm">';
                        echo '<figcaption>'. $film['title'].'</figcaption></a>';
                    echo '</figure>';
                 }
                ?>    
                </div>
                
            </div>
            <div>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non laoreet erat, vitae vulputate massa. Pellentesque id lobortis nibh. Sed aliquet id ipsum vel volutpat. In semper et mauris non laoreet. Donec tristique, nibh ut molestie lobortis, massa lorem egestas sapien, vitae bibendum libero tellus vitae lectus. Morbi sed lobortis urna. Duis non eleifend nunc.

Cras vulputate, purus in ultricies rhoncus, metus elit scelerisque enim, vitae pulvinar turpis ligula ut orci. Donec metus tortor, elementum nec arcu id, euismod interdum nibh. Praesent dolor diam, imperdiet id tempus eu, faucibus eget eros. Cras a mauris nec lacus consequat feugiat a a ante. Nulla non libero ut mauris rutrum semper id a odio. Nulla vel ullamcorper lorem. Aliquam erat ligula, egestas ac luctus quis, posuere ac ipsum. Mauris eget ultricies quam, placerat viverra massa. Nullam sem elit, laoreet nec ornare ac, maximus at ante. Proin vitae dictum augue. Fusce dignissim, urna eu cursus viverra, nulla justo dictum odio, a euismod tellus quam quis urna. Quisque nec diam vel arcu pretium placerat. Nulla facilisi. Donec convallis ut diam sed rutrum.

Quisque eget lorem fermentum, bibendum urna sed, euismod elit. Quisque sem nunc, tristique quis convallis quis, tempus in urna. Sed libero lacus, dictum interdum rhoncus at, molestie a sem. Vivamus faucibus a enim eget volutpat. Nam aliquet eu sem eu vestibulum. In auctor imperdiet est non blandit. Nunc nec quam sit amet odio fermentum cursus. Duis interdum tempor risus malesuada ullamcorper. Nulla nisi velit, eleifend et auctor at, malesuada vel risus. Curabitur laoreet purus id erat pulvinar vulputate. Integer sit amet pretium tellus.

Ut venenatis dui sit amet mi euismod, vitae porttitor metus tempus. Cras a pulvinar dui. Integer congue felis arcu. Sed vel ipsum libero. Vestibulum in fringilla enim, in pellentesque erat. Proin euismod orci vitae nisl facilisis, eget finibus augue congue. Sed nec aliquam quam, in convallis lacus.

Maecenas eget erat in diam porttitor facilisis. Integer accumsan sapien sed ex finibus porta. Nullam facilisis interdum nisl vitae euismod. Maecenas sed nisi elit. Morbi vehicula, ante luctus ornare porttitor, lorem lectus imperdiet felis, et porttitor est justo id neque. Etiam efficitur mi augue, eget sagittis erat tempor eget. Nunc vel blandit nisi. Etiam a fermentum enim. Praesent efficitur quam sit amet sodales blandit. Fusce a magna non eros fringilla finibus. In scelerisque nunc dolor. Aliquam erat volutpat. Sed efficitur semper velit ut posuere.

Generated 5 paragraphs, 391 words, 2533 bytes of Lorem Ipsum
            </div>
    </main>

    <script src="../../public/assets/js/app.js"></script>
</body>
</html>
<?php
            $filmPop->close();
    
?>