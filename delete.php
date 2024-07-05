<?php
include "config.php";
if (isset($_POST['op']) && $_POST['op'] == "delete") {
    $id = $_POST['id'];
    $sql = "DELETE FROM article WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "success";
    } else {
        echo "error";
    }
    exit;
}
?>