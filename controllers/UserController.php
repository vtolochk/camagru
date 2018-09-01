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
        require_once(ROOT . '/views/settings.php');
    }
}