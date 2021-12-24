<!--Deletion for user post-->
<?php
    include_once 'db_conn.php';
    $sql = "DELETE FROM media WHERE id='" . $_GET["id"] . "'";

    if (mysqli_query($conn, $sql)) {
        header("location:user_post.php");
        mysqli_close($conn);
    } 
    else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
?>


