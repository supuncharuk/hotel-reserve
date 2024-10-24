<?php
    require_once ("config.php");

    if (isset($_POST['id'])){
        $id = ($_POST['id']);

        $sql = "SELECT room_image_path FROM rooms WHERE room_number=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        $image_path = $row[0];

        // Check if the file exists and delete the image
        if (file_exists($image_path)){
            unlink($image_path); // Delete the file from the server
        }

        $sql2 = "DELETE FROM rooms WHERE room_number=$id";
        $result2 = mysqli_query($conn, $sql2);

        if ($result){
            echo "<script>alert('Successfully deleted');</script>";
        }else{
            echo "<script>alert('Not deleted');</script>";
        }
    }
?>