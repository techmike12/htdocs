<?php

/*Accounts model*/


// Register a new client
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    $db = phpmotorsConnect();
    // SQL Statements
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
// Create the prepared statement using the php_motors connection
$stmt = $db->prepare($sql);
// Replace placeholders with values and type of data
$stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
$stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
$stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
$stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
// Insert Data
$stmt->execute();

// Number of rows changed
$rowsChanged = $stmt->rowCount();
// Close database connection
$stmt->closeCursor();
// Return rows
return $rowsChanged;
}
?>