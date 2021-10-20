<?php

namespace Controllers;
class ImageController extends \Models\Image {

	public function getUserImage(int $id){

		return $this->getImage($id);
	}
}