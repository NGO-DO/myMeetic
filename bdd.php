<?php
class MyDatabase
//le t-rex
{
    public $conn;
    public $stmt;

    public function __construct()
    //joue avec les function
    {
        $this->conn = $this->connect();
    }
    private function connect()
    {
        $host = "localhost";
        $dbname = "meetic";
        $username = "Guasette";
        $password = "wac";
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connecté à $dbname sur $host avec succès.";

            return $this->conn;
        } catch (PDOException $e) {
            echo "Impossible de se connecter à la base de données $dbname :" .
                $e->getMessage();
        }
    }
    public function add_user_to_db()
    {
        $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
        $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
        $birthdate = isset($_POST["birthdate"]) ? $_POST["birthdate"] : "";
        $city = isset($_POST["city"]) ? $_POST["city"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $genre = isset($_POST["choose"]) ? $_POST["choose"] : "";
        $hobbies = isset($_POST["hobbies"]) ? $_POST["hobbies"] : "";
        try {
            if (!$this->do_user_exists()) {
                $this->conn->prepare("INSERT INTO utilisateur (firstname, lastname, birthdate, city, email,password ,genre, hobbies) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")
                    ->execute([$firstname, $lastname, $birthdate, $city, $email, md5($password), $genre, $hobbies]);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function do_user_exists()
    {
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        try {
            $stmt = $this->conn->prepare("SELECT * FROM utilisateur WHERE email=?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if ($user === false) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function connexion()
    {
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        try {
            $stmt = $this->conn->prepare("SELECT * FROM utilisateur WHERE email=? AND password=?");
            $stmt->execute([$email, md5($password)]);
            $user = $stmt->fetch();
            if ($user) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['birthdate'] = $user['birthdate'];
                $_SESSION['genre'] = $user['genre'];
                $_SESSION['hobbies'] = $user['hobbies'];

                // header=rediriger
                header('Location: /accueil.php');
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
// try catch utile pour les tests ex sql , throw pour afficher les erreurs;
// SQL utile:
// Supprimer la table: DROP TABLE utilisateur;
// Supprimer les données de la table: TRUNCATE TABLE utilisateur;
// Créer la table utilisateur: CREATE TABLE meetic (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255), password VARCHAR(255), genre VARCHAR(255))
// AUTO_INCREMENT pour que l'id increment tout seul (1, 2, 3....)
// Ajouter un champ en SQL: ALTER TABLE utilisateur ADD lastname VARCHAR(255);
// prendre la date de la db de l'utilisateur ensuite faire un calcule si il a 18 ans depuis la date actuelle ensuite accepter ou non dans la db
// 