<?php

namespace Controllers;
class GalleryController extends \Models\Gallery {

	public function getGalleryImages(){

		return $this->getImages();
	}
}