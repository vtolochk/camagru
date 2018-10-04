<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <link href="/views/css/gallery.css" rel="stylesheet">
</head>
<body>
   <?php include 'header.php';?>
    <div class="gallery-wrapper">
        <?php
            foreach ($allPhotos as $photo) {
                $date = explode('/', $photo['path']);
                $date = explode('_', $date[1]);
                $date = $date[0] . '-' . $date[1] . '-' . $date[2];
                echo "
                <div class='post-container'>
                    <img src='" . $photo['path'] . "' alt='user photo'></img>
                    <div class='post-bottom'>
                        <div class='author-and-date'>
                            <span class='post-text'>Author: </span><span class='post-data'> " . $photo['owner'] . "</span>
                            <span class='post-text'>Date: </span><span class='post-data'> " . $date . "</span>
                        </div>
                        <div class='likes-and-comments'>
                            <i class='far fa-circle fa-heart fa-2x'></i>
                            <i class='far fa-circle fa-comments fa-2x'></i>
                        </div>
                    </div>
                </div>";
            }
        ?>
    </div>
    <?php include 'footer.php';?>
    <script src="/views/js/gallery.js"></script>
</body>
</html>