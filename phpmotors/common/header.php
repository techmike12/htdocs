    <img id="logo" src="/phpmotors/images/site/logo.png" alt="PHP Logo">
    <?php if(in_array('loggedin', $_SESSION)){
            if(isset($_SESSION)){
                $client = $_SESSION['clientData']['clientFirstname'];
                echo "<a id='welcome' href='/phpmotors/accounts/'>Welcome $client</a>";
                echo '<a id="account" href="/phpmotors/accounts/index.php?action=logout">Logout</a>';
                }
            } else {
                echo '<a id="account" href="/phpmotors/accounts/index.php?action=login">My Account</a>';
            }
    ?>