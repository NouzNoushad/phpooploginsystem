<?php
declare(strict_types=1);
include_once './autoloader.php';

if(isset($_POST['submit'])){

	$file = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];

	$upload = new Controllers\UploadController($fileName, $fileTmpName, $fileSize, $fileError);
	$errors = $upload->setImage();
	if(empty($errors)){
		header("Location: ./gallery.php");
		exit();
	}
}

?>

<?php include('./templates/header.php'); ?>

<div class="container">
	<div class="row my-5 py-5">
		<div class="col-md-8 m-auto">
			<div class="card card-body">
				<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">

				<?php if(!empty($errors['error'])): ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<div class="text-center"><?= $errors['error'] ?></div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif ?>
				<div class="row justify-content-center my-5">
					<div class="col-sm-10">
						<?php if(!empty($errors['file'])):?>
							<input type="file" name="file" class="form-control border-danger">
							<small class="text-danger"><?= $errors['file'] ?></small>
						<?php else: ?>
							<input type="file" name="file" class="form-control">
						<?php endif ?>
					</div>
					<div class="col-sm-10 mt-3">
						<button type="submit" name="submit" class="btn btn-success form-control">Upload</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include('./templates/footer.php'); ?>