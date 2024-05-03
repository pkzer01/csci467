<html>
<body>

<title>New Quote</title>

<h1>Welcoming a New Customer</h1>

<?php
  include "connection.php";

  session_start();

  if(isset($_SESSION['userID'])){

        //get the session variable from login
        $userID = $_SESSION['userID'];
        $companyID = $_SESSION['customer'];

        $query = "SELECT name FROM customers WHERE id = :id;";
        $statement = $legacyPdo->prepare($query);
        $statement->execute(['id' => $companyID]);
        $company = $statement->fetchAll(PDO::FETCH_ASSOC)[0]["name"];
   }

  //instead of auto-filling field, make new quote
  echo "<h2>New Quote for: " . $company . " </h2>";
?>

<form method="POST" action="quote.php">


    <input type='text' name='price' placeholder='Price'/>

    <br/>
    <br/>


    <input type='text' name='discount' placeholder='Discount'>

    <br/>
    <br/>

    <input type='number' name='quantity' placeholder='Quantity'>

    <br/>
    <br/>

    <input type='text' name='status' placeholder='Status'/>

    <br/>
    <br/>

    <input type='text' name='itemNum' placeholder='Item number: ###-####'>

    <br/>
    <br/>

    <!-- Use the customer ID from the query to auto fill this field, if applicable -->
    <?php
      if(isset($_GET["CustomerID"])) {
        echo "<input readonly type='text' name='customerID' placeholder='CustomerID: ####' value='".$_GET["CustomerID"]."'/>";
      }
      else {
        echo "<input type='text' name='customerID' placeholder='CustomerID: ####'/>";
      }
    ?>
    

    <br/>
    <br/>


    <!-- This button hopefully is for the id + password -->
    <button type='submit' name='submit' value='submit'>ENTER QUOTE</button>

</form>

<?php

   //connect to the my(Ethan) DB
   include "connection.php";

 if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){

	//store the fields into some values
	$qID = $_POST['quoteID'];
	$price = $_POST['price'];
  $discount = $_POST['discount'];
	$status = $_POST['status'];
	$itemNum = $_POST['itemNum'];
  $quantity = $_POST['quantity'];
	$cID = $_POST['customerID'];

  include "connection.php"; // include database connection

  try {
    $query = "INSERT INTO Quotes (Prices, Discounts, SecretNotes, QuoteStatus, ItemNum, Quantity, SalesAssociateID, CustomerID)"
      ." VALUES (:price, :discount, :secret, :status, :itemNum, :quantity, :associateID, :customerID)";

      $statement = $pdo->prepare($query);
      $statement->execute([
        'price' => $price,
        'discount' => $discount,
        'secret' => '',
        'status' => $status,
        'itemNum' => $itemNum,
        'quantity' => $quantity,
        'associateID' => $_SESSION['userID'],
        'customerID' => $cID
      ]);

      if($statement->rowCount() == 1) {
        echo "Quote Created!";
      }
      else {
        echo "Quote Failed to Create...";
      }
    }
    catch(PDOException $e) {
      echo "Insert Failed: ".$e->getMessage();
    }
 }


?>

<a href="salesAssociate.php">back to associate page</a>


</body>
</html>
