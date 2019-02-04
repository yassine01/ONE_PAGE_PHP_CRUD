<?php 
include('server.php');
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM livres WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$reference = $n['reference'];
			$titre = $n['titre'];
			$auteur = $n['auteur'];
			$genre = $n['genre'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion Biblio. </title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

<?php $results = mysqli_query($db, "SELECT * FROM livres"); ?>

<table>
	<thead>
		<tr>
			<th>Reference</th>
			<th>Titre</th>
			<th>Auteur</th>
			<th>Genre</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['reference']; ?></td>
			<td><?php echo $row['titre']; ?></td>
			<td><?php echo $row['auteur']; ?></td>
			<td><?php echo $row['genre']; ?></td>
			<td>
				<a href="home.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>

<form method="post" action="server.php" >

	<input type="hidden" name="id" value="<?php echo $id; ?>">

	<div class="input-group">
		<label>Reference</label>
		<input type="text" name="reference" value="<?php echo $reference; ?>">
	</div>
	<div class="input-group">
		<label>Titre</label>
		<input type="text" name="titre" value="<?php echo $titre; ?>">
	</div>
	<div class="input-group">
		<label>Auteur</label>
		<input type="text" name="auteur" value="<?php echo $auteur; ?>">
	</div>
	<div class="input-group">
		<label>Genre</label>
		<input type="text" name="genre" value="<?php echo $genre; ?>">
	</div>
	<div class="input-group">

		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update" style="background: #2ECC40;" >update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="save" >Save</button>
		<?php endif ?>

			<button class="btn" type="submit" name="export" >Export</button>
	</div>
            <input class="btnl" name="logout" type="submit"  value="logout" />
</form>

</body>
</html>