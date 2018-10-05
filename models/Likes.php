<?php

class Likes 
{
    public static function addLike ($photoId, $owner) {
        $db = Database::getConnection();
        $sql = 'INSERT INTO `likes` (photoId, owner) VALUES (:photoId, :owner)';
        $base = $db->prepare($sql);
        $base->bindParam(':photoId', $photoId, PDO::PARAM_STR);
        $base->bindParam(':owner', $owner, PDO::PARAM_INT);
        $base->execute();
        return true;
    }

    public static function removeLike ($photoId, $owner) {
        $db = Database::getConnection();
        $sql = 'DELETE FROM `likes` WHERE photoId = :photoId AND owner = :owner';
        $base = $db->prepare($sql);
        $base->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $base->bindParam(':owner', $owner, PDO::PARAM_INT);
        $base->execute();
        return true;
    }

    public static function getOwnerOfThePhoto($photoId, $owner) {
        $db = Database::getConnection();
        $sql = 'SELECT * FROM `likes` WHERE photoId = :photoId AND owner = :owner';
        $base = $db->prepare($sql);
        $base->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $base->bindParam(':owner', $owner, PDO::PARAM_INT);
        $base->setFetchMode(PDO::FETCH_ASSOC);
        $base->execute();
        $data = $base->fetch();
        return $data['owner'];
    }

    public static function getNumberOfLikesByPhotoId ($photoId) {
        $db = Database::getConnection();
        $sql = 'SELECT * FROM `likes` WHERE photoId = :photoId';
        $base = $db->prepare($sql);
        $base->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $base->setFetchMode(PDO::FETCH_ASSOC);
        $base->execute();
        $data = $base->fetchAll();      
        return count($data);
    }   
}