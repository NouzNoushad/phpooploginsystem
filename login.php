<?php
declare(strict_types=1);
include_once './autoloader.php';

if(isset($_POST['submit'])){

	$email = $_POST['email'];
	$password = $_POST['password'];

	$login = new Controllers\LoginController($email, $password);
	$errors = $login->loginUserError();
	if(empty($errors)){
		header("Location: ./gallery.php");
		exit();
	}
}

?>

<?php include('./templates/header.php')?>

<div class="container">
	<div class="row my-5 py-4">
		<div class="col-md-5 m-auto">
		<div class="card card-body border-success">
			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
			<?php if(!empty($errors)): ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<div class="text-center"><?= $errors?></div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif ?>
				<?php if(!empty($errors['error'])): ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<div class="text-center"><?= $errors['error'] ?></div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif ?>
				<div class="row justify-content-center my-4">
					<div class="col-md-10 mt-3">
						<?php if(!empty($errors['email'])):?>
							<input type="email" name="email" class="form-control border-danger" placeholder="Email">
							<small class="text-danger"><?= $errors['email'] ?></small>
						<?php else: ?>
							<input type="email" name="email" class="form-control border-success" placeholder="Email">
						<?php endif ?>
					</div>
					<div class="col-md-10 mt-3">
						<?php if(!empty($errors['password'])):?>
							<input type="password" name="password" class="form-control border-danger" placeholder="Password">
							<small class="text-danger"><?= $errors['password'] ?></small>
						<?php else: ?>
							<input type="password" name="password" class="form-control border-success" placeholder="Password">
						<?php endif ?>
					</div>
					<div class="col-md-10 mt-3">
						<button type="submit" name="submit" class="btn btn-success form-control">Login</button>
					</div>
					<div class="col-md-10 mt-3">
						<p class="lead">Don't Have an Account? <a href="signup.php" class="text-success">SignUp</a></p>
					</div>
				</div>
			</form>
		</div>
		</div>
	</div>
</div>

<?php include('./templates/footer.php')?>