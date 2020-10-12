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

    # variable to build a dynamic drop-down select list
    $classificationList = getClassifications();
    #Test array
    #var_dump($classifications);
    #    exit;

    # Main Controller
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    # Need to think of what this will look like
    switch ($action){
        case 'addC':
            break;
        case 'addV':
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