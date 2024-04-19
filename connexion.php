<?php
include_once './bdd.php';
$database = new MyDatabase();

// Sert à voir les erreurs PHP si il y en a
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
  <a href="/inscription.php">INSCRIPTION</a>
  <a href="/connexion.php">CONNEXION</a>
</nav>
  <h1>
    CONNEXION
  </h1>
  <div class="container">
    <?php
    if (isset($_POST["submit"])) {
      $email = $_POST["email"];
      $password = $_POST["password"];

      $database->connexion();
    }
    ?>
    <form name="connexion" action="" method="post">
      <label for="email">Enter your email:</label>
      <input type="email" id="email" name="email" size="30" required value="chef@gmail.com" />
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" value="zebi">
      
      <input type="submit" name="submit" value="connect" />
    </form>
  </div>
  
</body>

</html>