

<?php
session_start();

include_once("connection.php");
$query = "SELECT text FROM entries WHERE userid='" . $_SESSION['id'] . "' LIMIT 10";
$result = mysqli_query($dbConnection, $query);
$row = mysqli_fetch_array($result);
$entries = $row['diary'];
$first = $entries['0'];
?>
<!doctype html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Diary</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="previous_entries.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body data-spy="scroll" data-target=".navbar-collapse">

    <div class="container">
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-header pull-left">
                <a class="navbar-brand">Diary</a>
            </div>
            <div class="pull-right">
                <p class="navbar-text"><?php echo (" {$_SESSION['email']}") ?></p>
                <ul class="nav navbar-nav">
                    <li><a href="index.php?logout=1">Log Out</a></li>  
                </ul>
            </div>
        </div>
    </div>



    <div class="container contentContainer" id="home">
        <div class="col-md-6 col-md-offset-3" id="topRow">
            stuff goes here
            <p class="navbar-text"><?php echo $first ?></p>
        </div>
    </div>





    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>');</script>

    <script src="js/vendor/bootstrap.min.js"></script>

    <script src="js/main.js"></script>
    <script>
        $(".contentContainer").css("min-height", $(window).height());
        $("textarea").css("height", $(window).height() - 250);


    </script>

</body>
</html>