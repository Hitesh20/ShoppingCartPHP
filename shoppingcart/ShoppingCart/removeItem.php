<?php
  session_start();


  require_once('Configuration/dbConnection.php');

  $customer_id = $_SESSION["id"];

  $product_id = $_POST["product_id"];

  $quantity = $_POST["quantity"];

  $sql = "update Products set in_stock = in_stock + " . $quantity . " where id = " . $product_id . ";";
  $sql .= "delete from user_product where customer_id = " . $customer_id . " and product_id = " . $product_id . ";";


  if(mysqli_multi_query($conn, $sql)) {
    echo "success";
  } else {
    echo "error";
  }



















 ?>
