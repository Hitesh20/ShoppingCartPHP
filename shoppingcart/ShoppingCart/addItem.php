<?php
  session_start();


  require_once('Configuration/dbConnection.php');

  $product_id = $_GET["id"];

  $customer_id = $_SESSION["id"];

  $sql3 = "select in_stock from Products where id = " . $product_id . " and in_stock > 0;";
  $result2 = mysqli_query($conn, $sql3);

  if(mysqli_num_rows($result2) > 0) {
    $sql = "select * from user_product where customer_id = ? and product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $customer_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) {

      while($row = $result->fetch_assoc()) {
        $quantity = $row["quantity"] + 1;

        $sql2 = "update user_product set quantity = '" . $quantity . "' where customer_id = '" . $customer_id . "' and product_id = '" . $product_id . "';";
        $sql2 .= "update Products set in_stock = in_stock - 1 where id = '" . $product_id . "';";

        if(mysqli_multi_query($conn, $sql2)) {
          echo "success";
        } else {
          echo "";
        }


      }
    } else {
      $quantity = 1;
      $sql = "Insert into user_product (customer_id, product_id, quantity) values (?,?,?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("iii", $customer_id, $product_id, $quantity);
      $result = $stmt->execute();
      $sql = "update Products set in_stock = in_stock - 1 where id = '" . $product_id . "';";
      if(mysqli_query($conn, $sql)) {
        echo "success";
      } else {
        echo "something";
      }

    }
  } else {
    echo "error";
  }



















 ?>
