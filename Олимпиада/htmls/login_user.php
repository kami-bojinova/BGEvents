<?php
session_start(); 
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!empty($username) && !empty($password) && !is_numeric($username)) {
        $query = "SELECT * FROM users WHERE username = '$username' limit 1";
        $result = mysqli_query($connection, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if ($user_data["password"] === $password) {
                // Записваме основните данни
                $_SESSION["user_id"] = $user_data["user_id"];
                $_SESSION["username"] = $user_data["username"];
                $_SESSION["role_id"] = $user_data["role_id"];
                
                // ДОБАВИ ТЕЗИ ДВА РЕДА, за да работи Dashboard-а:
                $_SESSION["firstname"] = $user_data["firstname"];
                $_SESSION["lastname"] = $user_data["lastname"];

                header("Location: home.php");
                die();
            }
        }
    }

    echo "Грешно потребителско име или парола!";
}
?>