<?php
$classSelect = '<label for="classificationId">Classification :</label>';
$classSelect .= '<select name="classificationId" id="classificationId" required>';
foreach ($classifications as $classElement) {
    $classSelect .= "<option value='$classElement[classificationId]'";
    if(isset($classificationId)) {
        if($classElement['classificationId'] === $classificationId) {
            $classSelect .= ' selected ';
        }
    }
    $classSelect .= ">$classElement[classificationName]</option>";
}
$classSelect .= '</select>';

// Check if logged in
if (!$_SESSION) {
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
    <p id="note">*Note All Fields are Required</p>
    <form id="forms" method="post" action="/phpmotors/vehicles/index.php">
        <?php echo $classSelect; ?>

        <label for="invMake">Make:</label>
        <input type="text" id="invMake" <?php if(isset($invMake)){echo "value='$invMake'";}  ?> name="invMake" required>

        <label for="invModel">Model:</label>
        <input type="text" id="invModel" <?php if(isset($invModel)){echo "value='$invModel'";}  ?> name="invModel" required>

        <label for="invDescription">Description:</label>
        <input type="text" id="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?> name="invDescription" required>

        <label for="invImage">Image Path:</label>
        <input type="text" id="invImage" <?php if(isset($invImage)){echo "value='$invImage'";}  ?> name="invImage" value="/phpmotors/images/no-image.png" required>

        <label for="invThumbnail">Thumbnail Path:</label>
        <input type="text" id="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> name="invThumbnail" value="/phpmotors/images/no-image.png" required>

        <label for="invPrice">Price:</label>
        <input type="number" step="0.01" min=”0″ id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> name="invPrice" required>

        <label for="invStock"># in Stock:</label>
        <input type="number" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> name="invStock" required>

        <label for="invColor">Color:</label>
        <input type="text" id="invColor" <?php if(isset($invColor)){echo "value='$invColor'";}  ?> name="invColor" required>
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