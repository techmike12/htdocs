<?php
    # Vehicles controller

    # Get the database connection file
    require_once '../library/connections.php';
    # Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    # Get the accounts model
    require_once '../model/vehicles-model.php';

    # Get the array of classifications
    $classifications = getClassifications();
    #Test array
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

    # Get Array Length
    #Test array
    #var_dump($classifications);
    #    exit;

    # Build Selction for Classifications
    $classSelect = '<label for="classificationId">Classification :</label>';
    $classSelect .= '<select name="classificationId" id="classificationId">';
    foreach ($classifications as $classElement) {
        $classSelect .= "<option value='$classElement[classificationId]'>$classElement[classificationName]</option>";
    }
    $classSelect .= '</select>';

    # Main Controller
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    # Need to think of what this will look like
    switch ($action){
        case 'addC':
            # Filter and store the data
            $classificationName = filter_input(INPUT_POST, 'classificationName');
            # Check for missing data
            if(empty($classificationName)) {
                $message = '<p class="center">Please provide information for all empty form fields.</p>';
                include '../view/add-classification.php';
                exit;
            }
            # Send data to the model
            $addCoutcome = addClass($classificationName);
            # Check and report results
            if($addCoutcome === 1){
                #$message = "<p class='center'>Thanks for adding $classificationName.</p>";
                include '../view/vehicle-management.php';
                exit;
               } else {
                $message = "<p class='center'>Sorry $classificationName failed to add. Please try again.</p>";
                include '../view/add-classification.php';
                exit;
               }
            break;
        case 'addV':
            # Filter and store the data
            $invMake = filter_input(INPUT_POST, 'invMake');
            $invModel = filter_input(INPUT_POST, 'invModel');
            $invDescription = filter_input(INPUT_POST, 'invDescription');
            $invImage = filter_input(INPUT_POST, 'invImage');
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
            $invPrice = filter_input(INPUT_POST, 'invPrice');
            $invStock = filter_input(INPUT_POST, 'invStock');
            $invColor = filter_input(INPUT_POST, 'invColor');
            $classificationId = filter_input(INPUT_POST, 'classificationId');

            # Check for missing data
            if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invColor)) {
                $message = '<p class="center">Please provide information for all empty form fields.</p>';
                include '../view/add-vehicle.php';
                exit;
            }
            # Send data to the model
            $addVoutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
            # Check and report results
            if($addVoutcome === 1){
                $message = "<p class='center'>Thanks for adding $invMake $invModel.</p>";
                include '../view/add-vehicle.php';
                exit;
               } else {
                $message = "<p class='center'>Sorry this failed to add. Please try again.</p>";
                include '../view/add-vehicle.php';
                exit;
               }
            break;
        case 'addClass':
            include '../view/add-classification.php';
            break;
        case 'addVehicle':
            include '../view/add-vehicle.php';
            break;
        default:
            include '../view/vehicle-management.php';
    }
?>