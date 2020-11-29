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
    # Get image upload functions
    require_once '../model/uploads-model.php';

    # Get the array of classifications
    $classifications = getClassifications();

    # Get navList
    $navList = buildNavList($classifications);

    # Main Controller
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
?>