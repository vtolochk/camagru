<?php

include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Photos.php';
include_once ROOT . '/models/Likes.php';
include_once ROOT . '/models/Comments.php';

class IndexController {
	public function actionIndex() {
		$allPhotos = Photos::getAllPhotos();

		// get all likes from the base
		$allLikes = array();
		$owners = array();
		$commentsFromBase = array();

		// some stupid magic here
		$j = 0;
		foreach ($allPhotos as $photo) {
			$comment = Comments::getCommentsByPhotoId($photo['id']);
			$likes = Likes::getNumberOfLikesByPhotoId($photo['id']);
			if (isset($_SESSION['user_id'])) {
			 	$owner = Likes::getOwnerOfThePhoto($photo['id'], $_SESSION['user_id']);
			} else {
				$owner = Likes::getOwnerOfThePhoto($photo['id'], $photo['owner']);
			}
			array_push($commentsFromBase, $comment);
			array_push($owners, array('name' => User::getUserById($photo['owner'])));
			array_push($allLikes, array('owner' => $owner, 'likes' => $likes));
			$j++;
		}
		$comments = array();
		foreach ($commentsFromBase as $comment) {
			$postComments = array();
			foreach ($comment as $subcomment) {
				$commentOwner = User::getUserById($subcomment['owner'])['login'];
				$commentText = $subcomment['comment'];
				array_push($postComments, array('commentOwner' => $commentOwner, 'commentText' => $commentText));
			}
			array_push($comments, $postComments);
		}

		require_once(ROOT . '/views/index.php');
		return true;
	}

	public function actionIsUserLoggedIn() {
		if (isset($_SESSION['user_id'])) {
			echo 'success';
		} else {
			echo 'fail';
		}
		return true;
	}
}