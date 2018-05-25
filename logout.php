<?php
 session_start();
   include 'dbms.php';
   if(session_destroy()) {
      header("Location: index.php");
   }
?>