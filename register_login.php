<?php
$conn = mysqli_connect("localhost","root","root","application");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
include("authenticate.php");

if(isset($_GET['out'])) {
    // destroy session
    session_unset();
    session_destroy();
}
if(isset($_POST["login-submit"])) {
    if ($_POST['role']=='Admin') {
        if (authenticate($_POST['username'], $_POST['password'],$_POST['role'],$conn,$_POST['department'])) {
            header('Location: Admin_dashboard.php');
            die();
        }
    }
    elseif ($_POST['role']=='Moderator') {
        if (authenticate($_POST['username'], $_POST['password'],$_POST['role'],$conn,$_POST['department'])) {
            header("Location: Moderator_dashboard.php");
            die();
        } else {
            //authentication failed
            $error = 1;
        }
    }
    elseif ($_POST['role']=='Student') {
        if (authenticate($_POST['username'], $_POST['password'],$_POST['role'],$conn,$_POST['department'])) {
            echo "student";
            // authentication passed
            header("Location: Student_dashboard.php");
            die();
        } else {
            //authentication failed
            $error = 1;
        }
    }
    else {
        if (authenticate($_POST['username'], $_POST['password'],$_POST['role'],$conn,$_POST['department'])) {
            // authentication passed
            header("Location: Teacher_dashboard.php");
            die();
        } else {
            //authentication failed
            $error = 1;
        }
    }
}
elseif(isset($_POST["register-submit"])){
    echo $_POST['register_role'];
    if (str_replace(' ', '',$_POST['register_role'])=='Moderator'){
        $sql="INSERT INTO `Moderator` (`UserName`, `Password`,`FirstName`, `LastName`, `Email`, `Contact`,`Role`,`Active`,`Department`) VALUES ('".$_POST['register_username']."','".$_POST['register_password']."','".$_POST['register_firstname']."','".$_POST['register_lastname']."','".$_POST['register_email']."','".$_POST['register_contact']."','".$_POST['register_role']."','no','".$_POST['register_department']."')";
        mysqli_query($conn,$sql);
    }
    else{
        $table_name= str_replace(' ', '',$_POST['register_department'])."StudentTeacher";
        $sql="INSERT INTO `".$table_name."` (`UserName`,`Password`, `FirstName`, `LastName`, `Email`, `Contact`,`Role`,`Active`) VALUES ('".$_POST['register_username']."','".$_POST['register_password']."','".$_POST['register_firstname']."','".$_POST['register_lastname']."','".$_POST['register_email']."','".$_POST['register_contact']."','".$_POST['register_role']."','no')";
        mysqli_query($conn,$sql);
    }
}

// output error to user
if(isset($error)) echo "Login failed: Incorrect user name, password, or rights<br /-->";

// output logout success
if(isset($_GET['out'])) echo "Logout successful";
?>
<?php include("includes/header.php"); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<script>
    $(function() {

        $('#login-form-link').click(function(e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#register-form-link').click(function(e) {
            $('#department').hide();
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });

    });

    $(document).ready(function() {
        $('#department').hide();

        $('#role').change(function () {
            if ($('#role option:selected').text() == "Admin"){
                $('#department').hide();
            }
            else {
                $('#department').show();
            }
        });
    });

</script>

<style>
    body {
        padding-top: 90px;
    }
    .panel-login {
        border-color: rgba(0, 0, 0, 0.0);
        -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
        -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
        box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
    }
    .panel {
        margin-bottom: 20px;
        background-color: rgba(0, 0, 0, 0.12);
        /* border: 1px solid transparent; */
        /* border-radius: 4px; */
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .panel-login>.panel-heading {
        color: #00415d;
        background-color: rgba(0, 0, 0, 0.4);
        border-color: rgba(0, 0, 0, 1);
        text-align: center;
    }
    .panel-body {
        padding: 25px 25px 30px 25px;
        background: #444;
        background: rgba(0, 0, 0, 0.4);
        -moz-border-radius: 0 0 4px 4px;
        -webkit-border-radius: 0 0 4px 4px;
        border-radius: 0 0 4px 4px;
        text-align: left;
    }
    label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 700;
        color: white;
    }
</style>
<h1 align="center" style="color: #029f5b">College of Engineering Social Network</h1>
<div class="backstretch"  style= " background: url('includes/img/backgrounds/1.jpg');background-size: cover;background-position: center;background-attachment: fixed;left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 100%; width: 100%; z-index: -999999; position: fixed;">
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body" id="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="" method="post" role="form" style="display: block;">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" >
                                </div>
                                <div class="form-group" id='role'>
                                <select id='role' name = 'role' class="selectpicker " required>
                                    <option value="" selected disabled>Select Role</option>";
                                    <option value='Admin'>Admin</option>
                                    <option value='Moderator'>Moderator</option>
                                    <option value='Student'>Student</option>
                                    <option value='Teacher'>Teacher</option>
                                </select>
                                </div>
                                <div class="form-group" id='department'>
                                <select name='department' id='department' class="selectpicker " >
                                    <option value="" selected disabled>Please select</option>
                                    <option>Computer Engineering</option>";
                                    <option>Software Engineering</option>";

                                </select>
                                </div>
                                <div class="form-group text-center">
                                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                    <label for="remember"> Remember Me</label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="register-form" action="#" method="post" role="form" style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="register_firstname" id="firstname" tabindex="1" class="form-control" placeholder="Firstname" value="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="register_lastname" id="lastname" tabindex="1" class="form-control" placeholder="Lastname" value="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="register_username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="register_email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="register_contact" id="contact" tabindex="2" class="form-control" placeholder="Contact Number">
                                </div>
                                <div class="form-group" id='register_role'>
                                    <select id='register_role' name = 'register_role' class="selectpicker " >
                                        <option value="" selected disabled>Select Role</option>";
                                        <option value='Moderator'>Moderator</option>
                                        <option value='Student'>Student</option>
                                        <option value='Teacher'>Teacher</option>
                                    </select>
                                </div>
                                <div class="form-group" id='register_department'>
                                    <select name='register_department' id='register_department' class="selectpicker ">
                                        <option value="" selected disabled>Select Department</option>
                                        <option>Computer Engineering</option>";
                                        <option>Software Engineering</option>";

                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="register_password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
