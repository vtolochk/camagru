<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camagru</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="screen" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/regular.css" integrity="sha384-zkhEzh7td0PG30vxQk1D9liRKeizzot4eqkJ8gB3/I+mZ1rjgQk+BSt2F6rT2c+I" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/brands.css" integrity="sha384-nT8r1Kzllf71iZl81CdFzObMsaLOhqBU1JD2+XoAALbdtWaXDOlWOZTR4v1ktjPE" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
    <link href="/views/css/index.css" rel="stylesheet">
</head>
<body>
   <?php include 'header.php';?>
    <div class="gallery-wrapper">
        <?php
            $i = 0;
            foreach ($allPhotos as $photo) {
                $date = explode('/', $photo['path']);
                $date = explode('_', $date[1]);
                $date = $date[0] . '-' . $date[1] . '-' . $date[2];
                echo "
                <div class='post-container'>
                    <img src='" . $photo['path'] . "' id='" . $photo['id'] . "'alt='user photo'></img>
                    <div class='post-bottom'>
                        <div class='author-and-date'>
                            <span class='post-text'>Author: </span><span class='post-data'> " . $owners[$i]['name']['login'] . "</span>
                            <span class='post-text'>Date: </span><span class='post-data'> " . $date . "</span>
                        </div>
                        <div class='likes-and-comments'>";
                            if ($allLikes[$i]['likes'] > 0 && isset($_SESSION['user_id']) && $_SESSION['user_id'] == $allLikes[$i]['owner']) { 
                                echo "<i class='fas fa-heart active-like' style='padding-right: 10px;'>";
                            } else {
                                echo "<i class='fas fa-heart style='padding-right: 10px;'>";
                            }
                             echo $allLikes[$i]['likes'] . "</i>
                            <i class='fas fa-comments'></i>";
                            if (isset($_SESSION['user_login'])) {
                                if ($_SESSION['user_login'] == $owners[$i]['name']['login']) {
                                    echo "<i class='fas fa-times-circle'></i>";
                                }
                            }
                        echo "</div>
                        <div class='comments-container'>
                            <div class='previous-comments'>";
                            foreach ($comments[$i] as $comment) {
                                echo "<span class='user-name'>" . $comment['commentOwner'] . ': </span>';
                                echo "<span class='user-text'>" . $comment['commentText'];
                                echo "</br>";
                            }
                            echo "</span>
                            </div>
                            <div class='input-and-button'>
                                <input id='comment-input' type='text'/>
                                <button class='add-comment-button'>Add comment</button>
                            </div>
                        </div>
                    </div>
                </div>";
                $i++; 
            }
        ?>
    </div>
    <?php include 'footer.php';?>
    <script src="/views/js/index.js"></script>
</body>
</html>