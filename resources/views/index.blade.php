<!DOCTYPE html>
<html style="min-height: 100vh;">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
	<title></title>

	<link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- <link href="templates/registration.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">    

	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/form-elements.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/tabbedcon.css">
	<link rel="stylesheet" href="css/texthide.css">
	<link href="css/registration.css" rel="stylesheet">

	<!--bower components -->
	<script src="{{URL::asset('public/vendor/angular/angular.min.js')}}"></script>
	<script src="{{URL::asset('public/vendor/angular-ui-router/release/angular-ui-router.min.js')}}"></script>
	<script src="{{URL::asset('vendor/angularUtils-pagination/dirPagination.js')}}"></script>
	<script src="{{URL::asset('vendor/ng-backstretch/dist/ng-backstretch.js')}}"></script>

	<script src="js/ngStorage.min.js"></script>

	<!-- your app's js -->
	<script src="js/app.js"></script>
	<script src="js/controllers.js"></script>
	<script src="js/services.js"></script>
	<script src="js/tabbedcon.js"></script>

	<!--jQuery-->
	<!--      <script src="templates/assets/js/jquery-1.11.1.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<!--Bootstrap-->
	<script src="js/bootstrap.min.js"></script>

	<script src="templates/registration.js"></script>

	<!-- Javascript -->

	<script src="js/jquery.backstretch.min.js"></script>
	<script src="js/scripts.js"></script>
	<!--        <style>
            .bgimg{
                 width: 100%;
                 height:100%;
    background-position: center center;
            }
            
        </style>-->

</head>

<body ng-app="starter" style="min-height: 100vh;">
	<!--     <div ui-view="header"></div>-->
	<!--      <div ng-controller="bgCtrl" backstretch backstretch-images="bgImage">-->
	<div ui-view style="min-height: 100vh;">

	</div>

	<!--      </div>-->
	<!--      <div ui-view="footer"></div>-->
</body>

</html>