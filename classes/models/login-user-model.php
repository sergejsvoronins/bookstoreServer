<?php
require_once "classes/db.php";
class LoginUserModel extends DB {
    
    public function loginUser (LoginUser $loginUser) {
        $query = "SELECT u.id, u.password, u.accountLevel FROM `users` AS u WHERE u.email = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$loginUser->email]);
        $user =  $stmt->fetchAll()[0];
        if (password_verify($loginUser->password, $user["password"])) {
            return [
                "id" => $user["id"],
                "accountLevel" => $user["accountLevel"]
            ];
        }
        else {
            header("HTTP/1.1 400 Bad Request");
            http_response_code(400);
            echo json_encode([
                'error' => "Invalid email or password"
            ]);
        }

    }
}