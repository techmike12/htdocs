<?php
    # Accounts controller

    # Get the database connection file
    require_once '../library/connections.php';
    # Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    # Get the accounts model
    require_once '../model/accounts-model.php';
    # Get the email validation
    require_once '../library/functions.php';

    # Get the array of classifications
    $classifications = getClassifications();
    # Test array
    #var_dump($classifications);
    #    exit;

    # Get navList
    $navList = buildNavList($classifications);

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
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
            $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

            // Check email after sanitizing
            $clientEmail = checkEmail($clientEmail);
            // Check password after sanitizing
            $checkPassword = checkPassword($clientPassword);

            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
                $message = '<p class="center">Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit;
            }
            // Hash the checked Password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

            // Send data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

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