<?php

class User {

    public static function loginVerification ($login) {
        $error = '';
        $len = strlen($login);
        if ($len < 4) {
            $error = 'Login too short (min 4 symbols).';
        } else if ($len > 14) {
            $error = 'Login too long (max 14 symbols).';
        } else if (!preg_match('/^[A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/', $login)) {
            $error = 'Login contains forbidden symbols.';
        } else if (User::getUserByLogin($login)) {
            $error = "Login has already engaged.";
        }
        return $error;
    }

    public static function passwordVerification ($password, $repassword) {
        $error = '';
        $passLen = strlen($password);
        $repassLen = strlen($repassword);
        if (strcmp($password, $repassword)) {
            $error = 'Passwords does not match.';
        } else if ($passLen < 8 || $passLen != $repassLen) {
            $error = 'Password too short (Min 8 symbols).';
        } else if (!preg_match("/^(?=.*[A-Z])(?=.*\d)([0-9a-zA-Z]+)$/", $password)) {
            $error = 'Password too simple (should contain at least one uppercase and lowercase letter and a number).';
        }
        return $error;
    }

    public static function emailVerification ($email) {
        $error = '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email isn't valid.";
        } else if (User::getUserByEmail($email)) {
           $error = "Email has already registered.";
        }
        return $error;
    }

    public static function registerUser($login, $email, $password) {
        $db = Database::getConnection();
        $sql = 'INSERT INTO `users` (login, email, password, token) VALUES (:login, :email, :password, :token)';
        $base = $db->prepare($sql);

        $token = md5(rand(0, 1000));
        $password = password_hash($password, PASSWORD_DEFAULT);

        $base->bindParam(':login', $login, PDO::PARAM_STR);
        $base->bindParam(':email', $email, PDO::PARAM_STR);
        $base->bindParam(':password', $password, PDO::PARAM_STR);
        $base->bindParam(':token', $token, PDO::PARAM_STR);
        $base->execute();
        return true;
    }

    public static function sendConfirmationEmail($user) {
        $encoding  = "utf-8";
        $emailSubject = "Photo Creator email verification ";
        $subjectPreferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );
        $message = '
        <html>
            <head>
            </head>
            <body>
                <div style="text-align: center;font-family: \'Lato\', \'appleLogo\', sans-serif">
                    <h1>Hey '.$user['login'].', thanks for signing up!</h1>
                    <p>Your account has been created, to active it follow the url below.</p>
                    <a href="http://localhost:8010/confirm?login='. $user['login'] . "&token=" . $user['token'] .'">Confirmation link</a>
                </div>
            </body>
        </html>
        ';
        $emailHeader = "Content-type: text/html; charset=".$encoding." \r\n";
        $emailHeader .= "From: Photo Creator <no-reply@photoCreator.com> \r\n";
        $emailHeader .= "MIME-Version: 1.0 \r\n";
        $emailHeader .= "Content-Transfer-Encoding: 8bit \r\n";
        $emailHeader .= "Date: ".date("r (T)")." \r\n";
        $emailHeader .= iconv_mime_encode("Subject", $emailSubject, $subjectPreferences);
        return mail($user['email'], $emailSubject, $message, $emailHeader);
    }

    public static function confirmEmail($user) {
        $confirm = true;
        $login = $user['login'];
        $db = Database::getConnection();
        $sql = "UPDATE `users` SET confirm = :confirm WHERE login = :login";
        $base = $db->prepare($sql);
        $base->bindParam(":confirm", $confirm, PDO::PARAM_BOOL);
        $base->bindParam(":login", $login, PDO::PARAM_STR);
        return $base->execute();
    }

    public static function startSession($user) {
        if (isset($user['id']) && isset($user['login'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_login'] = $user['login'];
        }
    }

    public static function endSession() {
        unset($_SESSION['user_id']);
		unset($_SESSION['user_login']);
    }

    public static function checkLoginAndPassword($login, $password) {
        $errors = [];
        $db = Database::getConnection();
        $request = 'SELECT * FROM `users` WHERE login = :login';
        $result = $db->prepare($request);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $data = $result->fetch();
        if (!$data) {
            array_push( $errors, 'Invalid login');
        }
        else if (!password_verify($password, $data['password'])) {
            array_push( $errors, 'Invalid password');
        } else if (!$data['confirm']) {
            array_push( $errors, 'You need to confirm your email.');
        }
        if (count(array_filter($errors)) > 0) {
            return $errors;
        }
        return $data;
    }

    public static function getUserById($id) {
        $db = Database::getConnection();
        $request = 'SELECT * FROM `users` WHERE id = :id';
        $result = $db->prepare($request);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $data = $result->fetch();
        return $data;
    }

    public static function getUserByLogin($login) {
        $db = Database::getConnection();
        $request = 'SELECT * FROM `users` WHERE login = :login';
        $result = $db->prepare($request);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $data = $result->fetch();
        return $data;
    }

    public static function getUserByEmail($email) {
        $db = Database::getConnection();
        $request = 'SELECT * FROM `users` WHERE email = :email';
        $result = $db->prepare($request);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $data = $result->fetch();
        return $data;
    }

    public static function sendRestorePasswordEmail($email) {
        $error = '';
        $user = User::getUserByEmail($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email isn't valid.";
        } else if (!$user['confirm']) {
           $error = "Email hasnt registered yet.";
        } else {
            //generate new token
            $token = md5(rand(0, 1000));

            // write token to data base
            $confirm = true;
            $login = $user['login'];
            $db = Database::getConnection();
            $sql = "UPDATE `users` SET token = :token WHERE email = :email";
            $base = $db->prepare($sql);
            $base->bindParam(":token", $token, PDO::PARAM_BOOL);
            $base->bindParam(":email", $email, PDO::PARAM_STR);
            $base->execute();

            // sent email
            $encoding  = "utf-8";
            $emailSubject = "Photo Creator restore password";
            $subjectPreferences = array(
                "input-charset" => $encoding,
                "output-charset" => $encoding,
                "line-length" => 76,
                "line-break-chars" => "\r\n"
            );
            $message = '
            <html>
                <head>
                </head>
                <body>
                    <div style="text-align: center;font-family: \'Lato\', \'appleLogo\', sans-serif">
                        <h1>Hey '.$user['login'].', we recieved you forgot password request!</h1>
                        <p>To get a new password go via link below.</p>
                        <a href="http://localhost:8010/restore/request/password?email='. $user['email'] . "&token=" . $token .'">Get new password</a>
                    </div>
                </body>
            </html>
            ';
            $emailHeader = "Content-type: text/html; charset=".$encoding." \r\n";
            $emailHeader .= "From: Photo Creator <no-reply@photoCreator.com> \r\n";
            $emailHeader .= "MIME-Version: 1.0 \r\n";
            $emailHeader .= "Content-Transfer-Encoding: 8bit \r\n";
            $emailHeader .= "Date: ".date("r (T)")." \r\n";
            $emailHeader .= iconv_mime_encode("Subject", $emailSubject, $subjectPreferences);
            mail($user['email'], $emailSubject, $message, $emailHeader);
        }
        return $error;
    }

    public static function sendNotisficationEmail($email, $user) {
        $encoding  = "utf-8";
        $emailSubject = "Photo Creator notisfication";
        $subjectPreferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );
        $message = '
        <html>
            <head>
            </head>
            <body>
                <div style="text-align: center;font-family: \'Lato\', \'appleLogo\', sans-serif">
                    <h1>Hey ' . $user . ', you have a new comment below your photo!</h1>
                </div>
            </body>
        </html>
        ';
        $emailHeader = "Content-type: text/html; charset=".$encoding." \r\n";
        $emailHeader .= "From: Photo Creator <no-reply@photoCreator.com> \r\n";
        $emailHeader .= "MIME-Version: 1.0 \r\n";
        $emailHeader .= "Content-Transfer-Encoding: 8bit \r\n";
        $emailHeader .= "Date: ".date("r (T)")." \r\n";
        $emailHeader .= iconv_mime_encode("Subject", $emailSubject, $subjectPreferences);
        mail($email, $emailSubject, $message, $emailHeader);
    }

    public static function setLogin($id, $login) {
        $db = Database::getConnection();
        $sql = "UPDATE `users` SET login = :login WHERE id = :id";
        $base = $db->prepare($sql);
        $base->bindParam(":id", $id, PDO::PARAM_BOOL);
        $base->bindParam(":login", $login, PDO::PARAM_STR);
        $base->execute();
    }

    public static function setEmail($id, $email) {
        $db = Database::getConnection();
        $sql = "UPDATE `users` SET email = :email WHERE id = :id";
        $base = $db->prepare($sql);
        $base->bindParam(":id", $id, PDO::PARAM_BOOL);
        $base->bindParam(":email", $email, PDO::PARAM_STR);
        $base->execute();
    }

    public static function setPassword($id, $password) {
        $db = Database::getConnection();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET password = :password WHERE id = :id";
        $base = $db->prepare($sql);
        $base->bindParam(":id", $id, PDO::PARAM_BOOL);
        $base->bindParam(":password", $password, PDO::PARAM_STR);
        $base->execute();
    }

    public static function setNotisfications($id, $notif) {
        $db = Database::getConnection();
        $sql = "UPDATE `users` SET notisfications = :notif WHERE id = :id";
        $base = $db->prepare($sql);
        $base->bindParam(":id", $id, PDO::PARAM_BOOL);
        $base->bindParam(":notif", $notif, PDO::PARAM_STR);
        $base->execute();
    }

    public static function setToken($id) {
        $token = md5(rand(0, 1000));
        $db = Database::getConnection();
        $sql = "UPDATE `users` SET token = :token WHERE id = :id";
        $base = $db->prepare($sql);
        $base->bindParam(":id", $id, PDO::PARAM_BOOL);
        $base->bindParam(":token", $token, PDO::PARAM_STR);
        $base->execute();
    }

}