<?php
    # Get the database connection file
    require_once 'library/connections.php';
    # Get the PHP Motors model for use as needed
    require_once 'model/main-model.php';
    # Get navList
    require_once 'library/functions.php';

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
        case 'something':
            break;
        default:
             include 'view/home.php';
    }
?>