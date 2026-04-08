<?php
include('db.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id']; 

    $sql = "DELETE FROM users WHERE user_id = $user_id";

    if ($connection->query($sql)) {
        header("Location: dash_users.php"); 
        exit();
    } else {
        echo "Грешка при изтриване: " . $connection->error;
    }
} else {
    echo "Не е предоставено ID на потребител.";
}
?>