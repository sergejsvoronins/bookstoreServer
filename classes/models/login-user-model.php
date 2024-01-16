<?php
require_once "classes/db.php";
class LoginUserModel extends DB {
    
    public function loginUser (LoginUser $loginUser) {
        $query = "SELECT c.id, c.password, c.accountLevel FROM `customers` AS c WHERE c.email = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$loginUser->email]);
        
        $user =  $stmt->fetchAll()[0];
        if (password_verify($loginUser->password, $user["password"])) {
            return [
                "id" => $user["id"],
                "accountLevel" => $user["accountLevel"]
            ];
        }

    }
}