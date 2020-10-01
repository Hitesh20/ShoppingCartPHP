<?php
  session_start();


  require_once('Configuration/dbConnection.php');
  require_once('navbar.php');


  if(isset($_SESSION['is_user_logged_in'])==FALSE) {





 ?>

 <!DOCTYPE html>
 <html>

  <head>
    <title>Login</title>

  </head>
  <body>

    <?php


    if(isset($_POST['login'])) {

          $email = $_POST['email'];
          $password = md5($_POST['password']);



          $sql = "SELECT id, firstname FROM Users where email = '" . $email . "' and password = '" . $password . "' ";

          // echo $sql;
          //
           $result = mysqli_query($conn, $sql);

           if (mysqli_num_rows($result) != 0) {
             // output data of each row
             while($row = mysqli_fetch_assoc($result)) {
               $_SESSION["id"] = $row["id"];
               $_SESSION["is_user_logged_in"] = True;

               $msg = "'You are logged in as ". $row["firstname"] . ".'";

               echo "<script type='text/javascript'>swal('Success', $msg, 'error');</script>";

             }
             header("Location: index.php");
             exit();
           } else {
             echo "<script type='text/javascript'>swal('Invalid Credentials', 'Please enter correct username and password.', 'error');</script>";

           }

      }

     ?>

    <div class="container">

      <h1>Login Form</h1>

      <hr class="mt-1 mb-3">

      <form action="login.php" method="post">

        <div class="form-group">

          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
        </div>


        <div class="form-group">

          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Enter your password here">
        </div>

        <hr class="mt-1 mb-3">

        <input type="Submit" class="btn btn-success btn-success w-100" name="login" value="Login">


      </form>

    </div>


    <?php

  } else {
    ?>
    <script type="text/javascript">

    swal('Unauthorized', 'You are currently logged in.','error').then( () => {
        location.href = 'index.php'
    });
    </script>

  <?php


  }
  ?>














  </body>
 </html>
