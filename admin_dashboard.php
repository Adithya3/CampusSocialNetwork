<!doctype html>
<?php session_start(); ?>
<?php
if(!isset($_SESSION['user']) and $_SESSION['user']!='admin' ){
    header("Location: register_login.php");
}
?>
<?php
$conn = mysqli_connect("localhost","root","root","application");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Administrator Dashboard</title>

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
        tbody {
            overflow-y: scroll;
        }
        p.ui-bar.ui-bar-b { margin: 1em -15px; }
        .ui-bar-f { background: #fff; }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var active_moderator=<?php echo
                mysqli_num_rows(mysqli_query($conn,"SELECT  * FROM Moderator where Active='yes'" ));
                ?>;
            var pending_moderator=<?php echo
                mysqli_num_rows(mysqli_query($conn,"SELECT  * FROM Moderator where Active='no'" ));
                ?>;
            var active_student_compe=<?php echo
                mysqli_num_rows(mysqli_query($conn,"SELECT  * FROM ComputerEngineeringStudentTeacher where Active='yes' and Role='student'" ));
                ?>;
            var active_student_se=<?php echo
                mysqli_num_rows(mysqli_query($conn,"SELECT  * FROM SoftwareEngineeringStudentTeacher where Active='yes' and Role='student'" ));
                ?>;
            var active_student_total=parseInt(active_student_compe)+parseInt(active_student_se);
            var active_teacher_compe=<?php echo
                mysqli_num_rows(mysqli_query($conn,"SELECT  * FROM ComputerEngineeringStudentTeacher where Active='yes' and Role='student'" ));
                ?>;
            var active_teacher_se=<?php echo
                mysqli_num_rows(mysqli_query($conn,"SELECT  * FROM SoftwareEngineeringStudentTeacher where Active='yes' and Role='student'" ));
                ?>;
            var active_teacher_total=parseInt(active_teacher_compe)+parseInt(active_teacher_se);
            var data = google.visualization.arrayToDataTable([
                ['user', 'no.'],
                ['Active Moderator',     active_moderator],
                ['Unapproved Moderator',     pending_moderator],
                ['Student',      active_student_total],
                ['Teacher',    active_teacher_total]
            ]);
            var data2 = google.visualization.arrayToDataTable([
                ['department', 'no.'],
                ['Computer Engineering',     1],
                ['Software Engineering',      1]
            ]);

            var options = {
                title: 'Users'
            };
            var options2 = {
                title: 'Department'
            };

            var chart = new google.visualization.PieChart(document.getElementById('Userpiechart'));
            var chart2 = new google.visualization.PieChart(document.getElementById('Departmentpiechart'));
            chart.draw(data, options);
            chart2.draw(data2, options2);
        }
    </script>

</head>

<script>
    $(document).on('click', '.remove-btn', function(){
        var row = $(this).closest("tr");  // Find the row
        var username1 = row.find("#username").text(); // Find the text
        $(this).closest ('tr').remove ();
        $.ajax({
            url: window.location.href,
            type: "POST",
            data: {
                username_remove: username1
            },
            success: function (json) {
                alert(username1+" is Removed.");
                console.log(json);
            },
            error: function (xhr, errmsg, err) {
                console.log(xhr.status + ": " + xhr.responseText);
            }
        });

    });
</script>
<script>
    $(document).on('click', '.approve-btn', function(){
        var row = $(this).closest("tr");  // Find the row
        var username1 = row.find("#username").text(); // Find the text
        $.ajax({
            url: window.location.href,
            type: "POST",
            data: {
                username: username1
            },
            success: function (json) {
                alert(username1+" is approved. Please refresh to Update table. ");
                console.log(json);
            },
            error: function (xhr, errmsg, err) {
                console.log(xhr.status + ": " + xhr.responseText);
            }
    });

    });
</script>
<?php
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $sql = "UPDATE Moderator  SET `Active`='yes' WHERE `Username`='" . $username . "'";
    mysqli_query($conn, $sql);
}
if(isset($_POST['username_remove'])){
    $username=$_POST['username_remove'];
    $sql="DELETE FROM  Moderator WHERE `Username`='".$username."'";
    mysqli_query($conn,$sql);
}
?>
<body>
<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title"><?php echo $_SESSION['role']?></span>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                    <i class="material-icons">search</i>
                </label>
                <div class="mdl-textfield__expandable-holder">
                    <input class="mdl-textfield__input" type="text" id="search">
                    <label class="mdl-textfield__label" for="search">Enter your query...</label>
                </div>
            </div>
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
                <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
                <li class="mdl-menu__item">About</li>
                <li class="mdl-menu__item">Contact</li>
                <li class="mdl-menu__item">Legal information</li>
            </ul>
        </div>
    </header>
    <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
            <img src="images/user.jpg" class="demo-avatar">
            <div class="demo-avatar-dropdown">
                <span><?php echo $_SESSION['user'];?></span>
                <div class="mdl-layout-spacer"></div>
                <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                    <i class="material-icons" role="presentation">arrow_drop_down</i>
                    <span class="visuallyhidden">Accounts</span>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                    <li class="mdl-menu__item"><?php echo  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM Moderator WHERE Username='".$_SESSION['user']."'"))[4]; ?></li>
                </ul>
            </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
            <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
            <a class="mdl-navigation__link" href="\profile.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">accessibility</i>Profile</a>
            <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
            <a class="mdl-navigation__link " href="\create_depart.php" ><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">add_to_queue</i>Create Department</a>
            <a class="mdl-navigation__link" href="\logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">power_settings_new</i>Logout</a>
            <div class="mdl-layout-spacer"></div>
        </nav>
    </div>
    <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
            <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                <div id="Userpiechart" style="width: 50%;height: 100%;"></div>
                <div id="Departmentpiechart" style="width: 50%;height: 100%;"></div>
            </div>

            <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col">
                <div class="container-fluid ">
                    <h2 id="forClearing">Moderators</h2>
                    <div class="pip" style="width: 1000px; height: 100%; overflow: scroll">
                        <table id="approvedusers" class="table table-striped table-hover scroll">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $ip="ComputerEngineeringStudentTeacher";
                            $sql = "SELECT * FROM Moderator";
                            $result=mysqli_query($conn,$sql);
                            if($result === false) {

                                echo "error while executing mysql: ";
                            }
                            while($row=mysqli_fetch_array($result)) {
                                if ($row['Role']!="Admin"){
                                    echo "<tr>";
                                    echo "<td id=\"username\">".$row['UserName']."</td>";
                                    echo "<td id=\"Email\">".$row['Email']."</td>";
                                    echo "<td id=\"Contact_No.\">".$row['Contact']."</td>";
                                    echo "<td id=\"Role\">".$row['Department']."</td>";
                                    if ($row['Active']=='no'){
                                        echo "<td><div style=\"width: 50%; height: 50%; float:left;\" id='approve'><button class=\"btn btn-default btn-xs approve-btn\" id='approve'>  <i class=\"glyphicon glyphicon-ok\" id='approve'></i></button></div>
                                    <div style=\"width: 50%; height: 50%; float:right;\"><button class=\"btn btn-default btn-xs remove-btn\">  <i class=\"glyphicon glyphicon-remove\"></i></button></div></td>";
                                    }
                                    else{
                                        echo "<td></td>";
                                    }
                                    echo "</tr>";
                                }

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container-fluid">
                    <h2>Active Users</h2>
                    <div class="pip" style="width: 1000px; height: 100%; overflow: scroll">
                        <table id="upapprovedusers" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Role</th>
                                <th>Department</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM SoftwareEngineeringStudentTeacher where Active='yes'";
                            $result=mysqli_query($conn,$sql);
                            if($result === false) {

                                echo "error while executing mysql: ";
                            }
                            while($row=mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td id=\"username\">".$row['UserName']."</td>";
                                echo "<td id=\"Email\">".$row['Email']."</td>";
                                echo "<td id=\"Contact_No.\">".$row['Contact']."</td>";
                                echo "<td id=\"Role\">".$row['Role']."</td>";
                                echo "<td id=\"Department\">Software Engineering</td>";
                                echo "</tr>";
                            }
                            $sql = "SELECT * FROM ComputerEngineeringStudentTeacher where Active='yes'";
                            $result=mysqli_query($conn,$sql);
                            if($result === false) {

                                echo "error while executing mysql: ";
                            }
                            while($row=mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td id=\"username\">".$row['UserName']."</td>";
                                echo "<td id=\"Email\">".$row['Email']."</td>";
                                echo "<td id=\"Contact_No.\">".$row['Contact']."</td>";
                                echo "<td id=\"Role\">".$row['Role']."</td>";
                                echo "<td id=\"Department\">Computer Engineering</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" style="position: fixed; left: -1000px; height: -1000px;">
    <defs>
        <mask id="piemask" maskContentUnits="objectBoundingBox">
            <circle cx=0.5 cy=0.5 r=0.49 fill="white" />
            <circle cx=0.5 cy=0.5 r=0.40 fill="black" />
        </mask>
        <g id="piechart">
            <circle cx=0.5 cy=0.5 r=0.5 />
            <path d="M 0.5 0.5 0.5 0 A 0.5 0.5 0 0 1 0.95 0.28 z" stroke="none" fill="rgba(255, 255, 255, 0.75)" />
        </g>
    </defs>
</svg>
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 500 250" style="position: fixed; left: -1000px; height: -1000px;">
    <defs>
        <g id="chart">
            <g id="Gridlines">
                <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="27.3" x2="468.3" y2="27.3" />
                <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="66.7" x2="468.3" y2="66.7" />
                <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="105.3" x2="468.3" y2="105.3" />
                <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="144.7" x2="468.3" y2="144.7" />
                <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="184.3" x2="468.3" y2="184.3" />
            </g>
            <g id="Numbers">
                <text transform="matrix(1 0 0 1 485 29.3333)" fill="#888888" font-family="'Roboto'" font-size="9">500</text>
                <text transform="matrix(1 0 0 1 485 69)" fill="#888888" font-family="'Roboto'" font-size="9">400</text>
                <text transform="matrix(1 0 0 1 485 109.3333)" fill="#888888" font-family="'Roboto'" font-size="9">300</text>
                <text transform="matrix(1 0 0 1 485 149)" fill="#888888" font-family="'Roboto'" font-size="9">200</text>
                <text transform="matrix(1 0 0 1 485 188.3333)" fill="#888888" font-family="'Roboto'" font-size="9">100</text>
                <text transform="matrix(1 0 0 1 0 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">1</text>
                <text transform="matrix(1 0 0 1 78 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">2</text>
                <text transform="matrix(1 0 0 1 154.6667 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">3</text>
                <text transform="matrix(1 0 0 1 232.1667 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">4</text>
                <text transform="matrix(1 0 0 1 309 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">5</text>
                <text transform="matrix(1 0 0 1 386.6667 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">6</text>
                <text transform="matrix(1 0 0 1 464.3333 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">7</text>
            </g>
            <g id="Layer_5">
                <polygon opacity="0.36" stroke-miterlimit="10" points="0,223.3 48,138.5 154.7,169 211,88.5
              294.5,80.5 380,165.2 437,75.5 469.5,223.3 	"/>
            </g>
            <g id="Layer_4">
                <polygon stroke-miterlimit="10" points="469.3,222.7 1,222.7 48.7,166.7 155.7,188.3 212,132.7
              296.7,128 380.7,184.3 436.7,125 	"/>
            </g>
        </g>
    </defs>
</svg>
<a href="" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white">Chat</a>
<script src="https://code.getmdl.io/1.3.0/material.min.js"></script>




</body>

</html>
