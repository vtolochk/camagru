<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email confirmation</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
   <link href="/views/css/passwordRestoring.css" rel="stylesheet">
</head>
<body>
   <?php include 'header.php';?>
    <div class="wrapper">
        <div class="restore-wrapper">
				<form method="post" id="forgot-form-wrapper">
                    <div>We will send an instruction for restoring password.</div>
                    <div class="restore-header">Enter your email</div>
                    <div class="restore-input-wrapper">
                        <input type="email" name="email" id="restore-input" required>
                        <input class="sent-button" type="submit" value="Sent">
                    </div> 
                    <div class="sorry">If you forgot your email, We are so sorry ...</div>
                    <a class="home-a" href="/">Go home</a>
				</form>

		</div>
    </div>
    <?php include 'footer.php';?>
    <script src="/views/js/passwordRestoring.js"></script>
</body>
</html>