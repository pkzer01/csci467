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
<p>here should be a drop menu that is filled with the names of customers from the legacyDB</p>


<?php
///////////////////////  CONNECT TO THE CUSTOMER DB /////////////////////////
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


    echo "<form method='POST' action=salesAssociate.php>";
    echo "<label for='customer'>Customers List: </label>";
    echo "<select name='customer'>";

    echo "<option value=0>--SELECT A CUSTOMER--</option>";

    foreach($customers as $customer){
    echo "<option value='" . htmlspecialchars($customer['name']) . "'>";

    echo htmlspecialchars($customer['name']);

    echo "</option>";
    }

    echo "</select>";

    echo"	";
    //<!--submit button-->
    echo"<input type='submit' value='NEW QUOTE'>";

    echo "</form>";

?>

<br/>
<p>show total number of customers</b>

<br/>
<br/>

<p>--------------------------------------------------------------</p>

<p> display the current quotes that an associate has</p>
<br/>
<p> should show the customer + how much, and then a button to edit the entire quote </p>
</body>

</html>
