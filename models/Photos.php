<?php 

class Photos
{
	public static function addNewPhoto($path, $owner) {
        $db = Database::getConnection();
        $sql = 'INSERT INTO `photos` (path, owner) VALUES (:path, :owner)';
        $base = $db->prepare($sql);
        $base->bindParam(':path', $path, PDO::PARAM_STR);
        $base->bindParam(':owner', $owner, PDO::PARAM_STR);
        $base->execute();
        return true;
    }
    
    public static function getAllPhotos() {
        $db = Database::getConnection();
        $stmt = $db->query('SELECT * FROM photos');
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}