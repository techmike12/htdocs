    <img id="logo" src="/phpmotors/images/site/logo.png" alt="PHP Logo">
    <?php if(isset($cookieFirstname)){
        echo "<span id='welcome'>Welcome $cookieFirstname</span>";
    } ?><a id="account" href="/phpmotors/accounts/index.php?action=login">My Account</a>