<?php

include_once ROOT . '/models/User.php';

class EnrollmentController {

	public function actionIndex() {
		require_once(ROOT . '/views/enrollment.php');
		return true;
	}

	public function actionSignUp() {
		$errors = [];
		$login = $_POST['login'];
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$repass = $_POST['repassword'];

		array_push($errors, User::loginVerification($login));
		array_push($errors, User::emailVerification($email));
		array_push($errors, User::passwordVerification($pass, $repass));

		if (count(array_filter($errors)) > 0) {
			echo (json_encode($errors));
		} else {
			User::registerUser($_POST['login'], $_POST['email'], $_POST['password']);
			$user = User::getUserByLogin($_POST['login']);
			User::sendConfirmationEmail($user);
			echo (json_encode($errors));
		}
		return true;
	}

	public function actionSignIn() {
		$errors = User::checkLoginAndPassword($_POST['login'], $_POST['password']);
		User::startSession($errors);
		echo (json_encode($errors));
		return true;
	}

	public function actionConfirm() {
		require_once(ROOT . '/views/emailConfirmed.php');
		return true;
	}

}