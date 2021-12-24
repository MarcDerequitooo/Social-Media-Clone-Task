<!--This is for logout which will stop the session-->
<?php 
session_start();

session_unset();
session_destroy();

header("Location: index.php");