<!DOCTYPE html>
<html>
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
		

    
    <script src="{{URL::asset("public/vendor/angular/angular.min.js")}}"></script> 
    <script src="{{URL::asset("public/vendor/angular-ui-router/release/angular-ui-router.min.js")}}"></script> 
 
    <!-- your app's js -->
    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/services.js"></script>
    
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <!--Bootstrap-->
    <script src="js/bootstrap.min.js"></script>
    
    <script src="templates/registration.js"></script>
	
	 <!-- Javascript -->
        
        <script src="js/jquery.backstretch.min.js"></script>
        <script src="js/scripts.js"></script>
	
  </head>
  <body ng-app="starter">
<!--     <div ui-view="header"></div>-->
      <div ui-view>
          
      </div>
<!--      <div ui-view="footer"></div>-->
  </body>
</html>
