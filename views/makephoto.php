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
        <div id='video-container'>
            <video id='video'>Stream not available</video>
            <button id='photo-but'>Take photo</button>
            <select id='filters'>
                <option value="none">Normal</option>
                <option value="grayscale(100%)">Grayscale</option>
                <option value="sepia(100%)">Sepia</option>
                <option value="invert(100%)">Invert</option>
                <option value="hue-rotate(90deg)">Hue</option>
                <option value="blur(10px)">Blur</option>
                <option value="contrast(200%)">Contrast</option>
            </select>
            <button id='clear-but'>Clear</button>
            <canvas id='canvas'></canvas>
        </div>
        <div class='bottom-container'>
            <div id='photos'></div>
        </div>
    </div>
    <script src="/views/js/makephoto.js"></script>
</body>
</html>