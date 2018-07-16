<?php

class EnrollmentController {
	public function actionIndex() {
		require_once(ROOT . '/views/enrollment.php');
		return true;
	}
}