<?php
$classSelect = '<select name="classificationId" id="classificationId">';
$classSelect .= "<option>Choose a Classification</option>";
foreach ($classifications as $classElement) {
    $classSelect .= "<option value='$classElement[classificationId]'";
    if(isset($classificationId)) {
        if($classElement['classificationId'] === $classificationId) {
            if($classElement['classificationId'] === $classificationId){
            $classSelect .= ' selected ';
            }
        } elseif(isset($invInfo['classificationId'])){
            if($classification['classificationId'] === $invInfo['classificationId']){
             $classSelect .= ' selected ';
            }
        }
    }
    $classSelect .= ">$classElement[classificationName]</option>";
}
$classSelect .= '</select>';

// Check if logged in
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('Location:../index.php');
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Michael Kendall">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PHP Motors">
    <link rel="stylesheet" href="/phpmotors/css/normalize.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/small.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/medium.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){
		echo "Modify $invInfo[invMake] $invInfo[invModel]";}
	elseif(isset($invMake) && isset($invModel)) {
		echo "Modify $invMake $invModel"; } ?></title>
</head>
<body id="background">
    <div id="content">
    <header id="page_header">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    </header>
    <nav class="navigation">
        <?php #require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/navigation.php'; ?>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){
	    echo "Modify $invInfo[invMake] $invInfo[invModel]";}
    elseif(isset($invMake) && isset($invModel)) {
	    echo "Modify$invMake $invModel"; } ?></h1>
    </main>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <p id="note">*Note All Fields are Required</p>
    <form id="forms" method="post" action="/phpmotors/vehicles/index.php">
        <?php echo $classSelect; ?>

        <label for="invMake">Make:</label>
        <input type="text" id="invMake" name="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?>>

        <label for="invModel">Model:</label>
        <input type="text" id="invModel" name="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?>>

        <label for="invDescription">Description:</label>
        <input type="text" id="invDescription" name="invDescription" required <?php if(isset($invDescription)){ echo "value='invDescription'"; } elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; } ?>>

        <label for="invImage">Image Path:</label>
        <input type="text" id="invImage" name="invImage" required <?php if(isset($invImage)){ echo "value='invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; } ?>>

        <label for="invThumbnail">Thumbnail Path:</label>
        <input type="text" id="invThumbnail" name="invThumbnail" required <?php if(isset($invThumbnail)){ echo "value='invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; } ?>>

        <label for="invPrice">Price:</label>
        <input type="number" step="0.01" min=”0″ id="invPrice" name="invPrice" required <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; } ?>>

        <label for="invStock"># in Stock:</label>
        <input type="number" id="invStock" name="invStock" required <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }  ?>>

        <label for="invColor">Color:</label>
        <input type="text" id="invColor" name="invColor" required <?php if(isset($invColor)){ echo "value='invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } ?>>
        <input type="submit" name="submit" id="register-submit" value="Update Vehicle" class="submitBtn">
        <input type="hidden" name="action" value="updateVehicle">
        <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];}
elseif(isset($invId)){ echo $invId; } ?>
    </form>
    <hr id="break">
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
    </div>
    <script>
    </script>
</body>
</html>