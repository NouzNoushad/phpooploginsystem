<?php

namespace Models;
class DeleteImage extends \Config\Dbh {

	protected function deleteImage($id){

		$sql = "DELETE FROM images WHERE id=?;";
		$stmt = $this->connect()->prepare($sql);
		if(!$stmt->execute([$id])){
			$stmt = null;
			header("Location: ../notFound.php");
			exit();
		}
		$stmt = null;
	}
}