<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Michael Kendall">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PHP Motors">
    <link rel="stylesheet" href="css/normalize.css" media="screen">
    <link rel="stylesheet" href="css/small.css" media="screen">
    <link rel="stylesheet" href="css/medium.css" media="screen">
    <link rel="stylesheet" href="css/large.css" media="screen">
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
        <h1>Welcome to PHP Motors</h1>
        <section id="dmccar">
            <div id="dmcinfo">
                <h2>DMC Delorean</h2>
                <p>3 Cup holders</p>
                <p>Superman doors</p>
                <p>Fuzzy dice!</p>
                <input type="image" src="/phpmotors/images/site/own_today.png" alt="Own Today Button">
            </div>
            <div id="dmc">
                <img id="delor" src="/phpmotors/images/delorean.jpg" alt="DMC Delorean">
            </div>
        </section>
            <section id="uprev">
                <section id="reviews">
                    <h2>DMC Delorean Reviews</h2>
                        <ul>
                            <li>"So fast its almost like traveling in time." (4/5)</li>
                            <li>"Coolest ride on the road." (4/5)</li>
                            <li>"I'm feeling Marty Mcfly!" (5/5)</li>
                            <li>"The most futuristic ride of our day" (4.5/5)</li>
                            <li>"80's livin and I love it!" (5/5)</li>
                        </ul>
                </section>
                <h2 id="upgradehead">Delorean Upgrades</h2>
                <div id="upgrades">
                    <section id="flux">
                        <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor">
                        <div class="uplink">
                            <a href="#">Flux Capacitor</a>
                        </div>
                    </section>
                    <section id="flame">
                        <img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decals">
                        <div class="uplink">
                            <a href="#">Flame Decals</a>
                        </div>
                    </section>
                    <section id="sticker">
                        <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
                        <div class="uplink">
                            <a href="#">Bumper Stickers</a>
                        </div>
                    </section>
                    <section id="hub">
                        <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Caps">
                        <div class="uplink">
                            <a href="#">Hub Caps</a>
                        </div>
                    </section>
                </div>
            </section>
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