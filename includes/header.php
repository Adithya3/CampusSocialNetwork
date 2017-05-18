
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link media="all" type="text/css" rel="stylesheet" href="./misc/bootstrap.min.css">
	<link media="all" type="text/css" rel="stylesheet" href="./misc/uniform.default.css">
	<link media="all" type="text/css" rel="stylesheet" href="./misc/bootstrap-switch.min.css">
	<link media="all" type="text/css" rel="stylesheet" href="./misc/plugins.css">
	<link media="all" type="text/css" rel="stylesheet" href="./misc/layout.css">
	<link media="all" type="text/css" rel="stylesheet" href="./misc/custom.css">
	<link media="all" type="text/css" rel="stylesheet" href="./misc/style.css">
	<link media="all" type="text/css" rel="stylesheet" href="./misc/service-catalog.css">
	<link media="all" type="text/css" rel="stylesheet" href="./misc/tablesorter-master/dist/css/theme.blue.css">
	<link media="all" type="text/css" rel="stylesheet" href="./misc/font-awesome-4.7.0/css/font-awesome.css">
	<link media="all" type="text/css" rel="stylesheet" href="./misc/font-awesome-4.7.0/css/font-awesome.min.css">
	<script src="misc/tablesorter-master/docs/js/jquery-latest.min.js"></script>
	<script src="misc/jquery-2.1.4.min.js"></script>
	<script src="misc/jquery-migrate.min.js"></script>
	<script src="misc/jquery-ui.min.js"></script>
	<script src="misc/bootstrap.min.js"></script>
	<script src="misc/bootstrap-hover-dropdown.min.js"></script>
	<script src="misc/jquery.slimscroll.min.js"></script>
	<script src="misc/jquery.blockui.min.js"></script>
	<script src="misc/jquery.cokie.min.js"></script>
	<script src="misc/jquery.uniform.min.js"></script>
	<script src="misc/bootstrap-switch.min.js"></script>
	<script src="misc/tableExport.js"></script>
	<script src="misc/jquery.base64.js"></script>
	<script src="misc/metronic.js"></script>
	<script src="misc/layout.js"></script>
	<script src="misc/quick-sidebar.js"></script>
	<!--<link media="all" type="text/css" rel="stylesheet" href="./misc/font-awesome.min.css"> -->

	<script src="misc/tablesorter-master/dist/js/jquery.tablesorter.min.js"></script>
	<script src="misc/tablesorter-master/js/jquery.tablesorter.js"></script>
	<script src="misc/tablesorter-master/js/jquery.tablesorter.widgets.js"></script>


	<link href="./misc/prettify.css" rel="stylesheet">
	<script src="misc/prettify.js"></script>


</head>

<style>
    body {
        margin-top: 20px;
        margin-bottom: 10px;
        margin-right: 10px;
        margin-left: 10px;
    }
	table.tablesorter {
		font-family: arial;
		background-color: #CDCDCD;
		margin: 10px 0pt 15px;
		font-size: 10pt;
		width: 100%;
		text-align: left;
	}
</style>
<style>

	.tablesorter .filtered {
		display: none;
	}

	/* All of the following css is already contained within each theme file; modify it as desired */
	/* filter row */
	.tablesorter-filter-row td {
		background: #eee;
		line-height: normal;
		text-align: center; /* center the input */
		-webkit-transition: line-height 0.1s ease;
		-moz-transition: line-height 0.1s ease;
		-o-transition: line-height 0.1s ease;
		transition: line-height 0.1s ease;
	}
	/* optional disabled input styling */
	.tablesorter-filter-row .disabled {
		opacity: 0.5;
		filter: alpha(opacity=50);
		cursor: not-allowed;
	}

	/* hidden filter row */
	.tablesorter-filter-row.hideme td {
		/*** *********************************************** ***/
		/*** change this padding to modify the thickness     ***/
		/*** of the closed filter row (height = padding x 2) ***/
		padding: 2px;
		/*** *********************************************** ***/
		margin: 0;
		line-height: 0;
		cursor: pointer;
	}
	.tablesorter-filter-row.hideme * {
		height: 1px;
		min-height: 0;
		border: 0;
		padding: 0;
		margin: 0;
		/* don't use visibility: hidden because it disables tabbing */
		opacity: 0;
		filter: alpha(opacity=0);
	}

	/* filters */
	.tablesorter-filter {
		width: 95%;
		height: inherit;
		margin: 4px;
		padding: 4px;
		background-color: #fff;
		border: 1px solid #bbb;
		color: #333;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		-webkit-transition: height 0.1s ease;
		-moz-transition: height 0.1s ease;
		-o-transition: height 0.1s ease;
		transition: height 0.1s ease;
	}
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;

    }
    ul#variable-list li {
        display: block;
        display:inline;
        padding: 16px;
    }

     div#variable_box {
         background-color: lightgrey;
         width: 80%;
         border: 3px solid black;
         padding: 25px;
         margin: 25px;

     }
	.panel-login {
		border-color: #ccc;
		-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
		-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
		box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	}
	.panel-login>.panel-heading {
		color: #00415d;
		background-color: #fff;
		border-color: #fff;
		text-align:center;
	}
	.panel-login>.panel-heading a{
		text-decoration: none;
		color: #666;
		font-weight: bold;
		font-size: 15px;
		-webkit-transition: all 0.1s linear;
		-moz-transition: all 0.1s linear;
		transition: all 0.1s linear;
	}
	.panel-login>.panel-heading a.active{
		color: #029f5b;
		font-size: 18px;
	}
	.panel-login>.panel-heading hr{
		margin-top: 10px;
		margin-bottom: 0px;
		clear: both;
		border: 0;
		height: 1px;
		background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
		background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
		background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
		background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	}
	.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
		height: 45px;
		border: 1px solid #ddd;
		font-size: 16px;
		-webkit-transition: all 0.1s linear;
		-moz-transition: all 0.1s linear;
		transition: all 0.1s linear;
	}
	.panel-login input:hover,
	.panel-login input:focus {
		outline:none;
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		box-shadow: none;
		border-color: #ccc;
	}
	.btn-login {
		background-color: #59B2E0;
		outline: none;
		color: #fff;
		font-size: 14px;
		height: auto;
		font-weight: normal;
		padding: 14px 0;
		text-transform: uppercase;
		border-color: #59B2E6;
	}
	.btn-login:hover,
	.btn-login:focus {
		color: #fff;
		background-color: #53A3CD;
		border-color: #53A3CD;
	}
	.forgot-password {
		text-decoration: underline;
		color: #888;
	}
	.forgot-password:hover,
	.forgot-password:focus {
		text-decoration: underline;
		color: #666;
	}

	.btn-register {
		background-color: #1CB94E;
		outline: none;
		color: #fff;
		font-size: 14px;
		height: auto;
		font-weight: normal;
		padding: 14px 0;
		text-transform: uppercase;
		border-color: #1CB94A;
	}
	.btn-register:hover,
	.btn-register:focus {
		color: #fff;
		background-color: #1CA347;
		border-color: #1CA347;
	}

</style>
