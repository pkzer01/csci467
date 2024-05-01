<html>

<head>
<title>Associate Page</title>
</head>

<body>

<?php
  include "header.php"; // include page header

  session_start();

  if(isset($_SESSION['userID'])){

	//get the session variable from login
	$userID = $_SESSION['userID'];
	$userPass = $_SESSION['password'];

  include "connection.php"; // include database connections

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
    include "connection.php";
    /////////////////////////////////////////////////////////////////////////////
    ///still want to make drop down menu of quotes
    $query = "SELECT name FROM customers"; //selecting name from classDB

    $statement = $legacyPdo->prepare($query);
    $statement->execute();
    $customers = $statement->fetchAll(PDO::FETCH_ASSOC);
    $rowCount  = $statement->rowCount();


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

    echo"when button pressed --> new quote page";
    echo"<br/>";
    echo"when going bring the name of the company, to pull info again if need be";

    echo "<br/>";

    echo "NUMBER OF CUSTOMERS: " . $rowCount;

// close connection
    $pdo = null;
?>


<br/>
<br/>

<p>--------------------------------------------------------------</p>

<p> display the current quotes that an associate has</p>
<?php
   include "connection.php"; // include database connections
/////////////////////////////////////////////////////////////////////////////

   echo"Here I want to make a table of the quote DB based on current user";
   echo"<br/>";
   echo"SELECT * FROM quoteTable WHERE associateID=userID";
  include "footer.php"; // include page footer
?>

<br/>

</body>

</html>
