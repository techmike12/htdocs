<?php
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
		echo "Delete $invInfo[invMake] $invInfo[invModel]";}
	elseif(isset($invMake) && isset($invModel)) {
		echo "Delete $invMake $invModel"; } ?></title>
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
	    echo "Delete $invInfo[invMake] $invInfo[invModel]";}
    elseif(isset($invMake) && isset($invModel)) {
	    echo "Delete$invMake $invModel"; } ?></h1>
    </main>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <p id="note">Confirm Vehicle Deletion. The delete is permanent.</p>
    <form id="forms" method="post" action="/phpmotors/vehicles/index.php">

        <label for="invMake">Make:</label>
        <input type="text" id="invMake" name="invMake" readonly <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?>>

        <label for="invModel">Model:</label>
        <input type="text" id="invModel" name="invModel" readonly <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?>>

        <label for="invDescription">Description:</label>
        <input type="text" id="invDescription" name="invDescription" readonly <?php if(isset($invDescription)){ echo "value='invDescription'"; } elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; } ?>>

        <input type="submit" name="submit" id="register-submit" value="Delete Vehicle" class="submitBtn">
        <input type="hidden" name="action" value="deleteVehicle">
        <input type="hidden" name="invId" value="
        <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
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