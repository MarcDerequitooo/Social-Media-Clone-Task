<!--This is for deletion of the user's profile -->
<?php
    include_once 'db_conn.php';
    $prof_sql = "DELETE FROM user_profile";

    if (mysqli_query($conn, $prof_sql)) {
        header("Location: home.php");
        mysqli_close($conn);
    } 
    else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
?>