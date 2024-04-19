<?php
include_once './bdd.php';
$database = new MyDatabase();
// Sert à voir les erreurs PHP si il y en a
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
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
    INSCRIPTION
  </h1>
  <div class="container">
    <?php
    if (isset($_POST["submit"])) {
      $firstname = $_POST["firstname"];
      $lastname = $_POST["lastnam_POSe"];
      $birthdate = $_POST["birthdate"];
      $city = $_POST["city"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $genre = $_POST["choose"];
      $hobbies = $_POST["hobbies"];

      $error = array();
      if (empty($email) || empty($password) || empty($genre) || empty($hobbies)) {
        // array push aujouterdes informations à la fin de l'array
        $error['general'] = "All fields are required";
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Email is not valid";
      }
      if (strlen($password) < 3) {
        $error['pwd'] = "Password must be at least 3 characters long";
      }
      if (count($error) < 0) {
        return;
      }
      function age ($birthdate){
        $dateNow = new DateTime();
        $birthdate = new DateTime($birthdate);
        $interval = $dateNow->diff($birthdate);
        return $interval->y;
      }
      if (age($birthdate) <= 18) 
      { 
        echo "Désolé, seuls les utilisateurs de plus de 18 ans peuvent s'inscrire."; 
      } 
      else 
        {
          $db = new MyDatabase();
          // instancier pour que ca soit liée et qu'on puisse l'utiliser 
          $db->add_user_to_db($firstname, $lastname, $birthdate, $city, $email, $password, $genre, $hobbies);
          // echo "bonjour";
        }
    }
    ?>
    <form name="inscription" action="" method="post">
      <label for="firstname">Enter your firstname:</label>
      <input type="text" id="firstname" name="firstname" size="30" required value="" />
      <label for="laststname">Enter your laststname:</label>
      <input type="text" id="lastname" name="lastname" size="30" required value="" />
      <label for="birthdate">Enter your birthdate:</label>
      <input type="date" id="birthdate" name="birthdate" size="30" required value="" />
      <label for="city">Enter your city:</label>
      <input type="text" id=city name="city" size="30" required value="" />
      <label for="email">Enter your email:</label>
      <input type="email" id="email" name="email" size="30" required value="email@gmail.com" />
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" value="" />
      <label for="type-select">Choose a type:</label>
      <select name="choose" id="type-select">
        <option value="">--Please choose your gender--</option>
        <option value="Homme" selected>Men</option>
        <option value="Femme">Woman</option>
        <option value="Autre">Other</option>
      </select>
      <label for="hobbies">Enter your hobbies:</label>
      <input type="text" id="hobbies" name="hobbies" />
      <input type="submit" name="submit" value="register" />
    </form>
  </div>

</body>
</html>