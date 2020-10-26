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
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form id="forms" method="post" action="/phpmotors/accounts/index.php">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> name="clientFirstname" required>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> name="clientLastname" required>

        <label for="address">Email Address:</label>
        <input type="email" id="address" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> name="clientEmail" required>

        <label for="password">Password:</label>
        <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
        <input type="password" id="password" name="clientPassword" required
        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
        <input type="submit" name="submit" id="register-submit" value="Register" class="submitBtn">
        <input type="hidden" name="action" value="register">
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