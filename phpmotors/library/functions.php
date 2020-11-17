<?php
/*
* Validates email after sanitizing
*/
function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

/*
* Validates password after sanitizing
*/
function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

/*
* Create navList
*/
function buildNavList($classifications) {
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

/*
* Build classifications select list
*/
function buildClassificationList($classifications) {
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

/*
* Build display of vehicles within an unordered list
*/
function buildVehiclesDisplay($vehicles) {
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= "<h2><a href='/phpmotors/vehicles/?action=carDetails&invId=$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
     $dv .= "<span>$$vehicle[invPrice]</span>";
     $dv .= '<hr class="inv-break">';
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

/*
* Build details of vehicle selected
*/
function buildVehicleDetails($vehicleDetail) {
    $price = $vehicleDetail['invPrice'];
    $price_format = number_format($price, 2, '.', ',');
    $detv = '<div id="inv-details">';
    $detv .= "<img src='$vehicleDetail[invImage]' alt='Image of $vehicleDetail[invMake] $vehicleDetail[invModel] on phpmotors.com'>";
    $detv .= "<h2>Price: $$price_format</h2>";
    $detv .= '<hr class="inv-break">';
    $detv .= "<h2>$vehicleDetail[invMake] $vehicleDetail[invModel] Details</h2>";
    $detv .= "<p>$vehicleDetail[invDescription]</p>";
    $detv .= "<h2>Color: $vehicleDetail[invColor]</h2>";
    $detv .= "<h2># in Stock: $vehicleDetail[invStock]</h2>";
    $detv .= '</div>';
    return $detv;
}
?>