 <?php
    include_once "./app/models/Film.class.php";
    // $curl = curl_init("https://api.themoviedb.org/3/movie/popular?api_key=3143998f7db739235e5db0025401606a&language=fr");

    // curl_setopt_array($curl,[
    //     CURLOPT_SSL_VERIFYPEER => false,
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_TIMEOUT => 1
    // ]);
    // $data = curl_exec($curl);
    // if($data === false){
    //     var_dump(curl_error($curl));
    // }else{
    //     $data = json_decode($data, true);
    
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
    <link rel="stylesheet" href="./public/assets/css/main.css">
    <!-- FONT-AWSOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="left">
            <img src="./public/assets/img/Logo.png" alt="Logo Addicine">
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
                $filmPop = new Film("https://api.themoviedb.org/3/movie/popular?api_key=3143998f7db739235e5db0025401606a&language=fr");
                $filmPop->setOption();
                $filmPop->getData();
                foreach($filmPop->data['results'] as $key => $film){
                    if($key === 0 ){
                        echo '<img src="https://image.tmdb.org/t/p/w500'.$film['backdrop_path'] .'" alt="'.$film['title'].'" class="slider active">';
                        echo '<p class="titleFilmPopulaire active">'. $film['title'].'</p>';
                    }else{
                        echo '<img src="https://image.tmdb.org/t/p/w500'.$film['backdrop_path'] .'" alt="'.$film['title'].'" class="slider ">';
                        echo '<p class="titleFilmPopulaire">'. $film['title'].'</p>';
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
    </main>

    <script src="./public/assets/js/app.js"></script>
</body>
</html>
<?php

    // }
    // curl_close($curl);
    ?>