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
        <h1>Register</h1>
    </main>
    <form id="login" method="post">
        <ul>
            <li>
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="name" required>
            </li>
            <li>
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="name" required>
            </li>
            <li>
                <label for="address">Email Address:</label>
                <input type="text" id="address" name="name" required>
            </li>
            <li>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </li>
            <li>
                <input type="submit" id="register-submit" value="Register" class="submitBtn">
            </li>
        </ul>
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