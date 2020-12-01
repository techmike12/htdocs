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
        $price = $vehicle['invPrice'];
        $price_format = number_format($price, 2, '.', ',');
        if (strrpos($vehicle["imgName"], '-tn') and ($vehicle["imgPrimary"] == 1) ) {
            $dv .= '<li>';
            $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
            $dv .= "<h2><a href='/phpmotors/vehicles/?action=carDetails&invId=$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
            $dv .= "<span>$$price_format</span>";
            $dv .= '<hr class="inv-break">';
            $dv .= '</li>';
        }
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
    if (strrpos($vehicleDetail["imgName"], '-tn') == 0) {
        $detv .= "<img src='$vehicleDetail[imgPath]' alt='Image of $vehicleDetail[invMake] $vehicleDetail[invModel] on phpmotors.com'>";
        $detv .= "<h2>Price: $$price_format</h2>";
        $detv .= '<hr class="inv-break">';
        $detv .= "<h2>$vehicleDetail[invMake] $vehicleDetail[invModel] Details</h2>";
        $detv .= "<p>$vehicleDetail[invDescription]</p>";
        $detv .= "<h2>Color: $vehicleDetail[invColor]</h2>";
        $detv .= "<h2># in Stock: $vehicleDetail[invStock]</h2>";
        $detv .= '</div>';
    }
    return $detv;
}

// Thumbnails for vehicle details
function buildThumbNails($tnimages) {
    $tnv = '<div class="thumb">';
    foreach ($tnimages as $tn) {
        $tnv .= "<img src='$tn[imgPath]' alt='$tn[imgName]'>";
    }
    $tnv .= '</div>';
    return $tnv;
}

/* * ********************************
*  Functions for working with images
* ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
}

// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';

    // Set up the image path
    $image_path = $dir . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
        break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
        break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
        break;
        default:
        return;
    }

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
        } else {
            // Write the old image to a new file
            $image_to_file($old_image, $new_image_path);
        }
        // Free any memory associated with the old image
        imagedestroy($old_image);
}

/* * ********************************
*  Functions for reviews
* ********************************* */
// Build reviews section
function buildVehicleReviews($vehicleReview){
    arsort($vehicleReview);
    $rev = '<ul id="review-display">';
    foreach ($vehicleReview as $review) {
    $clientFirst = substr($review['clientFirstname'], 0, 1);
    $clientLast = $review['clientLastname'];
    $clientName = $clientFirst.$clientLast;
    $date = $review['revDate'];
    $date = date('j F, Y');
    strtotime($date);
    $rev .= "<li class='screenName'>$clientName wrote on $date:</li>";
    $rev .= "<li class='reviewComment'>$review[revText]</li>";
   }
    $rev .= '</ul>';
    return $rev;
}

/* Build reviews section for admin view
*  Show update and delete buttons
*/
function buildClientReviews($clientReviews) {
    arsort($clientReviews);
    $rev = "<p class='explain'>Use these link(s) to update or delete reviews.</p>";
    $rev .= '<ul id="review-admin-display">';
    foreach ($clientReviews as $review) {
        $revId = $review['revId'];
        $vehicleName = $review['invModel'].' '.$review['invModel'];
        $date = $review['revDate'];
        $date = date('j F, Y');
        strtotime($date);
        $rev .= "<li class='inventoryName'>$vehicleName (Reviewed on $date): <a href='../../phpmotors/accounts/index.php?action=editReview&revId=$revId'>Edit</a> | <a href='../../phpmotors/reviews/index.php?action=delReview&revId=$revId'>Delete</a></li>";
   }
    $rev .= '</ul>';
    return $rev;
}

/*
*  Build reviews section for delete view
*/

function buildDelReviews($reviewText) {
    $vehicleName = $reviewText['invModel'].' '.$reviewText['invModel'];
    $date = $reviewText['revDate'];
    $date = date('j F, Y');
    strtotime($date);
    $revId = $reviewText['revId'];
    $text = $reviewText['revText'];

    $rev = "<h1>$vehicleName Review</h1>";
    $rev .= "<p class='explain'>Reviewed on $date</p>";
    $rev .= "<form id='forms' method='post' action='/phpmotors/reviews/index.php'>";
    $rev .= "<textarea for='comment' form='forms' name='revText'>$text</textarea>";
    $rev .= "<input type='submit' name='submit' id='review-submit' value='Delete' class='submitBtn'>";
    $rev .= "<input type=hidden name='action' value=deleteReview>";
    $rev .= "<input type=hidden name='revId' value=$revId>";
    $rev .= "</form>";
    return $rev;
}
?>