<?php

namespace Models;
class Image extends \Config\Dbh {

	protected function getImage($id){

		$sql = "SELECT * FROM images WHERE id=?;";
		$stmt = $this->connect()->prepare($sql);
		if(!$stmt->execute([$id])){
			$stmt = null;
			header("Location: ../notFound.php");
			exit();
		}
		$result = $stmt->fetch();
		return $result;
	}
}