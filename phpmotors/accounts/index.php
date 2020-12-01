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
    # Get review functions
    require_once '../model/reviews-model.php';

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

            // Check email for existing email
            $existingEmail = checkExistingEmail($clientEmail);

            // Deal with existing email
            if(!$existingEmail) {
                $_SESSION['message'] = '<p class="center">This email address doesnt exist, do you want to register?</p>';
                include '../view/login.php';
                exit;
            }

            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

            // If the hashes don't match create an error
            // and return to the login view
            if(!$hashCheck) {
                $_SESSION['message'] = '<p class="center">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
            }

            # Delete cookie
            setcookie('firstname', "", time(), - 3600);

            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;

            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);

            // Store the array into the session
            $_SESSION['clientData'] = $clientData;

            // Get review info by clientId
            $clientId = $_SESSION['clientData']['clientId'];
            $clientReviews = getClientReviewsById($clientId);

            if (!count($clientReviews)) {
                $clientReviews = "<p id='reviewFirst'>Be the first to write a review</p>";
            } else {
                $clientReviews = buildClientReviews($clientReviews);
            }

            // Send them to the admin view
            include '../view/admin.php';
        break;
        // Logout case
        case 'logout':
            session_destroy();
            header('Location:../index.php');
        break;
        case 'clientUpdate':
            $clientId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $accountInfo = getAccountInfo($clientId);
            if(count($accountInfo)<1){
                $message = 'Sorry, no vehicle information could be found.';
            }
            include '../view/client-update.php';
            exit;
        break;
        case 'getClientId':
            // Get the classificationId
            $clientId = filter_input(INPUT_GET, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            // Fetch the vehicles by classificationId from the DB
            $clientArray = getAccountInfo($clientId);
            // Convert the array to a JSON object and send it back
            echo json_encode($clientArray);
            break;
        case 'updateInfo':
            // Filter and store the data
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
            $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $sessionEmail = filter_input(INPUT_POST, 'sessionEmail', FILTER_SANITIZE_EMAIL);
            // Check email after sanitizing
            $clientEmail = checkEmail($clientEmail);

            // Run basic checks, return if errors
            if (empty($clientEmail)) {
                $_SESSION['message'] = '<p class="center">Please provide a valid email address and password.</p>';
                include '../view/client-update.php';
                exit;
            }

            // Check email for existing email
            $existingEmail = checkExistingEmail($clientEmail);
            $sessionEmail = checkSessionEmail($clientEmail, $sessionEmail);
            if($sessionEmail) {
                if($existingEmail) {
                    $message = '<p class="center">The email address already exists. Please use a unique email.</p>';
                    $_SESSION['message'] = $message;
                    include '../view/client-update.php';
                    exit;
                }
            }

            // Send data to the model
            $updateResult = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);

            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            $clientData = getAccountInfo($clientId);
            array_pop($clientData);
            echo $clientData;

            // Store the array into the session
            $_SESSION['clientData'] = $clientData;

            // Check and report results
            if($updateResult){
                $message = "<p class='center'>Congratulations, your info was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/accounts/');
                exit;
            } else {
                $message = "<p class='center'>Sorry this failed to update. Please try again.</p>";
                $_SESSION['message'] = $message;
                include '../view/client-update.php';
                exit;
            }
        break;
        case 'updatePass':
            // Filter and store the data
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            // Check password after sanitizing
            $checkPassword = checkPassword($clientPassword);

            // Check for missing data
            if(empty($checkPassword)) {
                $message = '<p class="center">Please provide information for all empty form fields.</p>';
                $_SESSION['message'] = $message;
                include '../view/client-update.php';
                exit;
            }
            // Hash the checked Password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

            // Compare the password just submitted against
            // the hashed password for the matching client
            $clientData = getAccountInfo($clientId);
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            // If the hashes don't match create an error
            // and return to the login view
            if($hashCheck) {
                $message = '<p class="center">This matches your previous password, please enter a new one.</p>';
                $_SESSION['message'] = $message;
                include '../view/client-update.php';
                exit;
            }

            // Send data to the model
            $updateResult = updatePassword($hashedPassword, $clientId);

            // Check and report results
            if($updateResult){
                $message = "<p class='center'>Congratulations, your password has been updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/accounts/');
                exit;
            } else {
                $message = "<p class='center'>Sorry this failed to update. Please try again.</p>";
                $_SESSION['message'] = $message;
                include '../view/client-update.php';
                exit;
            }
            break;
        // Default case
        default:
            // Get review info by clientId
            $clientId = $_SESSION['clientData']['clientId'];
            $clientReviews = getClientReviewsById($clientId);

            if (!count($clientReviews)) {
                $clientReviews = "<p id='reviewFirst'>Be the first to write a review</p>";
            } else {
                $clientReviews = buildClientReviews($clientReviews);
            }
            //Send to admin.php
            include '../view/admin.php';
        break;
        }
?>