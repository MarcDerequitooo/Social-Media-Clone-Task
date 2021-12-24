<?php 
/*I used session in order to prevent the user to use the features without signing in or logging in first.*/
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
 ?>
 <?php 
 /* Include the page where connects the php to the database */
 include_once 'db_conn.php';
 ?>
 <?php
 /* This queries are used for display */
 $edit = mysqli_query($conn, "SELECT * FROM user_profile where id"); 
 $result = mysqli_query($conn, "SELECT * FROM media where id");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
     <link rel="stylesheet" type="text/css" href="css/styles.css">
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
     <div>
     <ul>
         <!--This is the navigation bar-->
          <li><a href="#">Home</a></li>
          <li style="float:right"><a class="active" href="logout.php">Logout</a></li>
          <li><a href="edit_profile.php" style="color: white; text-decoration:none;">Edit Profile</a></li>
          <!--<li><a href="update_profile.php" style="color: white; text-decoration:none;">Change Your Password</a></li>-->
          <li><a href="user_post.php" style="color: white; text-decoration:none;">Your Posts</a></li>
     </ul>
     </div>
     <!--------------------------------------------------------------------------->
     <?php
     /*This query is used for uploading the image which used a binding parameter because the image
     is a file. Tags and captions are also in this query for uploading*/
     $msg = '';
     if($_SERVER['REQUEST_METHOD']=='POST'){
         $caption = $_POST['capt'];
         $post_img = $_FILES['images']['tmp_name'];
         $tags=$_POST['tag'];
         $fimg = file_get_contents($post_img);

         $sql = "insert into media (images,captions,tags) values(?,'$caption','$tags')";
         $getimg = mysqli_prepare($conn,$sql);
         mysqli_stmt_bind_param($getimg,"s",$fimg);
         mysqli_stmt_execute($getimg);
         $check = mysqli_stmt_affected_rows($getimg);

         if($check==1) {
             header("Location:home.php");
         }
         else {
             $msg = 'Error uploading image';
         }
     }
     ?>
     <!--This is the form that is used for uploading the post of the user so there are image,caption, and tag however tag is not required. -->
     <div class="upload_post" style="width:450px; height:350px; position:relative; left:485px; background-color:white; border-radius: 10px; ">
            <form action="" method="post" enctype="multipart/form-data">
            <img id="pic"/><br/>
            <input type="file" name="images" onchange="" required/><br/> <br/>
            <input style="position:relative; top:-35px" type="text" name="capt" placeholder="Enter Caption" required/></br></br>
            <input style="position:relative; top:-70px" type="text" name="tag" placeholder="Enter Tag"/></br></br>
            <button style="position: relative; top:-85px" type="submit" name="submit" value="Upload">Upload image and Caption</button><br/><br/>
            </div>
            <div>
                <!-- This query is used for fetching and displaying the uploaded posts in the database-->
            <?php
            $i=0;

            while($row = mysqli_fetch_array($result)) {
            ?>
        <div class="timeline">
             <div class="timeline_post">
            <div class="timeline_user"><?php echo $_SESSION['user_name']; ?></div>
            <div><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['images']).'"height="315" width="300"/>' ?></div>
            <div class="timeline_caption" style="margin-top: 10px; margin-bottom:10px"><?php echo $row["captions"];?></div>
            <div><a name="Like" value="liked" style="text-decoration: none; position:relative; bottom:5px; left:135px; border-radius:10px; font-size:22px;" class="fa" href="#?id=<?php echo $row["id"];?>">&#xf087;</a></div>
                <a href="comment.php">See comments</a>
            <?php $i++; }?>
            </div>
             </div>
        </div>
            </div>
            <!-- This query is used for fetching and displaying the saved profile of the user-->
            <?php
            $Prow = mysqli_fetch_array($edit);
            ?>
                <div style="position: absolute; top:80px; left:35px; height: 600px; width:400px; background-color:white; padding:10px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-direction:column;">
                <div><a name="del" style="position:relative; bottom:10px; left:115px; border-radius:10px; padding:5px;" href="delete_profile.php?id=<?php echo $row["id"];?>">Delete current Profile</a></div>
                <div><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($Prow['prof_img']).'" height="300" width="300"/>' ?></div>
                <div class="user_det">
                <div style="background-color:black; padding:10px; margin-top:10px; border-radius:10px; color:white; width:200px" class="user_un">Username: <?php echo $_SESSION['user_name'] ?></div>
                <div style="background-color:black; padding:10px; margin-top:5px; border-radius:10px; color:white; width:200px" class="user_name">Name: <?php echo $Prow['prof_name'] ?></div>
                <b><div style="color:black; padding:5px; margin-top:5px; border-radius:10px;" class="user_bio">Bio</div></b>
                <div style="color:white; background-color:black; padding:10px; border-radius:10px; width:300px; height:100px"><?php echo $Prow['bio'] ?></div>
                </div>
                </div>
</body>
</html>
<!--so if the user is not logged in it will return the user to the login page.-->
<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>