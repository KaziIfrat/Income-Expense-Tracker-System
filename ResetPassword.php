<?php

    include 'dbms.php';
    session_start();

               if(isset($_REQUEST['with'])){
					echo '<script>alert("Password changed!");';
					echo 'window.location= "index.php";</script>';
				}

    if (!isset($_SESSION["user_id"]))
    {
        header("location: index.php");
    }
    $id=$_SESSION['user_id'];

if(isset($_POST['change_password']))
{
    
    $old_password=$_POST['old_password'];
    $new_password=$_POST['new_password'];
    $again_password=$_POST['again_password'];
    
    if($new_password!=$again_password){
     //  echo "nw!=aw";
        echo "<script>alert('Password did not match. Try again');</script>";
    }
    
    else{
        $sql="select password from person where user_id=$id" ;
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        if($row['password']!=$old_password)
        {
            //echo "pw!=ow";

            echo "<script> alert('Old password is not valid'); </script>" ;
        }

        else
        {
            $sql1="UPDATE `person` SET `password`='$new_password' WHERE user_id = $id" ;
            $result1=mysqli_query($conn,$sql1);
            //echo "<script> alert('Password changed'); </script>" ;
            //echo "Password Changed.";
            header("location:ResetPassword.php?with=1");
        }
    }
}

?>




<html>
<meta charset="utf-8">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>BFIN | Reset Password</title>
         <link rel="stylesheet" href="style/bootstrap-4.1.0-dist/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="style/style.css">
	</head>
    <body>
        <?php include('header.php');?>
        <?php include('side_bar.php');?>
        
      
        <div id="container">
            <div id="login"> 
                <form method="post" action="ResetPassword.php">
                    
                    <input type="password" name="old_password" class="form-control" id="exampleInputPassword1" placeholder="Old Password" required="">
                    <br>
                     <input type="password" name="new_password" class="form-control" id="exampleInputPassword1" placeholder="New Password" required="">
                    <br>
                     <input type="password" name="again_password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password" required="">
                    <br>
                    <button type="submit" name="change_password" class="btn btn-info">Change password</button>
                </form>
                <div class="new-account">
                    <br>
                   
                    <a href="index.php">
                        Login
                    </a>
			    </div>
            </div>
        </div>
    </body>
</html>