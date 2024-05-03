<html>
<head>
<title>Orders - Quotes Daily</title>
</head>
<?php
   include "header.php";
   include "connection.php";

   //get order table data from the database
   $query = "SELECT * FROM OrderInfo LEFT JOIN Quotes on OrderInfo.QuoteID = Quotes.QuoteID";

   try {
	   $statement = $pdo->prepare($query);
	   $statement->execute();
	   $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
   } catch (PDOException $e) {
     die("<p> Query failed: {$e->getMessage()}</p>\n");
   }

   //get customer table data from the legacy database
   $query = "SELECT * FROM customers";

   try {
      $statement = $legacyPdo->prepare($query);
      $statement->execute();
      $customers = $statement->fetchAll(PDO::FETCH_ASSOC);
   } catch(PDOException $e) {
      die("<p> Customer Query failed: {$e->getMessage()}</p>");
   }

   //make order table
   echo "<table border='1'>";
   echo "<tr>";
   echo "<th style='width: 100px'>Order ID</th>";
   echo "<th style='width: 150px'>Customer</th>";
   echo "<th style='width: 100px'>Status</th>";
   echo "<th style='width: 150px'>Item</th>";
   echo "<th style='width: 100px'>Order Qty</th>";
   echo "<th style='width: 100px'>Price</th>";
   echo "<th style='width: 100px'>Discount</th>";
   echo "<th style='width: 150px'>Total Price</th>";
   echo "</tr>";
   foreach ($rows as $row) {
      // find the customer for this order
      $customer = null;
      foreach($customers as $cust) {
         if($cust->id == $row->CustomerID) {
            $customer = $cust;
            break;
         }
      }
      echo "<tr class='detail-row'>";
      echo "<td>".$row['PurchaseID']."</td>";
      echo "<td>".$customer['name']."</td>";
      echo "<td>".$row['OrderStatus']."</td>";
      echo "<td>".$row['ItemNum']."</td>";
      echo "<td>".$row['OrderQuant']."</td>";
      echo "<td>$".$row['Prices']."</td>";
      echo "<td>$".$row['Discounts']."</td>";
      echo "<td>$".($row['Prices'] * $row['OrderQuant']) - $row['Discounts']."</td>";
      echo "</tr>";
   }

   echo "</table>";

   include "footer.php"
?>
</html>
