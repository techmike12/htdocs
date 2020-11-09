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
    <meta name="description" content="PHP Motors">
    <link rel="stylesheet" href="../css/normalize.css" media="screen">
    <link rel="stylesheet" href="../css/small.css" media="screen">
    <link rel="stylesheet" href="../css/medium.css" media="screen">
    <link rel="stylesheet" href="../css/large.css" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <title>Update Account Information</title>
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
        <h1>Update Account Information</h1>
    </main>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <h2>Update Account Info</h2>
    <form id="infoform" method="post" action="/phpmotors/accounts/">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($accountInfo['clientFirstname'])) {echo "value='$accountInfo[clientFirstname]'"; } ?> name="clientFirstname" required>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($accountInfo['clientLastname'])) {echo "value='$accountInfo[clientLastname]'"; } ?> name="clientLastname" required>

        <label for="address">Email Address:</label>
        <input type="email" id="address" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($accountInfo['clientEmail'])) {echo "value='$accountInfo[clientEmail]'"; } ?> name="clientEmail" required>

        <input type="submit" name="submit" id="UpdateInfo" value="Update Info" class="submitBtn">
        <input type="hidden" name="action" value="updateInfo">
        <input type="hidden" name="clientId" value="
        <?php if(isset($accountInfo['clientId'])){ echo $accountInfo['clientId'];}
elseif(isset($clientId)){ echo $clientId; } ?>">
    </form>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <h2>Update Password</h2>
    <form id="passform" method="post" action="/phpmotors/accounts/">
        <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
        <span>*Note your original password will be changed.</span>
        <label for="password">New Password:</label>
        <input type="password" id="password" name="clientPassword" required
        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
        <input type="submit" name="submit" id="updatePass" value="Update Password" class="submitBtn">
        <input type="hidden" name="action" value="
        <?php if(isset($accountInfo['clientId'])){ echo $accountInfo['clientId'];}
elseif(isset($clientId)){ echo $clientId; } $sessionEmail=$_SESSION['clientEmail']?>">
    </form>
    <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <hr id="break">
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
    </div>
    <script src="../js/client.js"></script>
</body>
</html>