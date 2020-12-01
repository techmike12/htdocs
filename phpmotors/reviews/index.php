<?php
    # Reviews controller
    // Create or access a Session
    session_start();

    # Get the database connection file
    require_once '../library/connections.php';
    # Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    # Get the accounts model
    require_once '../model/vehicles-model.php';
    # Get functions for email validation
    require_once '../library/functions.php';
    # Get review functions
    require_once '../model/reviews-model.php';

    # Get the array of classifications
    $classifications = getClassifications();

    # Get navList
    $navList = buildNavList($classifications);

    # Main Controller
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        # Add new review
        case 'addReview':
            // Filter and store the data
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_STRING);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);
            $revText = filter_input(INPUT_POST, 'revText', FILTER_SANITIZE_STRING);
            echo $invId;
            // Send data to the model
            $review = addReview($invId, $clientId, $revText);

            // Set a message based on the insert result
            if ($review) {
                $message = '<p class="notice">Review has been added.</p>';
            } else {
                $message = '<p class="notice">Sorry, review was not added.</p>';
            }

            // Redirect to this controller for default action
            header('location: .');
        break;
        # View for deleting
        case 'delReview':

        include '../view/reviews-delete.php';
        break;
        # Delete Review
        case 'deleteReview':

        break;
        # View for updating
        case 'editReview':

        include '../view/reviews-update.php';
        break;
        # Update Review
        case 'updateReview':

        break;
        default:
            if (!$_SESSION) {
                include '../view/home.php';
            } else {
                include '../view/admin.php';
            }
    }
?>