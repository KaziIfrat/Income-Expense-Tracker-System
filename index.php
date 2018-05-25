<?php
    include_once 'dbms.php';

    session_start();
    if (isset($_SESSION["user_id"]))
    {
        header("location: homepage.php");
        $id=$_SESSION['user_id'];
    }


    if(isset($_POST['submit'])){
        $user_name=$_POST['user_name'];
        $password=$_POST['password'];
        $message="";

            
        $sql="SELECT user_id, user_name FROM person WHERE user_name='$user_name' AND password='$password'";
            
        $result=mysqli_query($conn,$sql);

        if(!$row=mysqli_fetch_assoc($result) )
    	{
            echo "<script>alert('Invalid Login. Try again');</script>";
    	}else{
            $_SESSION['user_id']=$row['user_id'];
            header("location: homepage.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>BFIN | Login</title>
        <link rel="stylesheet" href="style/bootstrap-4.1.0-dist/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="style/style.css"> 
	</head>
    <body>
        <?php include('header.php');?>
        <div id="container">
            <div id="login"> 
                <form method="post" action="index.php">
                    <input type="text" name="user_name" class="form-control" placeholder="User Name" aria-label="" aria-describedby="basic-addon1">
                    <br>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    <br>
                    <button type="submit" name="submit" class="btn btn-info">Login</button>
                </form>
                <div class="new-account">
                    <br>
                    Don't have an account yet?
                    <a href="registration.php">
                        Create an account
                    </a>
			    </div>
            </div>
        </div>
    </body>
</html>

