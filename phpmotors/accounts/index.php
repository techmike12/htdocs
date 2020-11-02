<?php
    # Accounts controller

    // Create or access a Session
    session_start();

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

            // Check email for existing email
            $existingEmail = checkExistingEmail($clientEmail);

            // Deal with existing email
            if($existingEmail) {
                $message = '<p class="center">The email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }

            // Send data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

            // Check and report results
            if($regOutcome === 1){
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "<p class='center'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                header('Location:../accounts/?action=login');
                exit;
               } else {
                $_SESSION['message'] = "<p class='center'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
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
        case 'admin':
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

            // Check email after sanitizing
            $clientEmail = checkEmail($clientEmail);
            // Check password after sanitizing
            $checkPassword = checkPassword($clientPassword);

            // Run basic checks, return if errors
            if (empty($clientEmail) || empty($checkPassword)) {
                // Getting 0 from checkPassword?
                $_SESSION['message'] = '<p class="center">Please provide a valid email address and password.</p>';
                include '../view/login.php';
                exit;
            }

            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);

            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

            // If the hashes don't match create an error
            // and return to the login view
            if(!$hashCheck) {
                $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
            }
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;

            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);

            // Store the array into the session
            $_SESSION['clientData'] = $clientData;

            // Send them to the admin view
            include '../view/admin.php';
        break;
        // Logout case
        case 'logout':
            session_destroy();
            header('Location:../index.php');
        break;
        // Default case
        default:
        //Send to admin.php
            include '../view/admin.php';
        break;
        }
?>