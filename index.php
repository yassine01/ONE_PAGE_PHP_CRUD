<?php
// Start the session
session_start();
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "biblio";


// Creer un connexion
$conn = new mysqli($servername, $username, $password, $dbname);
// verifier la conn.
if ($conn->connect_error) {
    die("Connection failed! " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Gestion de biblio.</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
        <form action="#" method="POST">

            <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" id="username">
            </div>
            <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" id="password">
            <div>
            <button class="btn" type="submit" name="seconnecter" >Se connecter</button>
            </div>
        </form>

        <?php
        if(isset($_POST["username"]) && isset($_POST["password"]) ){
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
            print_r($_SESSION);
    
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);
            while ($row = mysqli_fetch_assoc($result)){
                if($_SESSION["username"] == $row["username"] && $_SESSION["password"] == $row["password"]){
                    header('Location: home.php');
                }else echo "erreur de connexion! ";
            }
           
        }
        ?>
    </body>
</html>
