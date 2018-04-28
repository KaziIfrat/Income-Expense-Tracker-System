<?php
    include 'dbms.php';
    session_start();
    if (!isset($_SESSION["user_id"]))
    {
        header("location: index.php");
    }
    $id=$_SESSION['user_id'];


    if (!$conn) {
      die('Could not connect: ' . mysqli_error($conn));
    }


    function fetch_data()  
    {  
        $output = '';  
        include 'dbms.php';
        $id=$_SESSION['user_id'];

        if (!$conn) {
          die('Could not connect: ' . mysqli_error($conn));
        }
        $sql="SELECT * FROM person WHERE user_id=$id" ;
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
       
        $output .= "<strong>Name: ".$row['user_name'];
        $output .= "<br>Phone: ".$row['phone'];
        $output .= "<br>Date: ".date('Y-m-d')."</strong> <br><br>";

        $output .= "
        <style>
        table{
          overflow: scroll;
          padding: 0px;
          margin-bottom: 20px;
          position: absolute;
        }
        tr th{
          border:1px solid black;
          background: #00CED1;
          align='middle';
          color:black;
          padding-left: 10px;
          padding-right: 10px;
        }
        td{
          border:1px solid black;
          padding-left: 10px;
          padding-right: 10px;

        }
        </style>



        <table>
            <tr>
                <th>SL no.</th>
                <th>Account</th>
                <th>Date</th>
                <th>Description</th>
                <th>Category</th>
                <th>Income</th>
                <th>Expense</th>
                <th>Debit/Credit</th>
                <th>Balance</th>
            </tr>";
        $sql="select * from person_information where person_id=$id" ;
        $result=mysqli_query($conn,$sql);
         
        $x=1;
        if($result->num_rows>0)
        {
            while($row= $result->fetch_assoc()){

                $output .= "<tr align='middle'>";
                $output .= "<td>" . $x . " </td>";
                $output .= "<td>" . $row['account_name'] . "</td>";
                $output .= "<td>" . $row['DDate'] . "</td>";
                $output .= "<td>" . $row['description'] . "</td>";
                $output .= "<td>" . $row['category'] . "</td>";
                $output .= "<td>" . $row['income'] . "</td>";
                $output .= "<td>" . $row['expense'] . "</td>";
                $output .= "<td>" . $row['debitcredit'] . "</td>";
                $output .= "<td>" . $row['balance'] . "</td>";
                $output .= "</tr>";
                $x++;
            } 
        }
        $output .= "</table>";
        return $output;
    } 

    if(isset($_POST["generate_pdf"]))  
    {  
        require_once('tcpdf/tcpdf.php');  
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
        $obj_pdf->SetCreator(PDF_CREATOR);  
        $obj_pdf->SetTitle("Income $ expense statement");  
        $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
        $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
        $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
        $obj_pdf->SetDefaultMonospacedFont('helvetica');  
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
        $obj_pdf->setPrintHeader(false);  
        $obj_pdf->setPrintFooter(false);  
        $obj_pdf->SetAutoPageBreak(TRUE, 10);  
        $obj_pdf->SetFont('helvetica', '', 11);  
        $obj_pdf->AddPage();  
        $content = '';      
        $content .= fetch_data();  
        $obj_pdf->writeHTML($content);  
        $obj_pdf->Output('file.pdf', 'I');  
    }  
?>  

<html>
<meta charset="utf-8">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BFIN | User Information</title>
    </head>
    <body>
        <link rel="stylesheet" href="style/bootstrap-4.1.0-dist/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="style/style.css">
        <?php include('header.php') ?>
        <?php include('side_bar.php') ?>
         
        <div id="container">
        
           
            <div id="information">
                <?php 
                    echo fetch_data();
                ?>  
          
            </div>
            
             <form  method="post">
                 <button id="form-group" type="submit" name="generate_pdf" class="btn btn-info">Generate PDF</button>
            </form>
        </div>
        
    </body>
</html>