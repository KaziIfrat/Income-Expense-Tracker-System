<?php
    include_once('dbms.php');
session_start();
     if(isset($_REQUEST['with'])){
					echo '<script>alert("Registered successfully!");';
					echo 'window.location= "index.php";</script>';
				}
    if(isset($_POST['submit']) )
    {
        $fname=$_POST['full_name'];
        $address=$_POST['address'];
        $age=$_POST['age'];
        $gender=$_POST['gender'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $password=$_POST['password'];
        $password_again=$_POST['password_again'];

        $sql="INSERT INTO `person`( `user_name`, `email`, `phone`, `addresss`, `gender`, `age`, `password`) VALUES ('$fname','$email','$phone','$address','$gender',$age,'$password')";

        $query=mysqli_query($conn,$sql);

        if($query)
        {
        	header("location:registration.php?with=1");
           
        }
        else echo "P";
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>BFIN | User Registration</title>
        <link rel="stylesheet" href="style/bootstrap-4.1.0-dist/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="style/style.css">
	</head>

	<body>
        <?php include 'header.php'; ?>
		<div id="container">
			<div id="login">
				<form onsubmit="return isValid()" name="registration" method="post">
					
                    	<div>
                            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="User Name" aria-label="" aria-describedby="basic-addon1">
                            <span id="fn" style="color:red"></span><br>
						</div>
						<div>
							
                            <input type="text" name="address" id="address" class="form-control" placeholder="Address" aria-label="" aria-describedby="basic-addon1">
                            <span id="ad" style="color:red"></span><br>
						</div>
						<div>
                            <input type="text" name="age" id="age" class="form-control" placeholder="Age" aria-label="" aria-describedby="basic-addon1">
                            <span id="ag" style="color:red"></span><br>
						</div>
                    <div>
                                Gender
								<input type="radio" name="gender" id="gender" value="female">
								<label>
									Female
								</label>
								<input type="radio" name="gender" id="gender" value="male">
								<label>
									Male
								</label>
                                <span id="gen" style="color:red"></span><br>
							</div>
						<div>
							
						
							<span>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" aria-label="" aria-describedby="basic-addon1">
                                <span id="em" style="color:red"></span><br>
								</span>
						</div>
                        <div>
							<span>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" aria-label="" aria-describedby="basic-addon1">
                                <span id="ph" style="color:red"></span><br>
								</span>
						</div>
						<div>
							<span>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="" aria-describedby="basic-addon1">
                                <span id="p" style="color:red"></span><br>
                                <input type="password" name="password_again" id="password_again" class="form-control" placeholder="Password Again" aria-label="" aria-describedby="basic-addon1">
			                    <span id="pa" style="color:red"></span><br>
							</span>
						</div>
                        <div>
                            <input type="checkbox" id="agree" value="agree">
                            <label for="agree">
                                I agree
                            </label>
                            <span id="agr" style="color:red"></span>
						</div>
					
                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
						<div class="new-account">
							Already have an account?
								<a href="index.php">
									Log-in
								</a>
						</div>
				
				</form>
                    
                <script type="text/javascript">
                    function isValid() {
                        var name = document.getElementById('full_name');
                        var email = document.getElementById('email');
                        var address = document.getElementById('address');
                        var age = document.getElementById('age');
                        var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
                        
                        var phone = document.getElementById('phone');
                        var agree = document.getElementById('agree');
                        var mbpattern = /^(\+)?(88)?(01)(1|([5-9]))([0-9]{8})$/;
                        
                        var radio= document.getElementsByName('gender');
                        var password= document.getElementById('password');
                        var password_again= document.getElementById('password_again');
                        var status = true;

                        if (name.value.length == 0) {
                            document.getElementById('fn').innerHTML = "*Enter Your Name";
                            status = false;
                        }else {
                            document.getElementById('fn').innerHTML = "";  
                        }


                        if (address.value.length == 0) {
                            document.getElementById('ad').innerHTML = "*Enter Your Address";
                            status = false;
                        }else {
                            document.getElementById('ad').innerHTML = "";  
                        }
                        
                        
                        if (age.value.length == 0) {
                            document.getElementById('ag').innerHTML = "*Enter Your age";
                            status = false;
                        }else {
                            document.getElementById('ag').innerHTML = "";  
                        }
                        
                        if (email.value.length == 0 || (!pattern.test(email.value))) {
                            if (email.value.length == 0)
                                document.getElementById('em').innerHTML = "*Enter Email";
                            
                            else
                                document.getElementById('em').innerHTML = "*Email is not Valid"; 
                            status = false;

                        }else {
                            document.getElementById('em').innerHTML = "";  
                        }
                        
                        
                        if (phone.value.length == 0 || (!mbpattern.test(phone.value))) {
                            if (phone.value.length == 0)
                                document.getElementById('ph').innerHTML = "*Enter phone no.";
                            else
                                document.getElementById('ph').innerHTML = "*Phone no. is not Valid";
                            status = false;
                        }else {
                            document.getElementById('ph').innerHTML = "";  
                        }

                        for (var i = 0; i < radio.length; i++) {
                            if (radio[i].checked) {
                                document.getElementById('gen').innerHTML = "";  
                                break;
                            }
                        }
                        if (i == radio.length){
                            document.getElementById('gen').innerHTML = " *Pleae check male/female";
                            status = false;
                        }
                        
                        
                        if (password.value.length == 0) {
                            document.getElementById('p').innerHTML = "*Enter password";
                            status = false;
                        }else {
                            document.getElementById('p').innerHTML = "";  
                        }
            
                        
                        if (password_again.value.length == 0) {
                            document.getElementById('pa').innerHTML = "*Enter password again";
                            status = false;
                        }else if(password_again.value != password.value){
                            document.getElementById('pa').innerHTML = "*Password not matched";
                            status=false;
                        }
                        else {
                            document.getElementById('pa').innerHTML = "";  
                        }
                        
                        if(!agree.checked && status){
                            document.getElementById('agr').innerHTML = "Agree?";
                            status=false;
                        }else{
                            document.getElementById('agr').innerHTML = "";
                        }
                        
                        return status;
                    }
                </script>
			</div>
		</div>	
	</body>
</html>