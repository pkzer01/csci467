<html> 
    <head>
        <title> 
                Admin Page              
        </title>
</head>
 				
<body style="background-color:ffd1df;">   
<h1>Associate Information </h1>
</body>
//----------------displaying associate data in table
 <?php
$hostname = 'courses';
  $dbname = 'z1918687';
  $username = 'z1918687';
  $password = '2002Dec11';


  $dsn = "mysql:host=$hostname;dbname=$dbname";

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
  //showing the inventory and everything in it

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $deleteQuery = "DELETE FROM SalesAssociates WHERE userID = :id";
    $deleteStatement = $pdo->prepare($deleteQuery);
	 
    $userID = $_POST['delete_id'];
    echo "debug statement";

    $deleteStatement->bindParam(':id', $userID);

    try {
        $deleteStatement->execute();
        // Redirect back to the page to refresh the table
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } catch (PDOException $e) {
        die("<p>Deletion failed: {$e->getMessage()}</p>\n");
    }
}

  $query = 'SELECT * FROM SalesAssociates';

  try{
        $statement = $pdo->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

  }catch(PDOException $e){

        die("<p>Query failed: {$e->getMessage()}</p>\n");
  }

  //table for inventory

  echo"<table border=1>";
  echo '<tr>';
					
 foreach (array_keys($rows[0]) as $heading) {
    echo "<td style='padding: 10px;'><strong>$heading<strong></td>";
  }

  foreach($rows as $row){
      echo "<tr>";

     foreach($row as $col){ echo "<td>$col</td>\n";}
 
	echo "<td><button class='btn btn-edit'>Edit</button></td>";
//        echo "<td><button class='btn btn-delete'>Delete</button></td>";
echo "<td>
            <form method='post' action='{$_SERVER['PHP_SELF']}' style='display: inline;'>
                <input type='hidden' name='delete_id' value='{$row['userID']}'>
                <button type='submit'>Delete</button>
            </form>
	</td>"; 
       echo"</tr>";
  }
 
  echo "</tr>"; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $deleteQuery = "DELETE FROM SalesAssociates WHERE userID = :id";
    $deleteStatement = $pdo->prepare($deleteQuery);
	 
    $userID = $_POST['delete_id'];
    echo "debug statement";

    $deleteStatement->bindParam(':id', $userID);

    try {
        $deleteStatement->execute();
        // Redirect back to the page to refresh the table
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } catch (PDOException $e) {
        die("<p>Deletion failed: {$e->getMessage()}</p>\n");
    }
}


?>


//-------------------------------------------------------
<p>INSERT INTO SalesAssociates(col1,col2,col3...) VALUES (userID,valCol2,'password'...,)</p>
</body>
</html>

