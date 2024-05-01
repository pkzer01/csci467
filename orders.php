<html>

<?php
   include "header.php";
   include "connection.php"; // include database connection from connection.php

   //get customer table data from Legacy DB
   $query = "SELECT * FROM OrderInfo LEFT JOIN Quotes on OrderInfo.QuoteID = Quotes.QuoteID";

   try {
	   $statement = $pdo->prepare($query);
	   $statement->execute();
	   $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
   } catch (PDOException $e) {
     die("<p> Query failed: {$e->getMessage()}</p>\n");
   }

   //make order table
   echo "<table border='1'>";
   echo "<tr><th>ID</th><th>Status</th><th>Item</th><th>Order Qty</th><th>Price</th><th>Discount</th></tr>";
   foreach ($rows as $row) {
       echo "<tr class='detail-row'>";
       echo "<td>".$row['PurchaseID']."</td>";
       echo "<td>".$row['OrderStatus']."</td>";
       echo "<td>".$row['ItemNum']."</td>";
       echo "<td>".$row['OrderQuant']."</td>";
       echo "<td>".$row['Prices']."</td>";
       echo "<td>".$row['Discounts']."</td>";
       echo "</tr>";
   }

   echo "</table>";

   include "footer.php"
?>
</html>
