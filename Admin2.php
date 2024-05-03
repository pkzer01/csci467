<?php
  include "header.php";
?>

<html> 
    <head>
        <title>  Admin Page  </title>
    </head>
 				
<body style="background-color:ffd1df;">
<h1 style="color:blue; text-align: center;">Sales Associate Information</h1>


 <?php
  include "connection.php";
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
	 echo "<td>$col</td>\n";
	} 
//adding buttons to tabel
echo "<td><button onclick='editRow(this)'>Edit</button><button onclick='confirmDelete(this)'>Delete</button></td>";
  echo "</tr>";
} 
echo "</table>";

echo "<button onclick='addAssociate()'>Add Associate</button>"; 
//button functionalities java
include "footer.php";
echo "<script>
    function confirmDelete(button) {
        if (confirm('Are you sure you want to delete this employee?')) {
            var row = button.parentNode.parentNode;
            var cells = row.querySelectorAll('td');
            const id = cells[0].innerText;
            
            // delete on server
            fetch('./postSalesAssociate.php', {
              method: 'POST',
              headers: {'Content-Type': 'application/json'},
              body: JSON.stringify({ delete: id })
            }).then(res => {
              res.text().then(data => {
                alert(data);
                if(data == 'Sales Associate Deleted')
                  row.parentNode.removeChild(row);
              })
            })
        }
     }
     function editRow(button) {
        var row = button.parentNode.parentNode;
        var cells = row.querySelectorAll('td');
        for (var i = 1; i < cells.length - 1; i++) { // Exclude action column and ID column (primary key cannot be edited)
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
        var id = cells[0].innerHTML; // store ID
        for (var i = 1; i < cells.length - 1; i++) { // Exclude action column and ID column
            newData.push(cells[i].querySelector('input').value);
            cells[i].innerHTML = cells[i].querySelector('input').value;
        }

        var saveButton = row.querySelector('button:nth-of-type(1)');
        saveButton.innerHTML = 'Edit';
        saveButton.setAttribute('onclick', 'editRow(this)');
        // send the data to the server
        fetch('./postSalesAssociate.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify({
            SalesAssociateID: id,
            CommissionRate: newData[0],
            AssociateName: newData[1],
            AssociatePhone: newData[2],
            AssociateEmail: newData[3],
            AssociatePass: newData[4]
          })
        }).then(res => {
          res.text().then(data => {
            alert(data);
          })
        })
       }
function addAssociate() {
       var newRow = document.createElement('tr');
       newRow.innerHTML = '<td><input type=\"text\"></td>' + 
                           '<td><input type=\"text\"></td>' + 
                           '<td><input type=\"text\"></td>' + 
                           '<td><input type=\"text\"></td>' + 
                           '<td><input type=\"text\"></td>' + 
                           '<td><input type=\"password\"></td>' + 
                           '<td><button onclick=\"saveNewAssociate(this)\">Save</button></td>'; 
  document.querySelector('table tbody').appendChild(newRow);
}

function saveNewAssociate(button) {
        var row = button.parentNode.parentNode;
        var inputs = row.querySelectorAll('input[type=\"text\"], input[type=\"password\"]');
        var newRow = document.createElement('tr');
        inputs.forEach(function(input) {
            var cell = document.createElement('td');
            cell.textContent = input.value;
            newRow.appendChild(cell);
        });
        var actionCell = document.createElement('td');
        actionCell.innerHTML = '<button onclick=\"editRow(this)\">Edit</button>' +
                               '<button onclick=\"confirmDelete(this)\">Delete</button>';
        newRow.appendChild(actionCell);
        document.querySelector('table tbody').appendChild(newRow);
        row.parentNode.removeChild(row);
    }


</script>";
?>

</body>
</html>





