<?php


  require_once('Configuration/dbConnection.php');
  require_once('navbar.php');

  if(isset($_SESSION['is_user_logged_in'])==FALSE) {


 ?>




 <!DOCTYPE html>
 <html>

  <head>
    <title>Register Here</title>

  </head>
  <body>

    <?php

      if(isset($_POST['signup'])) {



            $sql = "SELECT email FROM Users where email = " . $_POST['email'];
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              echo "<script type='text/javascript'>swal('Error', 'User already exists. Try making account with some other email.', 'error');</script>";
            } else {


              $firstname = $_POST['firstname'];
              $lastname = $_POST['lastname'];
              $email = $_POST['email'];
              $contact = $_POST['contact'];
              $password = md5($_POST['password']);

              $sql = "INSERT INTO Users (firstname, lastname, email, contact, password) VALUES (?,?,?,?,?)";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("sssss", $firstname, $lastname, $email, $contact, $password);

              $result = $stmt->execute();

              if($result) {
                echo "<script type='text/javascript'>swal('Success', 'User created successfully', 'success');</script>";
                header("Location: login.php");
                exit();
              } else {
                echo "<script type='text/javascript'>swal('Error', 'There was some error.', 'error');</script>";

              }

            }
        }


     ?>




    <div class="container">

      <h1>Registeration Form</h1>

      <hr class="mt-1 mb-3">

      <form action="register.php" method="post">

        <div class="form-group">

          <label for="firstname">First Name</label>
          <input type="text" name="firstname" class="form-control" placeholder="Enter First Name" required>
        </div>

        <div class="form-group">

          <label for="lastname">Last Name</label>
          <input type="text" name="lastname" class="form-control" placeholder="Enter Last Name" required>
        </div>

        <div class="form-group">

          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
        </div>

        <div class="form-group">

          <label for="contact">Contact</label>
          <input type="text" name="contact" class="form-control" placeholder="Enter your Contact Number" required>
        </div>

        <div class="form-group">

          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Enter your password here">
        </div>

        <hr class="mt-1 mb-3">

        <input type="Submit" class="btn btn-success btn-success w-100" id="register" name="signup" value="Sign Up">


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
