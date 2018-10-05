<?php

include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Photos.php';
include_once ROOT . '/models/Likes.php';
include_once ROOT . '/models/Comments.php';

class GalleryController 
{

	public function actionIndex() {

		// get all images from data base
		$allPhotos = Photos::getAllPhotos();

		// get all likes from the base
		$allLikes = array();
		$owners = array();
		$comments = array();

		// some stupid magic here
		$j = 0;
		foreach ($allPhotos as $photo) {
			$comment = Comments::getCommentsByPhotoId($photo['id']);
			$likes = Likes::getNumberOfLikesByPhotoId($photo['id']);
			$owner = Likes::getOwnerOfThePhoto($photo['id'], $_SESSION['user_id']);

			array_push($comments, $comment);
			array_push($owners, array('name' => User::getUserById($photo['owner'])));
			array_push($allLikes, array('owner' => $owner, 'likes' => $likes));
			$j++;
		}


		echo "<pre>";
		var_dump($comments);
		echo "</pre>";
		die(); // work here


		require_once(ROOT . '/views/gallery.php');
		return true;
	}

	public function actionAddLike() {
		if ($_SESSION['user_login']) {

			// get info for inserting to data base
			$id = $_SESSION['user_id'];
			$photoId = $_POST['photoId'];

			// add like to the data base
			Likes::addLike($photoId, $id);
		} else {
			// return that user cannot like photo until he log in
		}
		return true;
	}

	public function actionRemoveLike() {
		if ($_SESSION['user_login']) {

			// get info for inserting to data base
			$id = $_SESSION['user_id'];
			$photoId = $_POST['photoId'];

			// add like to the data base
			Likes::removeLike($photoId, $id);
		} else {
			// return that user cannot like photo until he log in
		}
		return true;
	}

	public function actionAddComment() {
		if ($_SESSION['user_login']) {

			// get info for inserting to the data base
			$owner = $_SESSION['user_id'];
			$comment = $_POST['comment'];
			$photoId = $_POST['photoId'];

			// add comment to the data base
			Comments::addComment($comment, $photoId, $owner);

			// send notisfication if they set
			
		} else {
			// return that user cannot like photo until he log in
		}
		return true;
	}
}