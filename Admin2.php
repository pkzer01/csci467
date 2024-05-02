<html> 
    <head>
        <title> 
                Admin Page              
        </title>
</head>
 				
<body style="background-color:ffd1df;">   
<h1>Associate Information </h1>
</body>

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
	echo "<td style='padding: 10px;'><strong>Action</strong></td>";
 	echo '</tr>';

  foreach($rows as $row){
      echo "<tr>";
			
     foreach($row as $col){
	 echo "<td>$col</td>\n";}
echo "<td><button onclick='editRow(this)'>Edit</button><button onclick='confirmDelete(this)'>Delete</button></td>";
  echo "</tr>";
} 
echo "</table>";
 
//button functionalities
echo "<script>
    function confirmDelete(button) {
        if (confirm('Are you sure you want to delete this employee?')) {
            var row = button.parentNode.parentNode;
	    row.parentNode.removeChild(row);
        }
     }

     function editRow(button) {
        var row = button.parentNode.parentNode;
        var cells = row.querySelectorAll('td');
        for (var i = 0; i < cells.length - 1; i++) { // Exclude action column
            var value = cells[i].innerText;
            cells[i].innerHTML = '<input type=\"text\" value=\"' + value + '\">';
        }
        var editButton = row.querySelector('button:nth-of-type(1)');
        editButton.innerHTML = 'Save';
        editButton.setAttribute('onclick', 'saveRow(this)');
     }


     function saveRow(button) {
        var row = button.parentNode.parentNode;
        var cells = row.querySelectorAll('td');
        var newData = [];
        for (var i = 0; i < cells.length - 1; i++) { // Exclude action column
            newData.push(cells[i].querySelector('input').value);
            cells[i].innerHTML = cells[i].querySelector('input').value;
        }
        var saveButton = row.querySelector('button:nth-of-type(1)');
        saveButton.innerHTML = 'Edit';
        saveButton.setAttribute('onclick', 'editRow(this)');
     }
</script>";
?>







</body>
</html>





