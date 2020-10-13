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
        <h1>Add Vehicle</h1>
    </main>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form id="forms" method="post" action="/phpmotors/vehicles/index.php">
        <?php echo $classSelect; ?>

        <label for="invMake">Make:</label>
        <input type="text" id="invMake" name="invMake">
        
        <label for="invModel">Model:</label>
        <input type="text" id="invModel" name="invModel">
        
        <label for="invDescription">Description:</label>
        <input type="text" id="invDescription" name="invDescription">
        
        <label for="invImage">Image Path:</label>
        <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png">
        
        <label for="invThumbnail">Thumbnail Path:</label>
        <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png">
        
        <label for="invPrice">Price:</label>
        <input type="text" id="invPrice" name="invPrice">
        
        <label for="invStock"># in Stock:</label>
        <input type="text" id="invStock" name="invStock">
        
        <label for="invColor">Color:</label>
        <input type="text" id="invColor" name="invColor">
        <input type="submit" name="submit" id="register-submit" value="Add Vehicle" class="submitBtn">
        <input type="hidden" name="action" value="addV">
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