<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
     <link href="/views/css/settings.css" rel="stylesheet">
</head>
<body> 
   <?php include 'header.php'; // to hide this page of not logged in user need to check sessing is set or not?>
    <div class="settings-wrapper">
        <form method="post">
            <div class="header">Settings</div>
            <div class="inputs-wrapper">
                <div class="grid-wrapper">
                    <p>Your login:</p>
                    <input type="text" name="login">
                    <input class="button" type="submit" value="Change">
                </div>
                <div class="grid-wrapper">
                    <p>Your email:</p>   
                    <input type="text" name="login">
                    <input class="button" type="submit" value="Change">
                </div>
                <div  class="grid-wrapper">
                    <p>Old password:</p>
                    <input type="text" name="login">
                </div>
                <div  class="grid-wrapper">
                    <p>New password:</p>
                    <input type="text" name="login">
                    <input class="button" type="submit" value="Change">
                </div>
                <div  class="grid-wrapper">
                    <p>Notifications </p>
                </div>
            </div>
        </form>
    </div>
    <?php include 'footer.php';?>
</body>
</html>