<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Michael Kendall">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Image Management">
    <link rel="stylesheet" href="../css/normalize.css" media="screen">
    <link rel="stylesheet" href="../css/small.css" media="screen">
    <link rel="stylesheet" href="../css/medium.css" media="screen">
    <link rel="stylesheet" href="../css/large.css" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <title>Image Management</title>
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
        <h1>Image Management</h1>
        <p class="explain">Choose one of the options below:</p>

        <h2>Add New Vehicle Image</h2>
        <?php
            if (isset($message)) {
                echo $message;
            } ?>
        <form id="formImage" action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
        <label for="invItem" id="vLabel">Vehicle:</label>
            <?php echo $prodSelect; ?>
            <fieldset>
                <label>Is this the main image for the vehicle?</label>
		        <label for="priYes" class="pImage">Yes</label>
		        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
		        <label for="priNo" class="pImage">No</label>
                <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
            </fieldset>
        <label>Upload Image:</label>
        <input type="file" name="file1">
        <input type="submit" value="Upload" class="submitBtn">
        <input type="hidden" name="action" value="upload">
        </form>
    </main>
    <hr id="break">
    <h2>Existing Images</h2>
    <p class="explain">If deleting an image, delete the thumbnail too and vice versa.</p>
    <?php
        if (isset($imageDisplay)) {
            echo $imageDisplay;
        } ?>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
    </div>
    <script>
    </script>
</body>
</html>
<?php unset($_SESSION['message']); ?>