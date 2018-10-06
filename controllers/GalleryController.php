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
		$commentsFromBase = array();

		// some stupid magic here
		$j = 0;
		foreach ($allPhotos as $photo) {
			$comment = Comments::getCommentsByPhotoId($photo['id']);
			$likes = Likes::getNumberOfLikesByPhotoId($photo['id']);
			$owner = Likes::getOwnerOfThePhoto($photo['id'], $_SESSION['user_id']);
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

			// need to validate input by regexp or try maybe it shouldnt 

			// get info for inserting to the data base
			$owner = $_SESSION['user_id'];
			$comment = $_POST['comment'];
			$photoId = $_POST['photoId'];

			// add comment to the data base
			Comments::addComment($comment, $photoId, $owner);

			// send notisfication if they set
			echo json_encode(array('comment' => $comment, 'owner' => $_SESSION['user_login']));
		} else {
			echo json_encode(array('fail'));
			// return that user cannot like photo until he log in
		}
		return true;
	}

	public function actionRemoveComment () {
		if ($_SESSION['user_login']) {

			$photoId = $_POST['id'];

			// remove likes
			Likes::removeAllLikesByPhotoId($photoId);

			// remove comments
			Comments::removeAllCommentsByPhotoId($photoId);

			// remove photo from the disk
			$photoPath = Photos::getPhotoInfo($photoId)['path'];
			unlink($photoPath);

			// remove photo from the data base
			Photos::removePhotoByPhotoId($photoId);
			
			return true;
		}
		// else return false??
	}
}