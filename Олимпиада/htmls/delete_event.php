<?php
    include("db.php");
    if(isset($_GET["event_id"])) {
        $event_id = $_GET["event_id"];

        $sql = "DELETE FROM events WHERE event_id='$event_id'";
        $connection->query($sql);
    }

    header("location: /SPGI/BGEvents/Олимпиада/htmls/index.php");
    exit;
?>