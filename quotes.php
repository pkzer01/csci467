<html>
<body>
<h1>Welcoming a New Customer</h1>

<br/>
<br/>

<p>so this page will be make new entries into the quote table</p>

<br/>

<p>currently that table is defined as the following: CREATE TABLE Quotes (<br/>
    QuoteID INT NOT NULL AUTO_INCREMENT,<br/>
    Prices FLOAT,<br/>
    Discounts FLOAT,<br/>
    SecretNotes VARCHAR(100),<br/>
    QuoteStatus VARCHAR(10),<br/>
    ItemNum VARCHAR(100),<br/>
    Quantity FLOAT,<br/>
    SalesAssociateID INT REFERENCES SalesAssociates(SalesAssociateID),<br/>
    CustomerID FLOAT,<br/>
    PRIMARY KEY(QuoteID)<br/>
);</p>

<?php

  session_start();

  if(isset($_SESSION['userID'])){

        //get the session variable from login
        $userID = $_SESSION['userID'];
        $company = $_SESSION['customer'];

   }

  echo "<p> Currently, based on how i have pages set up. Session variables of the sales associate signed in + the company that is getting a quote get carried</p>";
  echo "<br/>";
  echo "<p>into this new page: </p>";
  echo "<br/>";

  echo $userID . " " . $company
?>


<p>My thought process is to have the company + sales id auto fill in the "report"</p>
<br/>
<p>all that report will be is a series of text boxes in a form</p>
<br/>
<p>and once you hit submit it will insert that row into the Quotes Table</p>

<br/>
<p>the syntax for that should be like: INSERT INTO Quotes (col1,col2,col3...) VALUES(col1,col2,col3...)</p>
<br/>
<p>remember that if something is a varchar that it is to be put in single quotes('')</p>

<a href="salesAssociate.php">back to associate page</a>


</body>
</html>
