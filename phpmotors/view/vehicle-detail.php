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
    <title><?php echo $vehicleName ?> | PHP Motors, Inc.</title>
</head>
<body id="background">
    <div id="content">
    <header id="page_header">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    </header>
    <nav class="navigation">
        <?php echo $navList; ?>
    </nav>
    <main>
        <div id="imageDiv">
        <?php if(isset($tnImages)){
            echo $tnImages;
        } ?>
        </div>
        <h1 id="detailH1"><?php echo $vehicleName; ?> vehicles</h1>
        <?php if(isset($message)){
            echo $message; }
        ?>
        <?php if(isset($vehicleDetail)){
            echo $vehicleDetail;
        } ?>
        <div id="imageDivBot">
        <?php if(isset($tnImages)){
            echo $tnImages;
        } ?>
        </div>
    </main>
    <hr id="break">
    <div id="reviews">
        <h1>Customer Reviews</h1>
        <?php
        if ($_SESSION) {
            $clientFirst = substr($_SESSION['clientData']['clientFirstname'], 0, 1);
            $clientLast = $_SESSION['clientData']['clientLastname'];
            $clientName = $clientFirst.$clientLast;
            $clientId = $_SESSION['clientData']['clientId'];
            echo "<h2 id='reviewV'>Review the $vehicleName</h2>";
            echo "<form id='forms' method='post' action='/phpmotors/reviews/index.php'>";
            echo "<label for='screenName'>Screen Name:</label>";
            echo "<input type='text' id='screenName' value=$clientName readonly='readonly'>";
            echo "<label for='reviewText'>Review:</label>";
            echo "<textarea for='comment' form='forms' name='revText'>Enter review here....</textarea>";
            echo "<input type='submit' name='submit' id='review-submit' value='Add Review' class='submitBtn'>";
            echo "<input type=hidden name='action' value=addReview>";
            echo "<input type=hidden name='clientId' value=$clientId>";
            echo "<input type=hidden name='invId' value=$invId>";
            echo "</form>";
            if(isset($vehicleReview)){
                echo $vehicleReview;
            }
        } else {
            echo "<p id='reviewLog'>You must <a href='../../phpmotors/accounts/index.php?action=login'>login</a> to write a review</p>";
            if(isset($vehicleReview)){
                echo $vehicleReview;
            }
        }?>
    </form>
    </div>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
    </div>
    <script>
    </script>
</body>
</html>