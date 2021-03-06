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
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $revText = filter_input(INPUT_POST, 'revText', FILTER_SANITIZE_STRING);
            echo $invId;

            // Check for empty review
            if (empty($revText)) {
                $_SESSION['message'] = '<p class="center">Please provide a review.</p>';
                header("location: ../vehicles/index.php?action=carDetails&invId=$invId");
                exit;
            }

            // Send data to the model
            $review = addReview($invId, $clientId, $revText);

            // Set a message based on the insert result
            if ($review) {
                $message = '<p class="notice">Review has been added.</p>';
            } else {
                $message = '<p class="notice">Sorry, review was not added.</p>';
            }

            // Redirect to this controller for default action
            header("location: ../vehicles/index.php?action=carDetails&invId=$invId");
        break;
        # View for deleting
        case 'delReview':
            $revId = filter_input(INPUT_GET, 'revId', FILTER_SANITIZE_NUMBER_INT);
            // Send data to the model
            $reviewText = getReviewById($revId);
            // Set a message based on the get result
            if (!count($reviewText)) {
                $reviewText = "<p class='notice'>No record Selected</p>";
            } else {
                $reviewText = buildDelReviews($reviewText);
            }
        include '../view/reviews-delete.php';
        break;
        # Delete Review
        case 'deleteReview':
            $revId = filter_input(INPUT_POST, 'revId', FILTER_SANITIZE_NUMBER_INT);
            // Send data to the model
            $remove = deleteReview($revId);
            // Set a message based on the get result
            if ($remove) {
                $message = "<p class='notice'>Review was successfully deleted.</p>";
            } else {
                $message = "<p class='notice'>Review was NOT deleted.</p>";
            }
            // Store message to session
            $_SESSION['message'] = $message;

            // Redirect to this controller for default action
            header('location: ../accounts/');
        break;
        # View for updating
        case 'editReview':
            $revId = filter_input(INPUT_GET, 'revId', FILTER_SANITIZE_NUMBER_INT);
            // Send data to the model
            $reviewInfo = getReviewById($revId);
            // Set a message based on the get result
            if (count($reviewInfo)<1) {
                $reviewInfo = "<p class='notice'>No record Selected</p>";
            } else {
                $reviewInfo = buildEditReviews($reviewInfo);
            }
        include '../view/reviews-update.php';
        break;
        # Update Review
        case 'updateReview':
            $revId = filter_input(INPUT_POST, 'revId', FILTER_SANITIZE_NUMBER_INT);
            $revText = filter_input(INPUT_POST, 'revText', FILTER_SANITIZE_STRING);
            // Check for same text
            $checkText = checkText($revText, $revId);
            // Results for match
            if($checkText) {
                $message = '<p class="center">This matches your previous review, please update.</p>';
                $_SESSION['message'] = $message;
                include '../view/reviews-update.php';
                exit;
            }
            // Send data to the model
            $update = updateReview($revText, $revId);
            // Set a message based on the get result
            if ($update) {
                $message = "<p class='notice'>Review was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header("location: ../accounts/");
            } else {
                $message = "<p class='notice'>Review was NOT updated.</p>";
                $_SESSION['message'] = $message;
                header("location: ../reviews/index.php?action=editReview&revId=$revId");
            }
        break;
        default:
            if (!$_SESSION) {
                include '../view/home.php';
            } else {
                include '../view/admin.php';
            }
    }
?>