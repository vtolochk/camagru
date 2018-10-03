<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make photo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <link href="/views/css/makephoto.css" rel="stylesheet">
</head>
<body>
   <?php include 'header.php';?>
    <div class="makephoto-wrapper">
        
        <form action='#' method='POST' onsubmit='return false;'>
            <div id='video-container'>
                <video id='video'>Stream not available</video>
                <div id='kaka'><img src="" alt=""></div>
                <div class="photo-menu">
                    <button id='photo-but'>Take photo</button>
                    <div class='filters-wrapper'>
                    <select id='filters'>
                        <option value="none">Normal</option>
                        <option value="grayscale(100%)">Grayscale</option>
                        <option value="sepia(100%)">Sepia</option>
                        <option value="invert(100%)">Invert</option>
                        <option value="contrast(200%)">Contrast</option>
                    </select>
                    </div>
                    <button id='clear-but'>Clear</button>
                </div>
                <canvas id='canvas'></canvas>
            </div>
        </form>
        <div class="stickers-wrapper"> 
            <img class='sticker-img' src="/stickers/glasses.png" alt="glass sticker">
            <img class='sticker-img' src="/stickers/samuel.png" alt="samuel sticker">
            <img class='sticker-img' src="/stickers/glasses.png" alt="glass sticker">
            <img class='sticker-img' src="/stickers/samuel.png" alt="samuel sticker">
        </div>
    </div>
    <div class='bottom-container'>
        <div id='photos'></div>
    </div>
    <?php include 'footer.php';?>
    <script src="/views/js/makephoto.js"></script>
</body>
</html>