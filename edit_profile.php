<!--Connect this page to the database connection query -->
<?php
include_once 'db_conn.php'; 
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/styles.css">
    <title></title>
<script>
        function view() {
            pic.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</head>
<body>
<div>
     <ul>
          <li><a href="home.php">Back to Profile and Home</a></li>
          <li style="float:right"><a class="active" href="logout.php">Logout</a></li>
     </ul>
</div>
<!--The queries are not that different but this is for the profile i used the same query for the posts-->
    <?php
        $msg = '';
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $bio = $_POST['bio'];
            $prof_name = $_POST['prof_name'];
            $prof_image = $_FILES['prof_img']['tmp_name'];
            $fimg = file_get_contents($prof_image);

            $sql = "insert into user_profile (prof_img,prof_name,bio) values(?,'$prof_name','$bio')";
            $getimg = mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($getimg,"s",$fimg);
            mysqli_stmt_execute($getimg);
            $check = mysqli_stmt_affected_rows($getimg);

            if($check==1) {
                header("location:home.php");
            }
            else {
                $msg = 'Error uploading image';
            }
        }
    ?>
            <div class="upload_post" style="width:450px; background-color: white; position:absolute; left:500px">   
            <form action="" method="post" enctype="multipart/form-data">
            <img id="pic" src="assets/default-profile-pic.jpg" style="padding-top: 10px; border-radius: 10px;"/><br/>
            <input type="file" name="prof_img" onchange="view()" required/><br/> <br/>
            <input type="text" name="prof_name" placeholder="Enter Name" required/></br></br>
            <input type="text" name="bio" placeholder="Enter Bio" required/></br></br>
            <button>Save Profile</button><br/><br/>
        </form>
            </div>

<div style="text-align: center"><?php echo $msg ?></div>

</body>
</html>
