<html>
<!-- THIS IS WHERE LOGIN BOXES WILL BE -->
<head>
<title>Quote Site Login</title>
</head>


<body>
  <h1>Welcome to Quotes Daily</h1>
</body>

<form>

  <label for='UserID'>User ID: </label>
  <input type='text' id='UserID' name='UserID'>

  <br/>
  <br/>

  <label for='Password'>Password: </label>
  <input type='text' id='password' name='Password'>

  <br/>
  <br/>

  <!-- This button hopefully is for the id + password -->
  <button type='submit'>SUBMIT</button>

</form>

<br/>
<br/>
<a href=''> CLICK HERE TO REGISTER AS NEW CUSTOMER </a>

<br/>

<?php
echo 'this page should check 2 things: 1) username 2)password';

echo '<br/>';

echo 'check against a table in our DB';

echo '<br/>';

echo 'then i want to include something that lets a new customer sign up';
?>

</html>
