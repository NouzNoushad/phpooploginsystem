<?php

if(isset($_POST['logout-submit'])){
	session_start();
	session_unset();
	session_destroy();
	header("Location: ./gallery.php");
}
?>
<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Php-ooploginsystem</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-success py-3 ">
		<div class="container-fluid">
			<a class="navbar-brand" href="main.php">PHP OOP login system</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="justify-content-end">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="gallery.php">Home</a>
				</li>
				<?php if(isset($_SESSION['name'])): ?>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="upload.php">Add</a>
					</li>
					<li class="nav-item">
						<form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
							<button class="btn btn-link-dark text-light" name="logout-submit">Logout</button>
						</form>
					</li>
				<?php else: ?>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="signup.php">SignUp</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="login.php">Login</a>
					</li>
				<?php endif ?>
			</ul>
			</div>
			</div>
		</div>
	</nav>