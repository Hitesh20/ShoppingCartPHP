<?php
  session_start();

  require_once('Configuration/dbConnection.php');
  require_once('navbar.php');

  if(isset($_SESSION['is_user_logged_in'])) {



 ?>

 <!DOCTYPE html>
<html>
<head>

<title>Home</title>
</head>
<body>

  <div class="container">

    <div class="row">
<div class="d-flex flex-wrap mt-4">
      <?php

      $sql = "select * from Products";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          if($row['description'] == NULL) {
            $row['description'] = "No description attached";
          }
          ?>

          <div class="col-sm-4">

            <div class='d-flex flex-wrap'>
              <div class='card m-2' style="height:550px;">
                <img class='card-img-top p-3' src='<?php echo $row['image_url']; ?>' alt='Product image' height='350px' width='270px'>
                <div class='card-body'>
                  <h4 class='card-title'><?php echo $row['name']; ?> <!--(<?php // echo $row['in_stock'] ?> left)--></h4>
                  <div style='height:50px;>
                    <p class='card-text'><?php echo $row['description']; ?></p>
                  </div>
                  <b>Rs. <?php echo $row['price'];?></b><br>
                  <button class='btn btn-primary' id='order' onclick='addToBag(<?php echo $row['id'];?>)'>Add to Cart</button>
                </div>
              </div>
            </div>
          </div>

          <?php

        }
      } else {
        echo "0 results";
      }

      ?>


  </div>

  <script type="text/javascript">

    function addToBag(id) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {

        if(this.readyState == 4 && this.status==200) {
          if(this.responseText == 'success') {
            swal("Added", "Product added to your bag.", this.responseText);
          } else if(this.responseText == 'error'){
              swal("Error", "Product is Out of Stock.", this.responseText);
          } else {
              swal("Invalid Credentials", "Please login first to buy products.", "error");
          }
          // swal("SOMETHING", this.responseText, "success");

        }

      }

      xmlhttp.open("GET", "addItem.php?id=" + id, true);
      xmlhttp.send();


    }

  </script>



  </div>
</div>
    <?php

    } else {
    ?>
    <script type="text/javascript">

      swal('Unauthorized', 'Please login first.','error').then( () => {
          location.href = 'login.php'
      });
    </script>

    <?php


      }
    ?>

</body>
</html>
