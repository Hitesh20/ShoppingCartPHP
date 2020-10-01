<?php
  session_start();

  require_once('Configuration/dbConnection.php');

 ?>
<!DOCTYPE html>
<html>

 <head>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
 <body>

   <nav class="navbar navbar-expand-md bg-light navbar-light fixed-top mb-5">


     <a class="navbar-brand" href="index.php">Shopping Cart</a>
     <ul class="navbar-nav ">
       <li class="nav-item">
         <a class="nav-link" href="index.php">Home</a>
       </li>
     </ul>


     <ul class="navbar-nav float-sm-right ml-auto ml-5 ">

       <?php
        if(isset($_SESSION["is_user_logged_in"]) == FALSE) {
          echo "<li class='nav-item'>
            <a class='nav-link' href='register.php'>Register</a>
          </li>";
          echo "<li class='nav-item'>
            <a class='nav-link' href='login.php'>Login</a>
          </li>";
        } else {
          echo "<li class='nav-item'>
            <a class='nav-link' href='user_products.php'>Bag</a>
          </li>";
          echo "<li class='nav-item'>
            <a class='nav-link' href='logout.php'>Logout</a>
          </li>";
       }
       ?>



     </ul>
   </nav>

   <div class="mt-5 pt-4">

   </div>



 </body>
</html>
