<?php
 include_once 'db_conn.php';

 $qry = mysqli_query($conn, "SELECT * FROM users"); 
 $data = mysqli_fetch_array($qry);

if(isset($_POST['update'])){

    $id = $_GET['id'];
    $Npass =validate($_POST['chg_pass']);
    $edit = mysqli_query($conn,"UPDATE users SET password='$Npass' where id");
    if($edit){
        mysqli_close($conn);
        header("Location:home.php");
        exit;
    }    
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
     <link rel="stylesheet" type="text/css" href="css/styles.css">
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div>
     <ul>
          <li><a href="home.php">Back to Profile and Home</a></li>
          <li style="float:right"><a class="active" href="logout.php">Logout</a></li>
     </ul>
</div>
<div class="upload_post" style="width:450px; background-color: white; position:absolute; left:500px">   
            <form action="" method="post" enctype="multipart/form-data">
            
            <input type="text" name="chg_pass" placeholder="New Password"/></br></br>
            <input type="submit" name="update" value="Change Password">
        </form>
</body>
</html>