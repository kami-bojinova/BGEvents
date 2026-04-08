<?php
    include ('db.php');

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (firstname, lastname, username, email, password, phone_number, role_id) VALUES ('$firstname', '$lastname', '$username', '$email', '$password', '$phone_number', '1')";
    $result = $connection->query($query);

    if (!$result) {
        echo "Грешка ".$connection->error;
    }
    header("location: home.php");
    echo "Потребителя е добавен";
?>