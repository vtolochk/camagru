<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
     <link href="/views/css/restoringPasswordForm.css" rel="stylesheet">
</head>
<body> 
   <?php include 'header.php';?>
    <div class="restoring-wrapper">
        <form method="post" id='restoring-password-form'>
            <div class="header">Enter new password</div>
            <div class="wrp">
                    <div class="input-name">New password</div>
					<input type="password" name="password" id="pass-input" required >
					<div class="input-name">Retype new password</div>
					<input type="password" name="repassword" id="re-pass-input" required>
                    <input class="button" type="submit" value="Save">
                <div class='errorDiv'></div>
            </div>
        </form>
    </div>
    <?php include 'footer.php';?>
    <script src='/views/js/passwordRestoringForm.js'></script>
</body>
</html>