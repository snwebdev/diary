

<?php
session_start();

include_once("connection.php");
$query = "SELECT diary FROM users WHERE id='" . $_SESSION['id'] . "' LIMIT 1";
$result = mysqli_query($dbConnection, $query);
$row = mysqli_fetch_array($result);
$diary = $row['diary'];
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
    <link rel="stylesheet" href="css/blank.css">
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
            <form method="post" id="entryForm" action="diary_entry.php">
                <div class="form-group">
                   stuff will go here
                   <div id="output"></div>
            </form>
        </div>
    </div>

</div>





<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>');</script>

<script src="js/vendor/bootstrap.min.js"></script>

<script src="js/main.js"></script>
<script>
    console.log("hello");
    $(".contentContainer").css("min-height", $(window).height());
    $("textarea").css("height", $(window).height() - 250);
    
    $.ajax({
        url:"get_previous_entries.php",
        dataType: 'json',
        success:function(data){
            var output = "";
            for (var entry in data){
                output = output + data[entry].date + " " + data[entry].text + "<br />";
            }
            $("#output").html(output);
            console.log("in success");
            console.log(JSON.stringify(data));
        }
    });

 
</script>






</body>
</html>