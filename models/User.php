<?php

class User {

    public static function loginVerification ($login) {
        $error = '';
        $len = strlen($login);
        if ($len < 4) {
            $error = 'Login too short (min 4 symbols).';
        } else if ($len > 24) {
            $error = 'Login too long (max 24 symbols).';
        } else if (!preg_match('/^[A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/', $login)) {
            $error = 'Login contains forbidden symbols.';
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
        }
        return $error;
    }

    public static function registerUser($login, $email, $password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $db = Database::getConnection();
        $sql = 'INSERT INTO `users` (login, email, password) VALUES (:login, :email, :password)';
        $base = $db->prepare($sql);
        $base->bindParam(':login', $login, PDO::PARAM_STR);
        $base->bindParam(':email', $email, PDO::PARAM_STR);
        $base->bindParam(':password', $password, PDO::PARAM_STR);
        $base->execute();
        return true;
    }

    public static function startSession($user) {
        echo $user['login']. "\n";
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_login'] = $user['login'];
        var_dump($_SESSION);
    }

    public static function endSession($user) {
        unset($_SESSION['user_id']);
		unset($_SESSION['user_login']);
    }

    public static function checkLoginAndPassword($login, $password) {
        $db = Database::getConnection();
        $request = 'SELECT * FROM `users` WHERE login = :login';
        $result = $db->prepare($request);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $data = $result->fetch();
        if (!$data) {
            $data = 'Invalid login';
        }
        else if (!password_verify($password, $data['password'])) {
            $data = 'Invalid password';
        } else if (!$data['confirm']) {
            $data = 'You need to confirm your email.';
        }
        return $data;
    }

    // public static function getAllUsers() {
    //     $db = Database::getConnection();
    //     $stmt = $db->query('SELECT * FROM users');
	// 	$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $res;
    // }
}