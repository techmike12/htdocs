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
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);

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

// Get vehicle information by invId
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }

// Updating Vehicles Function
function updateVehicle($invMake, $invModel, $invDescription, $invImage,  $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
  }

// Delete Vehicles Function
function deleteVehicle($invId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
  }

// Get list of vehicles by classification
function getVehiclesByClassification($classificationName) {
    $db = phpmotorsConnect();
    $sql = 'SELECT inventory.invId, invModel, invDescription, invPrice, invStock, invColor, imgId, imgPath, invMake, imgName, imgPrimary FROM inventory JOIN images ON inventory.invId = images.invId WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}

// Get vehicle details from invID
function getVehicleById($invId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT inventory.invId, invModel, invDescription, invPrice, invStock, invColor, imgId, imgPath, invMake, imgName, imgPrimary FROM inventory JOIN images ON inventory.invId = images.invId WHERE inventory.invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $vehicleDetail = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicleDetail;
}

// Get information for all vehicles
function getVehicles() {
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}
?>