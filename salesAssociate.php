<html>

<head>
<title>Associate Page</title>
</head>

<body>
<br/>

<?php

  session_start();

  if(isset($_SESSION['userID'])){

	//get the session variable from login
	$userID = $_SESSION['userID'];
	$userPass = $_SESSION['password'];
  
//////////////////////// Connect to DB to display name //////////////////////
  $hostname = 'courses';
  $dbname = 'z1918687';
  $username = 'z1918687';
  $passwrd = '2002Dec11';

  $dsn = "mysql:host=$hostname;dbname=$dbname";

  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  try {

        $pdo = new PDO($dsn, $username, $passwrd, $options);

  } catch (PDOException $e){

   die("<p>Connection to database failed: {$e->getMessage()}</p>\n");

  }
////////////////////////////////////////////////////////////////////////////

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

  $pdo = null;

?>

<br/>

<h2>Create new quote for Customer:</h2>

<?php
//////////////////////  CONNECT TO THE CUSTOMER DB /////////////////////////
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
/////////////////////////////////////////////////////////////////////////////
   ///still want to make drop down menu of quotes
    $query = "SELECT name FROM customers"; //selecting name from classDB

    $statement = $pdo->prepare($query);
    $statement->execute();
    $customers = $statement->fetchAll(PDO::FETCH_ASSOC);
    $rowCount  = $statement->rowCount();


    echo "<form method='POST' action=salesAssociate.php>";
    echo "<label for='customer'>Customers List: </label>";
    echo "<select name='customer'>";

    echo "<option value=0>-- SELECT A CUSTOMER --</option>";

    foreach($customers as $customer){
    echo "<option name='customer' value='" . htmlspecialchars($customer['name']) . "'>";

    echo htmlspecialchars($customer['name']);

    echo "</option>";
    }

    echo "</select>";

    echo"	";
    //<!--submit button-->
    echo"<input type='submit' value='NEW QUOTE'>";

    echo "</form>";

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["customer"])){


      $_SESSION['customer'] = $_POST['customer'];

      echo"<script>window.location.href = 'quote.php';</script>";

      }

    echo "<br/>";

    echo "NUMBER OF CUSTOMERS: " . $rowCount;

// close connection
    $pdo = null;
?>


<br/>

<h1>Current quotes: </h1>

<?php


//start the sql session /////////////////////////////////////////////////////
  $hostname = 'courses';
  $dbname = 'z1918687';
  $username = 'z1918687';
  $passwrd = '2002Dec11';

  $dsn = "mysql:host=$hostname;dbname=$dbname";

  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  try {

        $pdo = new PDO($dsn, $username, $passwrd, $options);

  } catch (PDOException $e){

   die("<p>Connection to database failed: {$e->getMessage()}</p>\n");

  }
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

  echo"<table border=1>";
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


<a href="login.php">logout</a>


</body>

</html>
