<?php
declare(strict_types=1);
include_once './autoloader.php';

#                                                 <---------- Insert Image ---------->
$id = $_GET['id'];
$getImage = new Controllers\ImageController();
$image = $getImage->getUserImage((int) $id);

#                                                 <---------- Update Image ---------->
if(isset($_POST['submit'])){

	$id = $_GET['id'];
	$file = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	if(empty($fileName)){
		
		header("Location: ./gallery.php");
		exit();
	}
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];

	$update = new Controllers\UploadController($fileName, $fileTmpName, $fileSize, $fileError);
	$errors = $update->updateImage((int) $id);
	unlink((string) $image['filePath']);
	header("Location: ./gallery.php");
	exit();
}

#                                                 <---------- Delete Image ---------->
if(isset($_POST['delete'])){

	$id = $_GET['id'];
	$deleteImage = new Controllers\DeleteImageController();
	$deleteImage->deleteImageFile((int) $id);
	unlink((string) $image['filePath']);
	header("Location: ./gallery.php");
	exit();
}

?>

<?php include('./templates/header.php'); ?>

<div class="container">
	<div class="row my-5 py-5">
		<div class="col-md-8 m-auto">
			<div class="card card-body">
				<form action="update.php?id=<?= $image['id']?>" method="POST" enctype="multipart/form-data">
					<div class="row justify-content-center mt-4">
						<div class="text-center">
							<img src="uploads/<?= $image['fileName']?>" alt="" height=350 width=500>
						</div>
						<div class="col-sm-10 mt-4">
							<input type="file" name="file" class="form-control">
						</div>
						<div class="col-sm-10 mt-3">
							<button type="submit" name="submit" class="btn btn-outline-success form-control">Upload</button>
						</div>
					</div>
				</form>
				<form action="update.php?id=<?= $image['id']?>" method="POST">
					<div class="row justify-content-center mt-2 mb-5">
						<div class="col-sm-10">
							<button type="submit" name="delete" class="btn btn-outline-danger form-control">Delete</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include('./templates/footer.php'); ?>