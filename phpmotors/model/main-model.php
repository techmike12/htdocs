<?php
# Main PHP Motors Model
function getClassifications(){
    # Create connection object
    $db = phpmotorsConnect();
    # SQL Statement to be used
    $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC';
    # Created statement
    $stmt = $db->prepare($sql);
    # Execute statement
    $stmt->execute();
    # Storing as array
    $classifications = $stmt->fetchAll();
    # Close connection
    $stmt->closeCursor();
    # Returns array
    return $classifications;
}
?>