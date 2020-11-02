    <img id="logo" src="/phpmotors/images/site/logo.png" alt="PHP Logo">
    <?php if(isset($cookieFirstname)){
        echo "<span id='welcome'>Welcome $cookieFirstname</span>";
    }     if (!$_SESSION) {
        echo '<a id="account" href="/phpmotors/accounts/index.php?action=login">My Account</a>';
    } else {echo '<a id="account" href="/phpmotors/accounts/index.php?action=logout">Logout</a>';}?>