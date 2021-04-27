<?php
include 'db.php';
$query = 'SELECT * FROM posts';
$result = mysqli_query($db, $query);
?>


<?php
session_start();

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: admin.php');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: admin.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<div class="header">
		<h2>Home Page</h2>
		<button onclick="document.location='admin.php'" type="submit" class="logout-btn" name="logout-btn">Blog Menagment</button>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success">
				<h3>
					<?php
					echo $_SESSION['success'];
					unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php if (isset($_SESSION['username'])) : ?>
			<p class="pozdrav">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>

		<?php endif ?>

		<table class="posts-preview-table">
			<tr>
				<th>TITLE</th>
				<th>DATE</th>
				<th>CONTENT</th>
				<th>IMAGE</th>
			</tr>

			<?php while ($row = mysqli_fetch_array($result)) { ?>
				<tr>
					<td><?php echo $row['title']; ?></td>
					<td><?php echo $row['date']; ?></td>
					<td><?php echo $row['content']; ?></td>
					<td>
						<img width=125px; height=125px; src="<?php echo $row['imageURL'] ?>" />
					</td>

				</tr>
			<?php  }
			?>
		</table>

	</div>

</body>

</html>
