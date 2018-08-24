<?php

class EnrollmentController {
	public function actionIndex() {
		require_once(ROOT . '/views/enrollment.php');
		return true;
	}
	public function actionSignUp() {
		require_once(ROOT . '/views/makephoto.php');
		return true;
	}
}