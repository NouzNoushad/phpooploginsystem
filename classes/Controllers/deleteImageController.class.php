<?php

namespace Controllers;
class DeleteImageController extends \Models\DeleteImage {

	public function deleteImageFile(int $id){

		$this->deleteImage($id);
	}
}