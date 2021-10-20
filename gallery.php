<?php
declare(strict_types=1);
include_once './autoloader.php';

$gallery = new Controllers\GalleryController();
$images = $gallery->getGalleryImages();

?>
<?php include('./templates/header.php')?>

<div class="container">
	<div class="row my-5 py-4">
		<div class="col-md-12 m-auto">
			<div class="card card-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<?php if(empty($images)): ?>
							<?php if(isset($_SESSION['name'])): ?>
								<a href="upload.php" class="nav-link"><h2 class="text-center text-success">Add new images & fill your gallery</h2></a>
							<?php else: ?>
								<a href="login.php" class="nav-link"><h2 class="text-center text-success">Please Login first & add new images</h2></a>
							<?php endif ?>
						<?php else: ?>
							<div class="row row-cols-1 row-cols-md-4 g-4">
								<?php foreach($images as $image): ?>
								<div class="col">
									<div class="card h-100">
										<img src="uploads/<?= $image['fileName']?>" class="card-img-top" alt="...">
										<div class="card-body">
										</div>
										<?php if(isset($_SESSION['name'])): ?>
											<a href="update.php?id=<?= $image['id']?>" class="btn btn-outline-success">Edit</a>
										<?php endif ?>
									</div>
								</div>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('./templates/footer.php')?>