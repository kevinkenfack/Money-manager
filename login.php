<?php
session_start();


$msgBox = '';


//include notification page
include ('includes/notification.php');

//Include db Page
include ('includes/db.php');

//Include Function page
include ('includes/Functions.php');

//User Login

if (isset($_POST['login'])) {
    if ($_POST['email'] == '') {
        $msgBox = alertBox($EmailEmpty);
    } else
        if ($_POST['password'] == '') {
            $msgBox = alertBox($PasswordEmpty);

        } else {
            // Get User Info
            $Email = $mysqli->real_escape_string($_POST['email']);
            $Password = encryptIt($_POST['password']);

            if ($stmt = $mysqli->prepare("SELECT UserId, FirstName, LastName, Email, Password, Currency from user WHERE Email = ? AND Password = ? ")) {
                $stmt->bind_param("ss", $Email, $Password);
                $stmt->execute();
                $stmt->bind_result($UserId_, $FirstName_, $LastName_, $Email_, $Password_, $Currency_);
                $stmt->store_result();
                $stmt->fetch();
                if ($num_of_rows = $stmt->num_rows >= 1) {
                    session_start();
                    $_SESSION['UserId'] = $UserId_;
                    $_SESSION['FirstName'] = $FirstName_;
                    $_SESSION['LastName'] = $LastName_;
                    $_SESSION['Currency'] = $Currency_;
                    $UserIds = $_SESSION['UserId'];


                    // Generate default Category for New User
                    $a = "SELECT CategoryName FROM category WHERE UserId = $UserIds";
                    $b = mysqli_query($mysqli, $a);

                    if (mysqli_num_rows($b) >= 1) {
                      echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin.php">';
                    } else {
                        $c = "INSERT INTO category(UserId, CategoryName, Level) VALUES ($UserIds, 'Salaire', 1), ($UserIds, 'Allocation', 1), ($UserIds, 'Petite caisse', 1), ($UserIds, 'Bonus', 1), ($UserIds, 'Alimentation', 2),
                             ($UserIds, 'Vie sociale', 2), ($UserIds, 'Auto-développement', 2), ($UserIds, 'Transport', 2), ($UserIds, 'Culture', 2), ($UserIds, 'Ménage', 2), ($UserIds, 'Vêtements', 2), 
                             ($UserIds, 'Beauté', 2), ($UserIds, 'Santé', 2), ($UserIds, 'Cadeau', 2)";
                        $d = mysqli_query($mysqli, $c);

                    }
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin.php">';
                } else {
                    $msgBox = alertBox($LoginError);
                }
            }
        }

}
?>




<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.png" type="image/png">

    <title>Connexion Finance Manager</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background-image: url('https://res.cloudinary.com/dci1eujqw/image/upload/v1616769558/Codepen/waldemar-brandt-aThdSdgx0YM-unsplash_cnq4sb.jpg'); background-size: cover; background-repeat: no-repeat;  background-attachment: fixed; background-position: center;">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center"><span class="glyphicon glyphicon-lock"></span>  <?php echo
$UserSign; ?></h3>
                    </div>
                    <div class="panel-body">
						<?php if ($msgBox) {
    echo $msgBox;
} ?>
                        <form method="post" action="" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <label for="email"><?php echo $Emails; ?></label>
                                    <input class="form-control"  placeholder="<?php echo
$Emails; ?>" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                     <label for="password"><?php echo $Passwords; ?></label>
                                    <input class="form-control"  placeholder="<?php echo
$Passwords; ?>" name="password" type="password" value="">
                               </div>
                               
                               <hr>
                                <button type="submit" name="login" class="btn btn-success btn-block"><span class="glyphicon glyphicon-log-in"></span>  <?php echo
$SignIn; ?></button>                                 <hr>
                               <a href="signUp.php" class="btn btn-info btn-block"> <span class="glyphicon glyphicon-pencil"></span> <?php echo
$RegisterAnAccount; ?></a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <small style="color: white; font-weight: normal;">copyright © <?php echo Date('Y'); ?> Finance Manager | Tous droits réservés</small><br>
            <small style="color: white; font-weight: normal;">Propulsé par Kevin Kenfack </small><img src="images/logo-kenfack.png" alt="Logo Kevin Kenfack" width="30px">
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>
