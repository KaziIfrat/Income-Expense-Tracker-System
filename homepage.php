<?php
    include 'dbms.php';
    session_start();


    if (!isset($_SESSION["user_id"]))
    {
        header("location: index.php");
    }
    $id=$_SESSION['user_id'];

    if(isset($_POST['submit'])){
        $name=$_POST['acc_name'];
        $description=$_POST['description'];
        $date=$_POST['date'];
        $category=$_POST['category'];
        $type=$_POST['type'];
        $amount=$_POST['amount'];
        $sql="SELECT balance from person_information where info_id = (select max(info_id) from person_information where person_id=$id);" ;
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);
        $balance=$row['balance'];
            
        if($type=='expense')
        {
            if(($balance-$amount) > 0)
            {
                  //  echo $balance-$amount;
                $sql="INSERT INTO `person_information`(`person_id`, `account_name`, `DDate`, `description`, `category`, `expense`, `debitcredit`, `balance`) VALUES ($id,'$name','$date','$description','$category',$amount,'credit',$balance-$amount);" ;
            }
            else
            {
                //echo "p";
                //header("location:homepage.php");
                echo "<script>alert('Not enough money');</script>";
                //return 0;
        
            }
             $res=mysqli_query($conn,$sql);
                    
        }
        else{
              //  echo $balance;
            $sql="INSERT INTO `person_information`(`person_id`, `account_name`, `DDate`, `description`, `category`, `income`, `debitcredit`, `balance`) VALUES ($id,'$name','$date','$description','$category',$amount,'debit',$balance+$amount);" ;
             $res=mysqli_query($conn,$sql);
        }
            
       
            
            
        if(!$res){
            echo "g";
           // echo "<script>alert('Invalid Input');</script>";
        }
        else
        {
            
            echo '<script>window.location= "information.php";</script>';
        }
    }
    ?>

<html>
<meta charset="utf-8">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BFIN | User HomePage</title>
    </head>
    <body>
        <link rel="stylesheet" href="style/bootstrap-4.1.0-dist/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="style/style.css">
        <?php include('header.php');?>
        <?php include('side_bar.php');?>
        <div id="container">
                <div id="login">
                    <form name="information" method="post">
                        <div>
                            <input type="text" name="acc_name" id="acc_name" class="form-control" placeholder="Account Name" aria-label="" aria-describedby="basic-addon1" required="">
                            <br>
                        </div>

                        <div class="form-group row">
                            <label  for="example-date-input" class="col-2 col-form-label">Date</label>
                                <div class="col-10">
                                    <input class="form-control" type="date" name=date value="yy-mm-dd" id="example-date-input" required="">
                                </div>
                            </div>
                        <div>
                            <input type="text" name="description" class="form-control" placeholder="Description" aria-label="" aria-describedby="basic-addon1" required="">
                            <br>
                        </div>
                        <div>
                            <input type="text" name="category" class="form-control" placeholder="Category" aria-label="" aria-describedby="basic-addon1" required="">
                            <br>
                        </div>
                        
                        <div>
                            <div>
                                <input type="radio" name="type" value="income" checked>
                                <label>
                                    Income
                                </label>
                                <input type="radio" name="type" value="expense">
                                <label>
                                    Expense
                                </label>
                                <br><br>
                            </div>
                        </div>
                        <div>
                            
                                <input type="text" name="amount" class="form-control" placeholder="Amount" aria-label="" aria-describedby="basic-addon1" required="">
                                <br>
                            
                        </div>
                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>
            </div>
    </body>
</html>