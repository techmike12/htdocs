<?php
    // Check if logged in
    if ($_SESSION['clientData']['clientLevel'] < 2) {
        header('Location:../index.php');
    }
?>
<!DOCTYPE html>
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
    <title>PHP Motors</title>
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
        <h1>Vehicle Management</h1>
    </main>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <a class="addCar" href="/phpmotors/vehicles/index.php?action=addClass">Add Classification</a>
    <a class="addCar" href="/phpmotors/vehicles/index.php?action=addVehicle">Add Vehicle</a>
    <!--Display Classification list-->
    <?php
    if (isset($message)) {
        echo $message;
    }
    if (isset($classificationList)) {
        echo '<h2>Vehicles By Classification</h2>';
        echo '<p id="classList">Choose a classification to see those vehicles</p>';
        echo $classificationList;
    }
    ?>
    <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <!--Display Vehicle options-->
    <table id="inventoryDisplay"></table>
    <hr id="break">
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>
</html>