<!doctype html>
<?php session_start(); ?>
<?php

if(!isset($_SESSION['user'])){
    header("Location: register_login.php");
}
?>
<?php
$conn = mysqli_connect("localhost","root","root","application");
mysqli_set_charset($conn,'utf8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Moderator Dashboard</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="misc/jquery-2.1.4.min.js"></script>
    <link media="all" type="text/css" rel="stylesheet" href="./misc/bootstrap.min.css">
    <style>
        #view-source {
            position: fixed;
            display: block;
            right: 0;
            bottom: 0;
            margin-right: 40px;
            margin-bottom: 40px;
            z-index: 900;
        }
        tbody{
            height:200px;
            overflow-y:auto;
            width: 100%;
        }
        .othertop{margin-top:10px;}
        /*Profile Pic Start*/
        .picture-container{
            position: relative;
            cursor: pointer;
            text-align: center;
        }
        .picture{
            width: 170px;
            height: 170px;
            background-color: #999999;
            border: 4px solid #CCCCCC;
            color: #FFFFFF;
            border-radius: 50%;
            margin: 0px auto;
            overflow: hidden;
            transition: all 0.2s;
            -webkit-transition: all 0.2s;
        }
        .picture:hover{
            border-color: #2ca8ff;
        }
        .content.ct-wizard-green .picture:hover{
            border-color: #05ae0e;
        }
        .content.ct-wizard-blue .picture:hover{
            border-color: #3472f7;
        }
        .content.ct-wizard-orange .picture:hover{
            border-color: #ff9500;
        }
        .content.ct-wizard-red .picture:hover{
            border-color: #ff3b30;
        }
        .picture input[type="file"] {
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }

        .picture-src{
            width: 100%;

        }
        legend {
            display: block;
            width: 100%;
            padding: 0;
            margin-bottom: 20px;
            font-size: 21px;
            line-height: inherit;
            color: #333;
            border: 0;
            border-bottom: 1px solid #e5e5e5;
            text-align: left;
        }
        .center {
            margin: auto;
            width: 60%;
            padding: 10px;
        }
        /*Profile Pic End*/
        .editable{ background:#EAEAEA}
        hr {
            display: block;
            height: 1px;
            width: 60%;
            border: 0;
            border-top: 1px solid #ccc;
            margin: 1em 0;
            padding: 0;
        }
        .red{
            color:red;
        }

        .div-txt{
            padding:6px;
            margin:2px;
            border-radius: 2px 2px 2px 2px;
            -moz-border-radius: 2px 2px 2px 2px;
            -webkit-border-radius: 2px 2px 2px 2px;
            border: 1px solid #e0e0e0;
            background:#fafafa;
        }

        .placeholder {
            font-size: 17px;
            color: #0e0e0e;
        }
    </style>
    <script>
        $(function (){

            function inputsToElems(){
                $('.edit-btn').show();
                $('.div-txt').length < 1 || $('.div-txt').remove();
                $('.form-group').hide().find('input, select, textarea').each(function(){
                    var val = $(this).val() || '-', pl = $(this).attr('placeholder');
                    $('<div class="div-txt"><span class="placeholder">'+pl+'</span><br/>'+ val +'</div>').insertBefore($(this).closest('.form-group'));
                });
            }

            inputsToElems();

            $('.edit-btn, .cancel-btn').click(function(){
                $('.div-txt').toggle();
                $('.form-group').toggle();
                $('.edit-btn').toggle();
            });

            $('.form-horizontal').submit(function(e){
                e.preventDefault();
                inputsToElems();

                $.ajax({
                    // ... ajax settings ...
                });

                $('.alert').removeClass('hidden').hide().fadeIn(600, function(){
                    setTimeout(function(){$('.alert').fadeOut();},2000);
                });

            });

        });
    </script>
    <script>
        $(document).ready(function(){
// Prepare the preview for profile picture
            $("#wizard-picture").change(function(){
                readURL(this);
            });
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</head>


<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Student Dashboard</a>
        </div>
        <ul class="nav navbar-nav">
            <li ><a href="<?php echo $_SESSION['role'];?>_dashboard.php">Home</a></li>
            <li class="active"><a href="/view_edit_profile.php">Profile</a></li>
            <li><a href="#">Inbox</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
    </div>
</nav>
<div class="mdl-grid demo-content">
    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col">
        <div class="picture-container">
            <div class="picture">
                <img src="http://websamplenow.com/30/userprofile/images/avatar.jpg" class="picture-src" id="wizardPicturePreview" title="">
                <input type="file" id="wizard-picture" class="">
            </div>
        </div>
        <div align="center">
            <h3><?php echo $_SESSION['user']?></h3>
        </div>
        <br><br>
        <div style="width:100%; margin:0 auto;" class="centered" >
            <legend align="center"><h2>Profile</h2></legend>
        </div>
        <div class="container" style="width:100%; margin:0 auto;">
            <button class="btn btn-default btn-s pull-right edit-btn">  <i class="glyphicon glyphicon-pencil"></i></button>
            <br><br>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="First_name">First Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstname" id="firstname" required max-length="50" placeholder="First Name" value=" <?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']." WHERE Username='".$_SESSION['user']."'"))[2]; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Last_name">Last Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastname" id="lastname" required max-length="50" placeholder="Last Name" value="<?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']."  WHERE Username='".$_SESSION['user']."'"))[3]; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="User_name">Username:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" id="username" required max-length="50" placeholder="Username " value="<?php echo $_SESSION['user']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="email"  placeholder="Email" value="<?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']."  WHERE Username='".$_SESSION['user']."'"))[4]; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="number">Phone Number:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control"  name="contact" id="contact" required max-length="15" placeholder="Phone Number" value="<?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']."  WHERE Username='".$_SESSION['user']."'"))[5]; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="address">Address:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control"  name="Address" id="address" placeholder="Address"><?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']."  WHERE Username='".$_SESSION['user']."'"))[10]; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="date_of_birth">Date Of Birth:</label>
                    <div class="col-sm-10">
                        <input  type="date"  class="form-control"  name="DateOfBirth" id="DateOfBirth" placeholder="date_of_birth" value="<?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']."  WHERE Username='".$_SESSION['user']."'"))[6]; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Gender">Gender:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="Gender" id="Gender" placeholder="Gender"><?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']."  WHERE Username='".$_SESSION['user']."'"))[7]; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Department">Department:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="Department" placeholder="Department" readonly><?php echo  $_SESSION['department']?></textarea>
                    </div>
                </div>
                <div class="form-group text-right buttons-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default cancel-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary save-btn">Submit</button>
                    </div>
                </div>
            </form>

            <div class="alert alert-success hidden" role="alert">
                <strong>Well done!</strong> You have successfully changed your Profile information.
            </div>

        </div>
    </div>
</div>
