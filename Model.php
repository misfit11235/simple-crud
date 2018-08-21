<?php
    require_once __DIR__.'/vendor/autoload.php';
    use Symfony\Component\Dotenv\Dotenv;

    abstract class Model {
        protected $connection;
        public function __construct() {
            //getting env variables
            $dotenv = new Dotenv();
            $dotenv->load(__DIR__ . "/.env");
            $dbuser = getenv("DB_USER");
            $dbpass = getenv("DB_PASS");
            $dbname = getenv("DB_NAME");
            $dbhost = getenv("DB_HOST");
            $this->connection = new PDO("mysql:dbname=" . $dbname . ";host=" . $dbhost, $dbuser, $dbpass);
        }

        public function ormCreate($name, $password, $email) {
            $statement = $this->connection->prepare("INSERT INTO users(name, password, email) VALUES (:name, :password, :email)");
            $statement->bindParam(":name", $name);
            $statement->bindParam(":password",$password);
            $statement->bindParam(":email",$email);
            $statement->execute();
            echo "User created!";
            header("refresh: 1; url =  http://localhost/authentication/index.php");
        }

        public function ormRetrieve($table) {
            $statement = $this->connection->prepare("SELECT * FROM " . $table);
            $statement->execute();
            $retrieval = $statement->fetchAll();
            return $retrieval;
        }

        public function ormUpdateById($targetId, $newName, $newPass, $newEmail, $table) {
            $statement = $this->connection->prepare("UPDATE " . $table . " SET name = '$newName', password = '$newPass', email = '$newEmail' WHERE id = $targetId");
            $statement->bindParam(":name", $newName);
            $statement->bindParam(":password", $newPass);
            $statement->bindParam(":email", $newEmail);
            $statement->execute();
            echo "User updated!";
            header("refresh: 1; url =  http://localhost/authentication/index.php");
        }

        public function ormDeleteById($targetId, $table) {
            $statement = $this->connection->prepare("DELETE FROM " . $table . " WHERE id = " . $targetId);
            $statement->execute();

            echo "User deleted!";
            header("refresh: 1; url =  http://localhost/authentication/index.php");
        }

        public function getUserById($targetId, $table) {
            $statement = $this->connection->prepare("SELECT * FROM " . $table . " WHERE id=" . $targetId);
            $statement->execute();
            $retrieval = $statement->fetchObject();
            return $retrieval;
        }
        
        public function addAddress($targetId, $city, $street, $zipcode) {
            $statement = $this->connection->prepare("INSERT INTO addresses(city, street, zipcode, user_id) VALUES (:city, :street, :zipcode, :user_id)");
            $statement->bindParam(":city", $city);
            $statement->bindParam(":street", $street);
            $statement->bindParam(":zipcode", $zipcode);
            $statement->bindParam(":user_id", $targetId);
            $statement->execute();
            echo "Address added!";
            header("refresh: 1");
        }

        public function showAddresses($targetId) {
            $statement = $this->connection->prepare("SELECT * FROM addresses WHERE user_id = $targetId");
            $statement->execute();
            $addresses = $statement->fetchAll();
            return $addresses;
        }

        public function updateAddress($targetId, $newCity, $newStreet, $newZipcode, $table) {
            $statement = $this->connection->prepare("UPDATE " . $table . " SET city = '$newCity', street = '$newStreet', zipcode = '$newZipcode' WHERE address_id = $targetId");
            $statement->bindParam(":city", $newCity);
            $statement->bindParam(":street", $newStreet);
            $statement->bindParam(":zipcode", $newZipcode);
            $statement->execute();
            echo "Address updated!";
            header('refresh:1');
        }

        public function deleteAddress($targetId, $table) {
            $statement = $this->connection->prepare("DELETE FROM " . $table . " WHERE address_id = ". $targetId);
            $statement->execute();
        }

        public function getAddressById($targetId, $table) {
            $statement = $this->connection->prepare("SELECT * FROM " . $table . " WHERE address_id=" . $targetId);
            $statement->execute();
            $retrieval = $statement->fetchObject();
            return $retrieval;
        }
    }