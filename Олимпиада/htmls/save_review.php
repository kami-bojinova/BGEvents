<?php
session_start();
include 'db.php';

if (isset($_POST['submit_comment']) && isset($_SESSION['user_id'])) {
    $u_id = $_SESSION['user_id'];
    $username = $connection->real_escape_string($_POST['username']);
    $comment = $connection->real_escape_string($_POST['comment']);
    $rating = (int)$_POST['rating'];

    $sql = "INSERT INTO reviews (user_id, username, comment, rating) 
            VALUES ('$u_id', '$username', '$comment', '$rating')";

    if ($connection->query($sql)) {
        header("Location: comunitie.php?success=1");
    } else {
        echo "Грешка: " . $connection->error;
    }
} else {
    echo "Трябва да сте влезли в профила си, за да оставите коментар.";
}
?>