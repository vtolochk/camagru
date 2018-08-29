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

		if (count($errors) > 0) {
			echo (json_encode($errors));
		} else {
			$status = User::registerUser($_POST['login'], $_POST['email'], $_POST['password']);
			if ($status === '') {
				echo 'Registration successful, check your email'.'<br/>';
			} else {
				echo $status . '<br/>';
			}
			echo 'All users' . '<br/><br/>';
			$users = User::getAllUsers();
			for ($i = 0; $i < count($users); $i++) {
				echo 'ID: ' . $users[$i]['id'] . '<br/>';
				echo 'LOGIN: ' . $users[$i]['login'] . '<br/>';
				echo 'EMAIL: ' . $users[$i]['email'] . '<br/>';
				echo 'PASSWORD: ' . $users[$i]['password'] . '<br/>';
				echo 'CONFIRM: ' . $users[$i]['confirm'] . '<br/><br/>';
			}
		}
		return true;
	}
	public function actionSignIn() {
		echo ('login: ' . $_POST['login'] . '<br/>');
		echo ('pass: ' . $_POST['password'] . '<br/>');
		return true;
	}
}