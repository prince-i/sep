<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | SEP</title>
    <link rel="stylesheet" href="node_modules/materialize-css/dist/css/materialize.min.css">
</head>
<body>
    <div class="row">
        <div class="container">
            <h5 class="center">SEP TRAINING SYSTEM</h5>
            <div class="container">
                <form action="" method="POST">
                    <div class="col s12 input-field">
                        <input type="text" name="username" id="username">
                        <label for="username">Username</label>
                    </div>
                    <!-- PASSWORD -->
                    <div class="col s12 input-field">
                        <input type="password" name="password" id="password">
                        <label for="password">Password</label>
                    </div>
                    <!-- BUTTON -->
                    <div class="col s12 input-field">
                        <input type="submit" name="login_button" class="btn blue" value="login">
                    </div>
                    <!-- NOTIF -->
                    <div class="col s12 input-field">
                        <center>
                            <?php include 'function/server.php';?>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/materialize-css/dist/js/materialize.min.js"></script>
</body>
</html>
