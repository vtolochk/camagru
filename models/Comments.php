<?php

class Comments 
{
    public static function addComment ($comment, $photoId, $owner) {
        $db = Database::getConnection();
        $photoId = intval($photoId);
        $owner = intval($owner);
        $sql = 'INSERT INTO `comments` (comment, photoId, owner) VALUES (:comment, :photoId, :owner)';
        $base = $db->prepare($sql);
        $base->bindParam(':comment', $comment, PDO::PARAM_STR);
        $base->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $base->bindParam(':owner', $owner, PDO::PARAM_INT);
        $base->execute();
        return true;
    }

    public static function getCommentsByPhotoId($photoId) {
        $db = Database::getConnection();
        $sql = 'SELECT * FROM `comments` WHERE photoId = :photoId';
        $base = $db->prepare($sql);
        $base->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $base->setFetchMode(PDO::FETCH_ASSOC);
        $base->execute();
        $data = $base->fetchAll();
        return $data;
    }  
}