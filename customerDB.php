<html>

<?php
   include "header.php";     // include page header
   include "connection.php"; // include database connections

   //get customer table data from Legacy DB
   $query = "SELECT * FROM customers";

   try {
	   $statement = $legacyPdo->prepare($query);
	   $statement->execute();
	   $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
   } catch (PDOException $e) {
     die("<p> Query failed: {$e->getMessage()}</p>\n");
   }

   //make customer table
   echo "<table border='1'>";
   echo "<tr><th>ID</th><th>Name</th><th>City</th><th>Street</th><th>Contact</th></tr>";
   foreach ($rows as $row) {
      echo "<tr>";
      echo "<td>".$row['id']."</td>";
      echo "<td>".$row['name']."</td>";
      echo "<td>".$row['city']."</td>";
      echo "<td>".$row['street']."</td>";
      echo "<td>".$row['contact']."</td>";
      echo "</tr>";
   }

   echo "</table>";

   include "footer.php" // include page footer
?>
</html>
