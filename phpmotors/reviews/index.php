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