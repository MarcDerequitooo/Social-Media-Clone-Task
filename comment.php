<!-- This is the comment page where the user can posts their comments on a post -->
<?php
include_once 'db_conn.php'; 
$comment = mysqli_query($conn,"SELECT * from user_comments");

if(isset($_POST['post_cmmt'])){
    $post_cmt=$_POST['cmmt'];
    $post_name=$_POST['commenter'];

    $comment_post = mysqli_query($conn,"insert into user_comments (name,comments) values('$post_name','$post_cmt')");
    if($comment_post){
        mysqli_close($conn);
        header("Location:comment.php");
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
    <title>Comment</title>
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
</div><!--This is the form, so for comment i used text are instead of just input-->
<div style="display: flex; justify-content:center; align-items:center;">
    <div class="timeline_post" style="width: 500px; height:275px;">
        <form action="" method="POST">
        <input type="text" name="commenter" placeholder="Enter Name"/></br></br>
        <textarea type="text "name="cmmt" cols="35" rows="3" placeholder="Enter Comment"></textarea>
        <input class="input_btn" type="submit" name="post_cmmt" value="Post Comment" style="margin-top: 5px; background-color: #555; color:white; width:150px;">
    </div>
</div>
<div><!--This is for fetching the comment that has been inserted in the database-->
    <?php
    $i = 0;
    while($Crow = mysqli_fetch_array($comment)){
    ?>
    <div class="timeline">
    <div class="timeline_post">
    <div style="color:white; background-color:black" class="timeline_user"><?php echo $Crow['name'] ?></div>
    <b><div style="color:black; padding:5px">Comment</div></b>
    <div style="background-color: #555; padding:10px; border-radius:10px; color:white; width: 300px; height:100px"><?php echo $Crow['comments'] ?></div>
    </div>
    </div>
    <?php $i++; }?>
</div>
</body>
</html>