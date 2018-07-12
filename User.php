<?php
include "autoload.php";

if($_GET["retrieve"]) {
    $user = new User();
    $data = $user->ormRetrieve();
    echo "<table border='1'>";
    echo "<thead>" . "<th>ID</th>" . "<th>Name</th>" . "<th>Password</th>" . "<th>Email</th>" . "</thead>";
    foreach ($data as $row) {
        echo "<tr>" . "<td>" . $row["id"] . "</td>" . "<td>" . $row["name"] . "</td>" . "<td>" . $row["password"] . "</td>" . "<td>" . $row["email"] . "</td>";
    }
    echo "</table>";
}
if($_POST["insert"]) {
    $user = new User($_POST["username"], $_POST["pass"], $_POST["email"]);
    $user->ormInsert();
}
if($_POST["update"]) {
    $user = new User();
    $user->ormUpdateById($_POST["targetId"], $_POST["username"], $_POST["pass"], $_POST["email"]);
}
if($_POST["delete"]) {
    $user = new User();
    $user->ormDeleteById($_POST["targetId"]);
}

class User {
    private $name, $password, $email;
    public function __construct($name = null, $password = null, $email = null) {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
    }

    public function ormInsert() {
        $pdo = new PDO('mysql:host=localhost;dbname=authentication', 'root', '');
        if(mysqli_connect_errno()) echo "connection problem" . mysqli_connect_error();

        $statement = $pdo->prepare("INSERT INTO users(name, password, email) VALUES (:name, :password, :email)");
        $statement->bindParam(":name", $this->name);
        $statement->bindParam(":password",$this->password);
        $statement->bindParam(":email",$this->email);
        $statement->execute();
    }

    public function ormRetrieve() {
        $pdo = new PDO('mysql:host=localhost;dbname=authentication', 'root', '');
        if(mysqli_connect_errno()) echo "connection problem" . mysqli_connect_error();
        $statement = $pdo->prepare("SELECT * FROM users");
        $statement->execute();
        $retrieval = $statement->fetchAll();

        return $retrieval;
    }

    public function ormUpdateById($targetId, $newName, $newPass, $newEmail) {
        $pdo = new PDO('mysql:host=localhost;dbname=authentication', 'root', '');
        if(mysqli_connect_errno()) echo "connection problem" . mysqli_connect_error();
        $statement = $pdo->prepare("UPDATE users SET name = '$newName', password = '$newPass', email = '$newEmail' WHERE id = $targetId");
        $statement->bindParam(":name", $newName);
        $statement->bindParam(":password", $newPass);
        $statement->bindParam(":email", $newEmail);

        $statement->execute();
    }

    public function ormDeleteById($targetId) {
        $pdo = new PDO('mysql:host=localhost;dbname=authentication', 'root', '');
        if(mysqli_connect_errno()) echo "connection problem" . mysqli_connect_error();
        $statement = $pdo->prepare("DELETE FROM users WHERE id = $targetId");
        $statement->execute();
    }
}