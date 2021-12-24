<!-- This file includes the posts of the user and their given feature which is to delete their own posts-->
<?php 
include_once 'db_conn.php';
$result = mysqli_query($conn, "SELECT * FROM media");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
<div>
     <ul>
          <li><a href="home.php">Back to Profile and Home</a></li>
          <li style="float:right"><a class="active" href="logout.php">Logout</a></li>
     </ul>
     <!--<h1 class="welcome">Welcome to Idle,<?php echo $_SESSION['name']; ?></h1>-->
     </div>
     <!--Fetching the posts of the user and display -->
    <?php
        $i=0;
        while($row = mysqli_fetch_array($result)) {
        ?>
        <div class="timeline">
             <div class="timeline_post">
             <div><a name="del" style="text-decoration: none; position:relative; bottom:15px; left:135px; border-radius:10px; padding:5px;" class=" w3-btn w3-large fa fa-trash" href="delete.php?id=<?php echo $row["id"];?>"></a></div>
            <div class="timeline_user"><?php /*echo $_SESSION['user_name'];*/ ?></div>
            <div><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['images']).'"height="315" width="300"/>' ?></div>
            <div class="timeline_caption" style="margin-top: 10px;"><?php echo $row["captions"]; ?></div>
             </div>
        </div>
        <?php
        $i++;}?>
</body>
</html>