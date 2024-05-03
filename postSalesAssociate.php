<?php
    include "connection.php";

    // decode the JSON POST data
    $_POST = json_decode(file_get_contents('php://input'), true);

    // user is deleting a sales associate
    if(isset($_POST["delete"])) {
        try {
            // query quotes for this sales associate
            $query = "SELECT QuoteID FROM Quotes WHERE SalesAssociateID = :id;";
            $statement = $pdo->prepare($query);
            $statement->bindParam(":id", $_POST["delete"]);
            $statement->execute();
            $quotes = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach($quotes as $quote) {
                // delete orders made with quotes from this sales associate
                $query = "DELETE FROM OrderInfo WHERE QuoteID = :id;";
                $statement = $pdo->prepare($query);
                $statement->bindParam(":id", $quote["QuoteID"]);
                $statement->execute();
            }

            // delete the quotes from this sales associate
            $query = "DELETE FROM Quotes WHERE SalesAssociateID = :id;";
            $statement = $pdo->prepare($query);
            $statement->bindParam(":id", $_POST["delete"]);
            $statement->execute();

            // delete the sales associate
            $query = "DELETE FROM SalesAssociates WHERE SalesAssociateID = :id;";
            $statement = $pdo->prepare($query);
            $statement->bindParam(":id", $_POST["delete"]);
            $statement->execute();

            // make sure the query was successfull
            if($statement->rowCount() == 1) {
                echo "Sales Associate Deleted";
            }
            else 
                echo "Failed to delete sales associate";
        } catch (PDOException $e) {
            echo "DELETE failed: {$e->getMessage()}";
        }
    }
    else if(
        isset($_POST["SalesAssociateID"])
        && isset($_POST["CommissionRate"])
        && isset($_POST["AssociateName"])
        && isset($_POST["AssociatePhone"])
        && isset($_POST["AssociateEmail"])
    ) {
        // update an existing sales assocate
        try {
            $query = "UPDATE SalesAssociates SET CommissionRate = 2.33, AssociateName = :name, AssociatePhone = :phone, AssociateEmail = :email WHERE SalesAssociateID = :id;";
            $statement = $pdo->prepare($query);
            //$statement->bindParam(":comm", $_POST["ComissionRate"]);
            $statement->bindParam(":name", $_POST["AssociateName"]);
            $statement->bindParam(":phone", $_POST["AssociatePhone"]);
            $statement->bindParam(":email", $_POST["AssociateEmail"]);
            $statement->bindParam(":id", $_POST["SalesAssociateID"]);
            $statement->execute();

            if($statement->rowCount() == 1) {
                echo "Sales Associate Updated";
            }
            else {
                echo "Sales Associate Failed To Update";
            }
        } 
        catch(PDOException $e) {
            echo "UPDATE failed: {$e->getMessage()}";
        }
    }
    else {
        echo "Invalid POST data";
    }
?>