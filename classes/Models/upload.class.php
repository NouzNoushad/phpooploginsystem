<?php

namespace Models;
class Upload extends \Config\Dbh {

	protected $errors;
	protected function setUploadImage($fileName, $fileSize, $filePath){

		$sql = "INSERT INTO images (fileName, fileSize, filePath) VALUES (?, ?, ?);";
		$stmt = $this->connect()->prepare($sql);
		if(!$stmt->execute([$fileName, $fileSize, $filePath])){
			$stmt = null;
			header("Location: ../notFound.php");
			exit();
		}
		$stmt = null;
	}

	protected function updateUploadImage($fileName, $fileSize, $filePath, $id){

		$sql = "UPDATE images SET fileName=?, fileSize=?, filePath=? WHERE id=?";
		$stmt = $this->connect()->prepare($sql);
		if(!$stmt->execute([$fileName, $fileSize, $filePath, $id])){
			$stmt = null;
			header("Location: ../notFound.php");
			exit();
		}
		$stmt = null;
	}
}