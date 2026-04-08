<?php
    include("db.php");
    if(isset($_GET["category_id"])) {
        $category_id = $_GET["category_id"];

        $sql = "DELETE FROM categories WHERE category_id='$category_id'";
        $connection->query($sql);
    }

    header("location: /SPGI/BGEvents/Олимпиада/htmls/categories.php");
    exit;
?>