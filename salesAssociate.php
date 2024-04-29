<html>

<head>
<title>Associate Page</title>
</head>

<body>
<p> The webpage header should display whoever is logged in name</p>

<br/>

<?php

  session_start();

  if(isset($_SESSION['userID'])){

	//get the session variable from login
	$userID = $_SESSION['userID'];
	$userPass = $_SESSION['password'];

	echo "<p> userID: $userID  userpass: $userPass</p>";

  }

?>

<br/>

<h2>Create new quote for Customer:</h2>
<p>here should be a drop menu that is filled with the names of customers from the legacyDB</p>
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
