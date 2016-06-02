<!doctype html>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Diary</title>
    <meta name="description" content="An online diary example">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/main.css">

</head>
<body data-spy="scroll" data-target=".navbar-collapse">
    <? include_once("login.php"); ?>

    <div class="container">
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Diary</a>
            </div>
            <div class="collapse navbar-collapse">
                <form class="navbar-form navbar-right" method="post">
                    <div class="form-group">
                        <input type="email" name="loginEmail" placeholder="email" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <input type="password" name="loginPassword" placeholder="password" class="form-control"/>
                        <input type="submit" name="submit" class="btn btn-success" value="Login"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container" id="home">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" id="topRow">
                <h1>Diary</h1>
                <p class="lead">Your diary in the cloud</p>
                <p class="bold paddingTop">Interested? Sign up below.</p>
                <form class="paddingTop form-horizontal" method="post">
                    <div class="form-group">
                        <label for="signupEmail" class="control-label col-md-3">email address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="signupEmail" id="signupEmail">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="signupPassword" class="control-label col-md-3" >password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="signupPassword" id="signupPassword" />
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success btn-lg " name="submit" value="Sign Up"/>
                </form>
            </div>
        </div>
    </div>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>');</script>

    <script src="js/vendor/bootstrap.min.js"></script>

    <script src="js/main.js"></script>
    <script>
        $("#home").css("min-height", $(window).height());
    </script>



</body>
</html>