<?php

//Include Functions
include('includes/Functions.php');

//Include Notifications
include ('includes/notification.php');

//delete account

if(isset($_POST['change'])){
		if($_POST['email'] == '' || $_POST['firstname'] == '' || $_POST['lastname'] == '' || $_POST['password'] == '' || $_POST['rpassword'] == '') {
				$msgBox = alertBox($SignUpEmpty);
			} else if($_POST['password'] != $_POST['rpassword']) {
				$msgBox = alertBox($PwdNotSame);

			} else {
				// Set new account
				$Email 		= $mysqli->real_escape_string($_POST['email']);
				$Password 	= encryptIt($_POST['password']);
				$FirstName	= $mysqli->real_escape_string($_POST['firstname']);
				$LastName	= $mysqli->real_escape_string($_POST['lastname']);
				$Currency	= $mysqli->real_escape_string($_POST['currency']);

				// add new account
				$sql="UPDATE user SET FirstName = ?, LastName = ?, Email = ?, Password = ?, Currency = ? WHERE UserId = $UserId";
				if($statement = $mysqli->prepare($sql)){
					//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
					$statement->bind_param('sssss', $FirstName, $LastName, $Email, $Password, $Currency);
					$statement->execute();
				}
				$msgBox = alertBox($SuccessAccountUpdate);
			}
	}

// Get User Info
$GetUsers	 	 = "SELECT FirstName, LastName, Email, Currency, Password from user WHERE UserId = $UserId";
$GetUserq		 = mysqli_query($mysqli, $GetUsers);
$UserInfos 		 = mysqli_fetch_assoc($GetUserq);

//Include Global page
	include ('includes/global.php');


?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $ManageAccount; ?>	</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
				<?php if ($msgBox) { echo $msgBox; } ?>
                <div class="col-lg-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $ChangeAccountProfile; ?>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        <form method="post" action="" role="form">
                            <fieldset>
                                <div class="form-group col-lg-6">
                                    <label for="email"><?php echo $Emails; ?></label>
                                    <input class="form-control"  required placeholder="<?php echo $Emails; ?>" name="email" type="email"  value="<?php echo $UserInfos['Email'];?>" autofocus>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="email"><?php echo $FirstNames; ?></label>
                                    <input class="form-control"  required placeholder="<?php echo $FirstNames; ?>" value="<?php echo $UserInfos['FirstName'];?>" name="firstname" type="text" >
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="email"><?php echo $LastNames; ?></label>
                                    <input class="form-control"  required placeholder="<?php echo $LastNames; ?>" name="lastname"  value="<?php echo $UserInfos['LastName'];?>" type="text" >
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="email"><?php echo $Currencys; ?></label>
                                    <select class="form-control bold"  name="currency">
										<option value="<?php echo $UserInfos['Currency'];?>" selected="" ><?php echo $UserInfos['Currency'];?></option>
                                        <option value="" disabled selected="">Sélectionne la devise de ta localité.</option>
                                        <option value="XAF">Franc CFA Afrique centrale (XAF)</option>
                                        <option value="XOF">Franc CFA Afrique de l'Ouest (XOF)</option>
                                        <option value="$">Dollar américain ($)</option>
                                        <option value="€">Euro (€)</option>
                                    </select>

                                </div>
                                <div class="form-group col-lg-6">
                                     <label for="password"><?php echo $Passwords; ?></label>
                                    <input class="form-control"  placeholder="<?php echo $Passwords; ?>" name="password" type="password" value="">
                               </div>
                                <div class="form-group col-lg-6">
                                     <label for="password"><?php echo $RepeatPassword; ?></label>
                                    <input class="form-control"  placeholder="<?php echo $RepeatPassword; ?>" name="rpassword" type="password" value="">
                               </div>
                               <hr>
                               <div class="form-group col-lg-4 text-center">
                                <button type="submit" name="change" class="btn btn-success btn-block"><span class="glyphicon glyphicon-log-in"></span>  <?php echo $Save; ?></button>
                               </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                    </div>
                    <!-- /.panel -->
                </div>

                <div class="col-lg-8">


            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

<script>


    $(function() {

     $('.notification').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    });
    </script>
