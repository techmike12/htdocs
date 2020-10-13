<?php
    # Accounts controller

    # Get the database connection file
    require_once '../library/connections.php';
    # Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    # Get the accounts model
    require_once '../model/accounts-model.php';

    # Get the array of classifications
    $classifications = getClassifications();
    # Test array
    #var_dump($classifications);
    #    exit;

    # Build navigation bar
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    # Test nav creation
    #echo $navList;
    #    exit;

    # Main Controller
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'register':
            // Filter and store the data
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
            $clientLastname = filter_input(INPUT_POST, 'clientLastname');
            $clientEmail = filter_input(INPUT_POST, 'clientEmail');
            $clientPassword = filter_input(INPUT_POST, 'clientPassword');

            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
                $message = '<p class="center">Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit;
            }

            // Send data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

            // Check and report results
            if($regOutcome === 1){
                $message = "<p class='center'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                include '../view/login.php';
                exit;
               } else {
                $message = "<p class='center'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
               }
            break;
        case 'newClient':
            include '../view/registration.php';
        break;
        case 'login':
            include '../view/login.php';
        break;
    }
?>