<?php
# Reviews Model

# Add Review
function addReview($invId, $clientId, $revText){
    $db = phpmotorsConnect();

    $sql = 'INSERT INTO reviews (invId, clientId, revText)
        VALUES (:invId, :clientId, :revText)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    $stmt->bindValue(':revText', $revText, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
# get reviews by invId
function getVehicleReviewById($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT revId, revText, revDate, clients.clientId, clients.clientFirstname, clients.clientLastname
    FROM reviews JOIN clients ON reviews.clientId = clients.clientId WHERE reviews.invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $vehicleReview = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicleReview;
}
# get reviews by clientId
function getClientReviewsById($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT revId, revText, revDate, inventory.invId, inventory.invMake, inventory.invModel
    FROM reviews JOIN inventory ON reviews.invId = inventory.invId WHERE reviews.clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientReview = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientReview;
}

# get review by revId
function getReviewById($revId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT revId, revText, revDate, inventory.invId, inventory.invMake, inventory.invModel
    FROM reviews JOIN inventory ON reviews.invId = inventory.invId WHERE reviews.revId = :revId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':revId', $revId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewById = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewById;
}

# delete review
function deleteReview($revId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE revId = :revId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':revId', $revId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();
    return $result;
}

# update review
function updateReview($revText, $revId) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET revText = :revText WHERE revId = :revId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':revText', $revText, PDO::PARAM_STR);
    $stmt->bindValue(':revId', $revId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

?>