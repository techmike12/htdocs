    <img id="logo" src="/phpmotors/images/site/logo.png" alt="PHP Logo">
    <?php if($_SESSION){
        $client = $_SESSION['clientData']['clientFirstname'];
        echo "<span id='welcome'>Welcome $client</span>";
    }     if (!$_SESSION) {
        echo '<a id="account" href="/phpmotors/accounts/index.php?action=login">My Account</a>';
    } else {echo '<a id="account" href="/phpmotors/accounts/index.php?action=logout">Logout</a>';}?>