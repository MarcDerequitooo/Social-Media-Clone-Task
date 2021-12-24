<?php
 include_once 'db_conn.php';

 $qry = mysqli_query($conn, "SELECT * FROM media"); 
 $data = mysqli_fetch_array($qry);

if(isset($_POST['Like'])){

    $id = $_GET['id'];
    $like=$_POST['Like'];
    $edit = "insert into media (likes) values('$like') where id";
    
    if($edit){
        mysqli_close($conn);
        header("Location:home.php");
        exit;
    }    
}