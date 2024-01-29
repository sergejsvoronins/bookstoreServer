<?php
require_once "classes/db.php";
class UserModel extends DB {
    protected $table = "users";
    public function getAllUsers () : array {
        $query = "SELECT  `id`, `firstName`, `lastName`, `accountLevel`, `address`, `zip`, `city`, `mobile`, `email`, `created`, `modified` FROM `users` AS u";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getOneUser (int $id) {
        $query = "SELECT  `id`, `firstName`, `lastName`, `accountLevel`, `address`, `zip`, `city`, `mobile`, `email`, `created`, `modified` FROM `users` AS u
        WHERE u.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
    public function addUser(User $user) {
        //hashing password
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        //check if email address has already registred
        $query = "SELECT * FROM `users` AS u WHERE u.email = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$user->email]);
        $rowCount =  $stmt->rowCount();
        if($rowCount !== 0) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode([
                "error" => "There is account with that email address"
            ]);
        }
        else {
            $query = "INSERT INTO `users`(`accountLevel`, `password`,`email`, `created`) VALUES (?,?,?,?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$user->getAcccountLevel(), $hashedPassword, $user->email, $user->created]);
            return $this->pdo->lastInsertId();

        }  
    }
    public function updateUser (User $user, int $id) {
        $query = "UPDATE `users` AS u SET `firstName`= ?,`lastName`= ?,`address`= ?,`zip`= ?,`city`= ?,`mobile`= ?,`modified`= ? WHERE u.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$user->firstName, $user->lastName, $user->address, $user->zipCode, $user->city, $user->mobile, time(), $id]);
        return $stmt->rowCount();
    }
    public function updateUserLevel (User $user, int $id) {
        $query = "UPDATE `users` AS u SET `accountLevel`= ?,`modified`= ? WHERE u.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$user->getAcccountLevel(),time(), $id]);
        if($stmt->rowCount() !== 0) {
            return $stmt->rowCount();
        }
        else {
            header("HTTP/1.1 400 Bad Request");
            http_response_code(400);
        }
    }
    public function deleteUser (int $id) : void {
        $query = "DELETE FROM `users` WHERE users.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
    }
    public function updatePassword (User $user, int $id, $oldPassword ) {
        $queryUser = "SELECT u.password FROM `users` AS u WHERE u.id = ?";
        $stmt = $this->pdo->prepare($queryUser);
        $stmt->execute([$id]);
        $userPassword =  $stmt->fetchAll()[0];
        if (password_verify($oldPassword, $userPassword["password"])) {
            $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            $query = "UPDATE `users` AS u SET `password`= ?, `modified`= ? WHERE u.id = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$hashedPassword, time(), $id]);
            return $stmt->rowCount();
        }
        else {
            header("HTTP/1.1 400 Bad Request");
            http_response_code(400);
            echo json_encode([
                'message' => 'The old password is not correct.'
            ]);
        }
    }
    public function getTable () {
        return $this->table;
    }
}