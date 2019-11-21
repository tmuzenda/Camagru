<?php
	ini_set("display_errors", true);
	session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Camagru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
	</head>
<body>
	<!-- <div class="main_wrapper"> -->
		<nav class="navbar" role="navigation" aria-label="main navigation">
			<div class="navbar-brand">
				<a class="navbar-item" href="index.php?pageno=1">
					<img src="images/final.gif" width="112px" height="112px">
				</a>
				<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
					<span aria-hidden="true"></span>
					<span aria-hidden="true"></span>
					<span aria-hidden="true"></span>
				</a>
			</div>
			<div id="navbarBasicExample" class="navbar-menu">
				<div class="navbar-start">
					<a class="navbar-item" href="index.php?pageno=1">Home</a>
			<?php
				if(isset($_SESSION['user_email'])) {
					echo "<a class='navbar-item' href='my_account.php'>My Account</a>";
				}
				else {
					echo "";
				}
			?>
			<div class="navbar-item has-dropdown is-hoverable">
			<?php
				if(!isset($_SESSION['user_email'])) {
					echo "";
				}
				else {
					echo "</a>";
					echo "<a class='navbar-item' href='post-img.php'>";
					echo "Post";
					echo "</a>";
					if (isset($_SESSION['user_email'])) {
						echo "<a class='navbar-item' href='view-posts.php'>My Posts</a>";
					}
					if (isset($_SESSION['user_email'])) {
						echo "<a class='navbar-item' href='view-posts-all.php?pageno=1'>All Posts</a>";
					}
				}
			?>
			</div>
		</div>
			<div class="navbar-end">
				<div class="navbar-item">
					<div class="buttons">
						<?php
							if(isset($_SESSION['user_email'])) {
								echo "";
							}
							else {
								echo "<a class='button is-primary' href='register.php'>";
								echo "<strong>Sign up</strong>";
								echo "</a>";
							}
						?>
						<?php
						if(isset($_SESSION['user_email'])) {
							echo "<a class='button is-light' href='login.php?Logout=TRUE'>Log out</a>";
						}
						else {
								echo "<a class='button is-light' href='login.php'>Log in</a>";
						}
						?>
					</div>
				</div>
			</div>
			</div>
		</nav>
		<div class="content_wrapper">
				<h1 style="text-align:left; padding-top:30px;">
					<?php
						if(!$user_email = $_SESSION['user_email']) {
							echo "<script>window.open('index.php', '_self')</script>";
						}
					?>
				</h1>
				<figure class="image is-128x128" style="margin-left:50px;">
					<?php
						include ('config/connect.php');
						$queryIMG = ("SELECT * from `users` WHERE user_email=:user_email");
						$queryPrep = $dbh->prepare($queryIMG);
						$queryPrep->bindParam(':user_email', $user_email, PDO::PARAM_STR);
						$queryPrep->execute();
						$row = $queryPrep->fetch();
						$check_img = $row['user_image'];
						if (empty($check_img)) {
							echo "<img class='is-rounded' src='https://bulma.io/images/placeholders/128x128.png'>";
						}
						else {
							echo "<img class='is-rounded' src='users/user_images/$check_img' style='width: 128px; height: 128px'>";
						}
					?>
				</figure>
		</div>
		<br/>
		<div class="buttons" style="margin-top:10px; margin-left: 50px;">
			<?php echo "<a class='button is-primary' href='DetailsUpdate.php'>Edit Account</a>"; ?>
		</div>
		<div align="center" style="margin-top:-200px; margin-left: center position:fixed">
			<?php
			?>
		</div>
		<!-- Scripts -->
		<script>document.addEventListener('DOMContentLoaded', () => {
			// Get all "navbar-burger" elements
			const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
			// Check if there are any navbar burgers
			if ($navbarBurgers.length > 0) {
				// Add a click event on each of them
				$navbarBurgers.forEach( el => {
					el.addEventListener('click', () => {
					// Get the target from the "data-target" attribute
						const target = el.dataset.target;
						const $target = document.getElementById(target);
						// Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
						el.classList.toggle('is-active');
						$target.classList.toggle('is-active');
					});
				});
			}
		});
		</script>
		<!-- Scripts end -->
</body>

<?php
	try {
		include ('config/connect.php');
	}
	catch(PDOException $e) {
		echo "ERROR: ".$e->getMessage();
		exit(2);
	}
?>
<div id="footer">
	<h2 style="text-align:center; padding-top:30px;"><i>@tmuzenda-2019<i></h2>
</div>
</html>

<?php
	// if ($_SESSION == NULL){
	// 	echo "";
	// }
	// else {
	// 	$email = $_SESSION['user_email'];
	// 	if (isVerifiedUser($email) == '1') {
	// 		echo "";
	// 	}
	// 	else if (isVerifiedUser($email) == '0')
	// 	{
	// 		echo "<script>alert('Verify your account please')</script>";
	// 		echo "<script>window.open('index.php', '_self')</script>";
	// 		session_destroy();
	// 	}
	// }
	if (isset($_GET['Logout'])) {
		if ($_GET['Logout'] == 'TRUE')
		session_destroy();
		echo "<script>window.open('index.php', '_self')</script>";
	}
?>