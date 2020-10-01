<?php
  session_start();

  require_once('Configuration/dbConnection.php');
  require_once('navbar.php');
  if(isset($_SESSION["id"])) {
    $customer_id = $_SESSION["id"];
  }


  if(isset($_SESSION["id"]) && $_SESSION["is_user_logged_in"]) {

 ?>

 <!DOCTYPE html>
 <html>

  <head>
    <title>My Products</title>
    <link rel="stylesheet" type="text/css" href="css/userStyling.css"></link>

  </head>
  <body>
    <div class="container">

          <h1 class="text-center">My Products</h1>
          <hr class="mb-5">

    <?php

      $sql = "SELECT up.quantity, p.*  FROM user_product up inner join Products p on up.product_id = p.id where up.customer_id = " . $customer_id . ";";
      $result =  mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {



      ?>




    <div class='box bg-light'>
        <div class='row  '>

          <div class='col-sm-4'>
            <img class='card-img-top' src='<?php echo $row["image_url"]; ?>' alt='Product image' height='220px' width='80px'>
          </div>
            <div class='col-sm-3 float-sm-right m-auto'>
              <h3>Product Name</h3>
              <h4>Quantity<h4>
              <h4>Price<h4>
                <hr class="mb-2">
              <h4>Total<h4>
            </div>

            <div class='col-sm-3 m-auto'>
              <h3><?php echo $row["name"]; ?></h3>
              <h4><?php echo $row["quantity"];// . " ( " . $row["in_stock"] . " left) "; ?><h4>
              <h4>Rs. <?php echo $row["price"]; ?><h4>
                <hr class="mb-2">
              <h4><?php echo $row["quantity"] * $row["price"]; ?><h4>
            </div>

        </div>
        <div class='row'>
          <div class='col-sm-4'>


          </div>
          <div class='col-sm-8'>

            <input type="submit" value="Remove Product" id="removeProd" onclick="removeProduct(<?php echo $row["id"]; ?>, <?php echo $row["quantity"]; ?>)" class="btn btn-danger w-100">
          </div>
        </div>

    </div>

    <?php



          }

        }

    ?>
    <script type="text/javascript">

    function removeProduct(id, qty) {


      var formData = new FormData();
      formData.append("product_id", id );
      formData.append("quantity", qty);


      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {

        if(this.readyState == 4 && this.status==200) {
          if(this.responseText == 'success') {
            swal("Removed", "Product removed from your bag.","success").then( () => {
                location.href = 'user_products.php'
            });
          } else {
              swal("Error", "There is some error processing this request.", this.responseText);
          }

        }

      }

      xmlhttp.open("POST", "removeItem.php");
      xmlhttp.send(formData);

    }





    </script>


    <?php

      if(mysqli_num_rows($result) > 0) {

    ?>
      <!-- <input type="submit" value="Place Order" class="btn btn-success w-100 mb-5" style="margin: 20px;"> -->
    <?php
  } else {



    ?>

    <h1 class="text-muted text-center"> Your Bag is Empty.</h1>
    <?php

  }
} else {


    ?>
    <script type="text/javascript">

    swal('Unauthorized', 'Please login first to access that page.','error').then( () => {
        location.href = 'login.php'
    });
    </script>

  <?php


  }
  ?>








  </body>
 </html>
