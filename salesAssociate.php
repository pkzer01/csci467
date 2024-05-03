<html>

<head>
<title>Associate Page</title>
</head>

<body>

<?php
  include "header.php"; // include page header
  include "connection.php"; //connect to DB

  session_start();

  if(isset($_SESSION['userID'])){

	//get the session variable from login
	$userID = $_SESSION['userID'];
	$userPass = $_SESSION['password'];

  $query = "SELECT AssociateName FROM SalesAssociates WHERE SalesAssociateID=:userID AND AssociatePass=:password";

  //execute the query
  $statement = $pdo->prepare($query);
  $statement->bindParam(':userID', $userID);
  $statement->bindParam(':password', $userPass);
  $statement->execute();

  //if success
  if($statement->rowCount() > 0){

   //get the user's name in order to display it
   $result = $statement->fetch(PDO::FETCH_ASSOC);

   //store that name
   $NAME = $result['AssociateName'];

   //display the user's name
   echo "WELCOME: " . $NAME;
  }else{

    echo "nothing returned";

  }
 }

?>

<br/>

<h2>Create new quote for Customer:</h2>

<?php
    include "connection.php";
    /////////////////////////////////////////////////////////////////////////////
    ///still want to make drop down menu of quotes
    $query = "SELECT id, name FROM customers"; //selecting name from classDB

    $statement = $legacyPdo->prepare($query);
    $statement->execute();
    $customers = $statement->fetchAll(PDO::FETCH_ASSOC);
    $rowCount  = $statement->rowCount();


    echo "<form method='POST' action=salesAssociate.php>";
    echo "<label for='customer'>Customers List: </label>";
    echo "<select name='customer'>";

    echo "<option value=0>--SELECT A CUSTOMER--</option>";

    foreach($customers as $customer){
    echo "<option value='" . htmlspecialchars($customer['id']) . "'>";

    echo htmlspecialchars($customer['name']);

    echo "</option>";
    }

    echo "</select>";

    echo"	";
    //<!--submit button-->
    echo"<input type='submit' value='NEW QUOTE'>";

    echo"<br/>";

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["customer"])){


      $_SESSION['customer'] = $_POST['customer'];

      echo"<script>window.location.href = 'quote.php?CustomerID=".$_POST['customer']."';</script>";

      }

    echo "NUMBER OF CUSTOMERS: " . $rowCount;
?>


<br/>
<br/>

<?php
   include "connection.php"; // include database connections
/////////////////////////////////////////////////////////////////////////////

   $query = 'SELECT * FROM Quotes WHERE SalesAssociateID =:userID';

  //run the query to get the quotes of the current user
   try{

	    $statement = $pdo->prepare($query);
	    $statement->bindParam(':userID', $userID);
	    $statement->execute();
	    //fetch all the returns
	    $rows = $statement->fetchALL(PDO::FETCH_ASSOC);
   }catch(PDOException $e){

      die("<p>Query failed: {$e->getMessage()}</p>\n");

  }

  echo "<h2>$NAME's current quotes: </h2>";

  echo"<table border=1 cellspacing='100'>";
  echo '<tr>';

  foreach (array_keys($rows[0]) as $heading) {
    echo "<td style='padding: 10px;'><strong>$heading<strong></td>";
  }


  foreach($rows as $row){
       echo "<tr>";

      foreach($row as $col){ echo "<td>$col</td>\n";}

        echo"</tr>";
  }

 echo "<tr>";
 echo "</table>";
?>

<br/>

</body>

</html>
