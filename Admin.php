<!DOCTYPE html>
<html>
<head>
    <title>Associate Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
       .btn-edit {
           background-color: #4CAF50;
            color: white;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>

<?php
// Your database connection code here
$servername = 'course';
$username = 'z1915336';
$password = '2003Jun21';
$database = 'z1915336';

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
////////////////////n
$query = "SELECT AssociateName FROM SalesAssociates WHERE SalesAssociateID=:userID AND AssociatePass=:password";

$result = $conn->query($sql);


// Display customer information in a table
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>USER-ID</th><th>Password</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["AssociateName"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["SalesAssociateID"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["AssociatePass"]) . "</td>";
        echo "<td><button class=\"btn btn-edit\">Edit</button> <button class=\"btn btn-delete\">Delete</button></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>

