<?php
require_once "classes/db.php";
class UserModel extends DB {
    protected $table = "users";
    public function getAllUsers () : array {
        return $this->getAll($this->table);
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
}