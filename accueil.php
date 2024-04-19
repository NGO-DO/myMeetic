<?php
include_once './bdd.php';
$database = new MyDatabase();

// Sert à voir les erreurs PHP si il y en a
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!array_key_exists('email', $_SESSION)) {
  header("Location: /inscription.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <link href="mymeetic.css" rel="stylesheet">
  <script src="mymeetic.js" rel="stylesheet"></script>
  <title>mymeetic</title>
</head>

<body>
  <nav>
    <a href="/accueil.php">Compte</a>
    <a href="/deconnexion.php">DECONNEXION</a>
  </nav>
  <h1>
    COMPTE
  </h1>
  <div class="container2">
    <h2>Bonjour: <?= $_SESSION['email'] ?>
      <!-- php echo $a par exemple -->
      <!-- // echo $_SESSION['email']; -->
      <p> Firstname: <?= $_SESSION['firstname'] ?>
      <p> Lastname: <?= $_SESSION['lastname'] ?>
      <p> Birthdate: <?= $_SESSION['birthdate'] ?>
      <p> Genre: <?= $_SESSION['genre'] ?>
      <p> Hobbies: <?= $_SESSION['hobbies'] ?>

  </div>
</body>
<!-- submit passe en haut et supprime -->
</html>