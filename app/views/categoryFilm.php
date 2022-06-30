<?php
//save the get from other page
if (isset($_GET['category'])) {
    $category = $_GET['category'];
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
            <a href="#"><img src="../../public/assets/img/Logo.png" alt="Logo Addicine"></a>
        </div>
        <div class="center">
            <ul>
                <div class="dropdownMenu">
                    <li>Film</li>
                    <div class="dropdown-content">
                        <a href="#">Latest</a>
                        <a href="#">Top Rated</a>
                        <a href="#">Latest</a>
                        <a href="#">Latest</a>
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
       
    </main>

    <script src="../../public/assets/js/app.js"></script>
</body>

</html>
<?php


?>