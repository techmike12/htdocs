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


// Check for existing email address
function checkExistingEmail($clientEmail) {
    $db = phpmotorsConnect();
    // SQL Statement
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    // Create the prepared statement
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if(empty($matchEmail)){
     return 0;
    } else {
     return 1;
    }
}

// Get client data based on an email address
function getClient($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
   }
?>