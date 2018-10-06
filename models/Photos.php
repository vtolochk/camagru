<?php 

class Photos
{
	public static function addNewPhoto($path, $owner) {
        $db = Database::getConnection();
        $sql = 'INSERT INTO `photos` (path, owner) VALUES (:path, :owner)';
        $base = $db->prepare($sql);
        $base->bindParam(':path', $path, PDO::PARAM_STR);
        $base->bindParam(':owner', $owner, PDO::PARAM_INT);
        $base->execute();
        return true;
    }

    public static function removePhotoByPhotoId ($photoId) {
        $db = Database::getConnection();
        $sql = 'DELETE FROM `photos` WHERE id = :photoId';
        $base = $db->prepare($sql);
        $base->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $base->execute();
        return true;
    }

    public static function getPhotoInfo($photoId) {
        $db = Database::getConnection();
        $sql = 'SELECT * FROM `photos` WHERE id = :photoId';
        $base = $db->prepare($sql);
        $base->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $base->setFetchMode(PDO::FETCH_ASSOC);
        $base->execute();
        $data = $base->fetch();
        return $data;
    }

    public static function getAllPhotos() {
        $db = Database::getConnection();
        $stmt = $db->query('SELECT * FROM photos');
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}