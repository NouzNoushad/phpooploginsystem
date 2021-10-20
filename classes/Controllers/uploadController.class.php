<?php

namespace Controllers;
class UploadController extends \Models\Upload {

	private $fileName;
	private $fileTmpName;
	private $fileSize;
	private $fileError;
	private $fileUniqueName;
	private $fileDestination;
	public $errors = [];

	public function __construct(string $fileName, string $fileTmpName, int $fileSize, int $fileError){

		$this->fileName = $fileName;
		$this->fileTmpName = $fileTmpName;
		$this->fileSize = $fileSize;
		$this->fileError = $fileError;
	}

	public function updateImage($id){

		$this->fileError();
		if(empty($this->errors)){
			$this->updateUploadImage($this->fileUniqueName, $this->fileSize, $this->fileDestination, $id);
			move_uploaded_file($this->fileTmpName, $this->fileDestination);
		}
		return $this->errors;
	}

	public function setImage(){

		$this->fileError();
		if(empty($this->errors)){
			$this->setUploadImage($this->fileUniqueName, $this->fileSize, $this->fileDestination);
			move_uploaded_file($this->fileTmpName, $this->fileDestination);
		}
		return $this->errors;
	}

	private function fileError(){

		if($this->emptyFile() === false){
			$this->errors['file'] = 'Please upload an image';
		}
		if($this->checkFileData() === 'extnotmatch'){
			$this->errors['error'] = 'Please upload an image with valid image extension';
		}
		if($this->checkFileData() === 'fileError'){
			$this->errors['error'] = 'Unexpected file error';
		}
		if($this->checkFileData() === 'unhandledFileSize'){
			$this->errors['error'] = 'Cannot upload large file';
		}
	}

	private function emptyFile(){

		if(empty($this->fileName)){
			return false;
		}
		else{
			return true;
		}
	}

	private function checkFileData(){

		$fileExt = explode('.', $this->fileName);
		$fileValidExt = strtolower(end($fileExt));
		$allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

		if(in_array($fileValidExt, $allowedExt)){
			if($this->fileError > 0){
				return 'fileError';
			}
			elseif($this->fileSize > 2000000){
				return 'unhandledFileSize';
			}
			else{

				$fileUniqueName = uniqid('', true) . '.' . $fileValidExt;
				$fileDestination = 'uploads/' . $fileUniqueName;

				$this->fileUniqueName = $fileUniqueName;
				$this->fileDestination = $fileDestination;
			}
		}
		else{
			return 'extnotmatch';
		}
	}
}