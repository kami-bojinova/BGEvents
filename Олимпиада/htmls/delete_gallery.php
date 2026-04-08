<?php
    include("db.php");
    if(isset($_GET["images_id"])) {
        $images_id = $_GET["images_id"];

        $sql = "DELETE FROM images WHERE images_id='$images_id'";
        $connection->query($sql);
    }

    header("location: /SPGI/BGEvents/Олимпиада/htmls/gallery.php");
    exit;
?>