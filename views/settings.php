<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
     <link href="/views/css/settings.css" rel="stylesheet">
</head>
<body> 
   <?php 
    if (isset($_SESSION['user_id'])) {
        include 'header.php';
   ?>
    <div class="settings-wrapper">
        <form method="post" id='settings-form'>
            <div class="header center">Settings</div>
            <div class="center">
            <div class="inputs-wrapper">
                <div class="grid-wrapper">
                    <p>Your login:</p>
                    <input class="input-field" type="text" name="login"  value=<?php echo $user['login'];?> required>
                </div>
                <div class="grid-wrapper">
                    <p>Your email:</p>   
                    <input class="input-field" type="text" name="email" value=<?php echo $user['email'];?> required>
                </div>
                <div  class="grid-wrapper">
                    <p>Old password:</p>
                    <input id='old_pass' class="input-field" type="password" name="old_password">
                </div>
                <div  class="grid-wrapper">
                    <p>New password:</p>
                    <input id='new_pass' class="input-field" type="password" name="new_password">
                </div>
                <div  class="grid-wrapper">
                    <p>Notifications</p>
                      <div class="center">
                        <input id="on" type="radio" value="1" name='notisfications'  
                        <?php if ($user['notisfications']) {
                            echo 'checked';
                        }
                        ?>>
                        <p>On</p>
                        <input id="off" type="radio" name='notisfications' value="0"
                        <?php if (!$user['notisfications']) {
                            echo 'checked';
                        }
                        ?>
                        ><p>Off</p>
                      </div>
                </div>
                <div class="center">
                    <input class="button" type="submit" value="Save">
                </div>
                <div class='errorDiv'></div>
            </div>
            </div>
        </form>
       
    </div>
    <?php  } else {
        include '404.php';
    } 
    include 'footer.php';?>
    <script src="/views/js/settings.js"></script>
</body>
</html>