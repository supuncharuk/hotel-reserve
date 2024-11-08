<?php
    require_once ("config.php");

    if (isset($_POST['id'])){
        $id = ($_POST['id']);

        $sql = "SELECT room_image_name FROM rooms WHERE room_number=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        $image_name = $row[0];

        $target_dir = "../assets/images/rooms/";
        $image_to_delete = $image_name;
        $image_path = $target_dir . basename($image_to_delete);

        if (file_exists($image_path)){
            if (unlink($image_path)) {
                $sql2 = "DELETE FROM rooms WHERE room_number=$id";
                $result2 = mysqli_query($conn, $sql2);

                if ($result2){
                    $response = ['success' => true, 'message' => 'Room deleted successfully', 'redirectUrl' => ''];
                    // echo "<script>alert('Successfully deleted');</script>";
                }else{
                    // echo "<script>alert('Not deleted');</script>";
                    $response = ['success' => false, 'message' => 'Room not deleted', 'redirectUrl' => ''];
                }
            }else {
                // echo "<script>alert('Sorry, there was an error deleting the image.')</script>";
                $response = ['success' => false, 'message' => 'Sorry, there was an error deleting the image', 'redirectUrl' => ''];
            }
        }else{
            // echo "<script>alert('Image does not exist.')</script>";
            $response = ['success' => false, 'message' => 'Image does not exist', 'redirectUrl' => ''];
        }
       
    }


    header('Content-Type: application/json');
    echo json_encode($response);
?>