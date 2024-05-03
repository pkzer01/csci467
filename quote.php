<html>
<body>

<title>New Quote</title>

<h1>Welcoming a New Customer</h1>

<p>z1918687</p>

<?php

  session_start();

  if(isset($_SESSION['userID'])){

        //get the session variable from login
        $userID = $_SESSION['userID'];
        $company = $_SESSION['customer'];

   }

  //instead of auto-filling field, make new quote
  echo "<h2>New Quote for: " . $company . " </h2>";
?>

<form method="POST" action="quote.php">

    <input type='text' name='quoteID' placeholder='QuoteID'>

    <br/>
    <br/>

    <input type='text' name='price' placeholder='Price'/>

    <br/>
    <br/>


    <input type='text' name='discount' placeholder='Discount'>

    <br/>
    <br/>

    <input type='text' name='status' placeholder='Status'/>

    <br/>
    <br/>

    <input type='text' name='itemNum' placeholder='Item number: ###-####'>

    <br/>
    <br/>

    <input type='text' name='customerID' placeholder='CustomerID: ####'/>

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
	$discount = $_POST['status'];
	$itemNum = $_POST['itemNum'];
	$cID = $_POST['customerID'];

 }


?>


<p> second half of this page does behind the scenes stuff and turns this into an order</p>

<a href="salesAssociate.php">back to associate page</a>


</body>
</html>
