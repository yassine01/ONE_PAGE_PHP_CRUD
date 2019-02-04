<?php 
	// la connexion avec la BD.
	session_start();
	$db = mysqli_connect('localhost', 'admin', 'admin', 'biblio');

	// initialiser les variables.
	$id = 0;
	$reference = "";
	$titre = "";
	$auteur = "";
	$genre = "";
	$update = false;

	// Enregistrer l'ajout d'un livre.
	if (isset($_POST['save'])) {
		$reference = $_POST['reference'];
		$titre = $_POST['titre'];
		$auteur = $_POST['auteur'];
		$genre = $_POST['genre'];

		mysqli_query($db, "INSERT INTO livres (reference, titre, auteur, genre) VALUES ('$reference', '$titre', '$auteur', '$genre')"); 
		$_SESSION['message'] = "Livre saved!"; 
		header('location: home.php');
	}

	// Modifier les infos d'un livre.
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$reference = $_POST['reference'];
		$titre = $_POST['titre'];
		$auteur = $_POST['auteur'];
		$genre = $_POST['genre'];

		mysqli_query($db, "UPDATE livres SET reference='$reference', titre='$titre', auteur='$auteur', genre='$genre' WHERE id=$id");
		$_SESSION['message'] = "Livre updated!"; 
		header('location: home.php');
	}

	// Supprimer un livre.
	if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM livres WHERE id=$id");
	$_SESSION['message'] = "Livre deleted!"; 
	header('location: home.php');
	}

	//Importer les infos en CSV file.

	if(isset($_POST["export"])) {  
		header('Content-Type: text/csv; charset=utf-8');  
		header('Content-Disposition: attachment; filename=Livres.csv');  
		$output = fopen("php://output", "w");  
		fputcsv($output, array('Id', 'Reference', 'Titre', 'Auteur', 'Genre'));
		$query = "SELECT * FROM livres ORDER BY id";  
		$result = mysqli_query($db, $query);  
		while($row = mysqli_fetch_assoc($result)) {  
			fputcsv($output, $row);  
		}  
		fclose($output); 
	}  

	//Se deconnecter 
	if (isset($_POST['logout'])) {
		header("Location: index.php");
		exit;   
	}

?>