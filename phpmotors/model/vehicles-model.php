<?php

/*Vehicles model*/


// Add Vehicles Function
function addVehicle(){
    $db = phpmotorsConnect($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
    // SQL Statements
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
        VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
// Create the prepared statement using the php_motors connection
$stmt = $db->prepare($sql);
// Replace placeholders with values and type of data
$stmt->bindValue(':clientFirstname', $invMake, PDO::PARAM_STR);
$stmt->bindValue(':clientLastname', $invModel, PDO::PARAM_STR);
$stmt->bindValue(':clientEmail', $invDescription, PDO::PARAM_STR);
$stmt->bindValue(':clientPassword', $invImage, PDO::PARAM_STR);
$stmt->bindValue(':clientFirstname', $invThumbnail, PDO::PARAM_STR);
$stmt->bindValue(':clientLastname', $invPrice, PDO::PARAM_STR);
$stmt->bindValue(':clientEmail', $invStock, PDO::PARAM_STR);
$stmt->bindValue(':clientPassword', $invColor, PDO::PARAM_STR);
$stmt->bindValue(':clientPassword', $classificationId, PDO::PARAM_STR);

// Insert Data
$stmt->execute();

// Number of rows changed
$rowsChanged = $stmt->rowCount();
// Close database connection
$stmt->closeCursor();
// Return rows
return $rowsChanged;
}

// Add Classification Function
function addClass(){
    $db = phpmotorsConnect($classificationId, $classificationName);
    // SQL Statements
    $sql = 'INSERT INTO carclassification (classificationId, classificationName)
        VALUES (:classificationId, :classificationName)';
// Create the prepared statement using the php_motors connection
$stmt = $db->prepare($sql);
// Replace placeholders with values and type of data
$stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
$stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
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