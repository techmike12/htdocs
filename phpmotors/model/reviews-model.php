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

# get review by revId

# update review

# delete review

?>