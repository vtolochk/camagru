<?php

include_once ROOT . '/models/User.php';

class UserController {
    public function actionLogout () {
        User::endSession();
        header('Location: /');
        return true;
    }

    public function actionConfirm() {
        $user = User::getUserByLogin($_GET['login']);
        if ($user['token'] === $_GET['token']) {
            User::confirmEmail($user);
            Header("Location: /enrollment/confirm");
        } // maybe need to show error here ???
    }

    public function actionRestorePassword() {
        $user = User::getUserByEmail($_GET['email']);
        if ($user['token'] === $_GET['token']) {
            Header("Location: /"); // settings change password in future
        } // same question as above
    }

    public function actionForgotRequest() {
        $error = [];
        array_push($error, User::sendRestorePasswordEmail($_POST['email']));
        echo json_encode($error);
        return true;
    }

    public function actionRestore() {
        require_once(ROOT . '/views/passwordRestoring.php');
    }

    public function actionSettings () {
        if (isset($_SESSION['user_id'])) {
            $user = User::getUserByLogin($_SESSION['user_login']);
            require_once(ROOT . '/views/settings.php');
        } else {
            return false;
        }
    }

    public function actionSaveSettings () {
        if (isset($_SESSION['user_id'])) {
            $errors = [];
            $user = User::getUserByLogin($_SESSION['user_login']);

            if ($user['login'] !== $_POST['login']) {
                array_push($errors, User::loginVerification($_POST['login']));
                if (count(array_filter($errors)) > 0) {
                    echo (json_encode($errors));
                    return true;
                } else {
                    User::setLogin($user['id'], $_POST['login']);
                    $_SESSION['user_login'] = $_POST['login'];
                }
            }

            if ($user['email'] !== $_POST['email']) {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email isn't valid.");
                    echo (json_encode($errors));
                    return true;
                } else {
                    User::setEmail($user['id'], $_POST['email']);
                }
            }
            if ($_POST['new_password'] !== '') {
                if ($_POST['new_password'] !== $user['password']) {
                    array_push($errors, 'Password invalid.');
                }
                array_push($errors, User::passwordVerification($_POST['new_password'], $_POST['new_password']));
                if (count(array_filter($errors)) > 0) {
                    echo (json_encode($errors));
                    return true;
                } else {
                    User::setPassword($user['id'], $_POST['new_password']);
                }
            }

            if ($user['notisfications'] != $_POST['notisfications']) {
                User::setNotisfications($user['id'], $_POST['notisfications']);
            }
            echo (json_encode($errors));
            return true;
        } else {
            return false;
        }
    }
}