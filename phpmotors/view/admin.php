<?php
    // Check if logged in
    if (!$_SESSION) {
        header('Location:../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Michael Kendall">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PHP Motors Admin">
    <link rel="stylesheet" href="../css/normalize.css" media="screen">
    <link rel="stylesheet" href="../css/small.css" media="screen">
    <link rel="stylesheet" href="../css/medium.css" media="screen">
    <link rel="stylesheet" href="../css/large.css" media="screen">
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
        <?php
        $clientFirst = $_SESSION['clientData']['clientFirstname'];
        $clientLast = $_SESSION['clientData']['clientLastname'];
        echo "<h1>$clientFirst $clientLast</h1>";
        echo "<p id='logged'>You are logged in.</p>";
        $clientEmail = $_SESSION['clientData']['clientEmail'];
        $clientLevel = $_SESSION['clientData']['clientLevel'];
        echo "<ul id='adminList'>";
        echo "<li>Email: $clientEmail</li>";
        echo "<li>Client Level: $clientLevel</li>";
        echo "</ul>";
        if ($clientLevel > 1) {
            echo "<a id='management' href='../vehicles/index.php'>Vehicle Management</a>";
        }
        ?>
    </main>
    <hr id="break">
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
    </div>
    <script>
    </script>
</body>
</html>