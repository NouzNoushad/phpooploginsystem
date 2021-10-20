<?php

namespace Models;
class Gallery extends \Config\Dbh {

	protected $errors;
	protected function getImages(){

		$sql = "SELECT fileName, id FROM images";
		$stmt = $this->connect()->prepare($sql);
		if(!$stmt->execute()){
			$stmt = null;
			header("Location: ../notFound.php");
			exit();
		}
		$results = $stmt->fetchAll();
		return $results;
	}
}