<html>
<!-- THIS IS WHERE LOGIN BOXES WILL BE -->
<head><title>Quote Site Login</title></head>

<!-- begin styling the login page -->
<style>
   body{
	background-color: navy;
	margin: 0;
	padding: 0;
	font-famil: Arial, sans-serif;
	line-height: 2;
   }

   header{
	background-color: floralwhite;
	color: black;
	text-align: center;
	padding: 10px;
   }

   .container{
	margin-top: 50px;

   }

  .loginsign{
	text-align: center;
	color: floralwhite;
  }
</style>

<body>

  <header><h1>Welcome to Quotes Daily</h1></header>

  <div class="loginsign">
  <h1>Login Associate!!</h1>
  </div>

<div class="container">
  <div class="row justify-content-center">
   <div class="col-md-6-col-md-offset-3" align="center">
   <form method="POST" action="login.php">

    <input type='text' name='userID' placeholder='userID'>

    <br/>
    <br/>

    <input type='password' name='password' placeholder='password'/>

    <br/>
    <br/>

    <!-- This button hopefully is for the id + password -->
    <button type='submit' name='submit' value='submit'>LOGIN</button>


   </form>

  </div>

</div>


<br/>
<br/>

</body>

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


//	Trying to check the user and password		//
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){

  //store user and password
  $USER = $_POST["userID"];
  $PASS = $_POST["password"];

  //query to get everything from a row where the user is found
  $query = "SELECT * FROM SalesAssociates WHERE salesAssociateID=:userID AND AssociatePass=:password ";

  //execute the query
  $statement = $pdo->prepare($query);
  $statement->bindParam(':userID', $USER);
  $statement->bindParam(':password', $PASS);
  $statement->execute();


  //login success --> redirect page, else failure

  if($statement->rowCount() > 0){

	//start session, this allows to remember who logged in
	session_start();

	//store the session variable
	$_SESSION['userID'] = $USER;
	$_SESSION['password'] = $PASS;

	//possibly use different if statements for diff pages
	//redirect using javascript
	echo"<script>window.location.href = 'salesAssociate.php';</script>";
	exit();


  }else{

	echo "invalid userID or password";

  }

}


?>

</html>
