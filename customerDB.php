<html>

<p>hello world</p>

<?php
   $hostname = 'blitz.cs.niu.edu';
   $port = 3306;
   $dbname = 'csci467';
   $username = 'student';
   $password = 'student';

   //connect to Customer DB/////////////////////////////////////////////
   $dsn = "mysql:host=$hostname;port=$port;dbname=$dbname";

   $options = [
     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
     PDO::ATTR_EMULATE_PREPARES   => false,
   ];

   try{

	$pdo = new PDO($dsn, $username, $password, $options);

   }catch (PDOException $e){

   die("<p>Connection to database failed: {$e->getMessage()}</p>\n");

   }
  /*********************************************************************/


  //get customer table data from Legacy DB
  $query = "SELECT * FROM customers";

   try{

	$statement = $pdo->prepare($query);
	$statement->execute();
	$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

   }catch (PDOException $e){

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


?>
</html>
