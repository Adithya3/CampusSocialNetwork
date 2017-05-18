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
    <title>Teacher Dashboard</title>

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

        }
        .picture{
            width: 170px;
            height: 170px;
            background-color: #999999;
            border: 4px solid #CCCCCC;
            color: #FFFFFF;

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
        $(document).ready(function () {
            $('.editbtn').click(function () {
                var currentTD = $(this).parents("tr").children("td:nth-child(2)");
                if ($(this).html() == 'Edit') {
                    currentTD = $(this).parents("tr").children("td:nth-child(2)");
                    $.each(currentTD, function () {
                        $(this).prop('contenteditable', true)
                    });
                } else {
                    $.each(currentTD, function () {
                        var marks = $(this).parents("tr").children("td:nth-child(2)").text();
                        var student = $(this).parents("tr").children("td:nth-child(1)").text();;
                        $.ajax({
                         url: window.location.href,
                         type: "POST",
                         data: {
                             student: student,
                             marks:marks
                         },
                         success: function (json) {
                         alert(student+" marks is updated. ");
                         console.log(json);
                         },
                         error: function (xhr, errmsg, err) {
                         console.log(xhr.status + ": " + xhr.responseText);
                         }
                         });
                        $(this).prop('contenteditable', false)

                    });
                }

                $(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')

            });

        });
    </script>

    <!--
    <script>
        $(document).on('click', '.edit-btn', function(){
            alert("here");
            var divHtml = $(this).html();
            var spanid = $(this).attr("id");
            var editableText = $("<input />");
            editableText.val(divHtml);
            $(this).replaceWith(editableText);
            editableText.focus();

            editableText.blur(function () {
                var html = $(this).val();
                var viewableText = $("<span class='edit " + spanid + "' id='" + spanid + "'>");
                viewableText.html(html);
                $(this).replaceWith(viewableText);
            });
            //var currentTD = $(this).parents("tr").children("td:nth-child(2)");
            //alert(currentTD);
            currentTD.prop("contenteditable","true");


        });
    </script>
-->
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
            <a class="navbar-brand" href="#">Teacher Dashboard</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="/view_edit_profile.php">Profile</a></li>
            <li><a href="#">Inbox</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
    </div>
</nav>


<div class="mdl-grid demo-content">
    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col">
        <div class="profile">
            <h1 class="page-header">Hello Professor <?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']." WHERE Username='".$_SESSION['user']."'"))[2]; ?>!</h1>
            <div class="row">
                <div class="picture-container col-md-2 ">
                    <div class="picture">
                        <img src="http://websamplenow.com/30/userprofile/images/avatar.jpg" class="picture-src" id="wizardPicturePreview" title="">
                        <input type="file" id="wizard-picture" class="">
                    </div>
                </div>
                <div class="col-md-8" >
                    <ul>
                        <li><strong>Name:</strong><?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']." WHERE Username='".$_SESSION['user']."'"))[2]; ?> <?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']." WHERE Username='".$_SESSION['user']."'"))[3]; ?></li>

                        <li><strong>Email Address: </strong><?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']." WHERE Username='".$_SESSION['user']."'"))[4]; ?></li>

                        <li><strong>Department:  </strong><?php echo $_SESSION['department']?></li>

                        <li><strong>DateOfBirth: </strong><?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']." WHERE Username='".$_SESSION['user']."'"))[6]; ?></li>

                        <li><strong>Gender:</strong> <?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']." WHERE Username='".$_SESSION['user']."'"))[7]; ?></li>

                        <li><strong>Profession: </strong>Professor</li>

                        <li><strong>Subjects taken: </strong><?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']." WHERE Username='".$_SESSION['user']."'"))[10]; ?></li>
                    </ul>
                </div>
            </div>
            <br></br>
                    <div align="center">
                        <div class="container-fluid ">
                            <h2 id="forClearing">Performance Report for all students</h2>
                            <div class="pip" style="width: 1000px; height: 400px; overflow: scroll">
                                <table id="approvedusers" class="table table-striped table-hover scroll">
                                    <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Marks</th>
                                        <th>Change Marks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $subject_name=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']." WHERE Username='".$_SESSION['user']."'"))[10];
                                    $table_name=str_replace(' ', '', $_SESSION['department']).$subject_name;
                                    $sql = "SELECT * FROM ".$table_name;
                                    $result=mysqli_query($conn,$sql);
                                    if($result === false) {
                                        echo "error while executing mysql: ";
                                    }
                                    while($row=mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td id=\"username\">".$row['StudentId']."</td>";
                                        echo "<td contenteditable=\"false\">".$row['Marks']."</td>";
                                        echo "<td><button class=\"editbtn\">Edit</button></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br><br>
        </div>
    </div>
</div>

<?php
if(isset($_POST['student'])) {
    $student = $_POST['student'];
    $marks = $_POST['marks'];
    $subject_name=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ".$_SESSION['table_name']." WHERE Username='".$_SESSION['user']."'"))[10];
    $table_name=str_replace(' ', '', $_SESSION['department']).$subject_name;
    $sql = "UPDATE ".$table_name."  SET `Marks`='".$marks."' WHERE `StudentId`='". $student ."'";
    mysqli_query($conn, $sql);
}
?>

</body>

</html>

