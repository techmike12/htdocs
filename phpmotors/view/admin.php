<?php
    // Check if logged in
    if (!$_SESSION) {
        header('Location:../index.php');
    }
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
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
    <title>My Account</title>
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
    if (isset($message)) {
        echo $message;
    }
    ?>
        <?php
        $clientFirst = $_SESSION['clientData']['clientFirstname'];
        $clientLast = $_SESSION['clientData']['clientLastname'];
        $clientId = $_SESSION['clientData']['clientId'];
        echo "<h1>$clientFirst $clientLast</h1>";
        echo "<p id='logged'>You are logged in.</p>";
        $clientEmail = $_SESSION['clientData']['clientEmail'];
        $clientLevel = $_SESSION['clientData']['clientLevel'];
        echo "<ul id='adminList'>";
        echo "<li>First Name: $clientFirst</li>";
        echo "<li>Last Name: $clientLast</li>";
        echo "<li>Email: $clientEmail</li>";
        echo "</ul>";
        if ($clientLevel > 1) {
            echo "<h2>Inventory Management</h2>";
            echo "<p class='explain'>Use this link to manage the inventory.</p>";
            echo "<a class='management' href='../vehicles/index.php'>Vehicle Management</a>";
        }
        echo "<h2>Account Management</h2>";
        echo "<p class='explain'>Use this link to update account information.</p>";
        echo "<a class='management' href='../accounts/index.php?action=clientUpdate&id=$clientId'>Update Account Information</a>";
        ?>
        <!-- Reviews Section -->
        <?php
        if ($clientLevel > 1 && isset($clientReviews)) {
            echo "<h2>Manage Your Product Reviews</h2>";
            echo $clientReviews;
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
<?php unset($_SESSION['message']); ?>