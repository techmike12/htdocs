<?php

/*Vehicles model*/


// Add Vehicles Function
function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId){
    $db = phpmotorsConnect();
    // SQL Statements
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
        VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
// Create the prepared statement using the php_motors connection
$stmt = $db->prepare($sql);
// Replace placeholders with values and type of data
$stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
$stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
$stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
$stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
$stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
$stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
$stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
$stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
$stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);

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
function addClass($classificationName){
    $db = phpmotorsConnect();
    // SQL Statements
    $sql = 'INSERT INTO carclassification (classificationName)
        VALUES (:classificationName)';
// Create the prepared statement using the php_motors connection
$stmt = $db->prepare($sql);
// Replace placeholders with values and type of data
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

// Get vehicles by classificationId
function getInventoryByClassification($classificationId){
    $db = phpmotorsConnect();
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
   }
?>