<?php
    require_once ("config.php");

    if (isset($_POST['id'])){
        $id = ($_POST['id']);

        $sql = "DELETE FROM rooms WHERE room_number=$id";
        $result = mysqli_query($conn, $sql);
    }
?>