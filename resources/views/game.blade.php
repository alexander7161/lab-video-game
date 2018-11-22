<?php ?>
<!DOCTYPE HTML>
<html lang = "en">
    <head>
    <meta charset = "utf-8">
    <meta name="Game details",content="the details of specific game">
        <title>Game Details</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <!-- CSS -->
    <link href="stylesheet/description.css" rel="stylesheet">
    </head>
    <body>
        <main class = "container">
            <!-- Left Column / Game Image -->
            <div class="left-column">
                <img data-image="artworks" src="../Game_Artworks/.jpg" alt="">
            </div>
            <!-- Right Column -->
            <div class="right-column">
                <!-- Game descritions -->
                <div class="game-descriptions">
                    <h1>Game Name</h1>
                    <p>short description</p>
                    <p><h3><b>Release:</b> year</h3></p>
                    <p><h3><b>Type:</b> type</h3></p>
                    <p><h3><b>Platform:</b> platform</h3></p>
                    <p><h2>Rating: 5</h2><a href="https://www.videogame.com"></a></p>
                </div>
                <!-- State&Booking --> 
                <div class="rent-game">
                    <span>State: availability</span>
                    <a href="#" class="cart-btn">Book it</a>
                </div>
            </div>
        </main>   
        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
        <script src="script.js" charset="utf-8"></script>
    </body>
</html>
