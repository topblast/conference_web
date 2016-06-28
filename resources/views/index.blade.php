<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title></title>


    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tabbedcon.css">
    <link rel="stylesheet" href="css/texthide.css">
    <link href="templates/registration.css" rel="stylesheet">
    
    
    
    <script src="{{URL::asset("public/vendor/angular/angular.min.js")}}"></script> 
    <script src="{{URL::asset("public/vendor/angular-ui-router/release/angular-ui-router.min.js")}}"></script> 
    <script src="js/ngStorage.min.js"></script>
    <script src="{{URL::asset("vendor/angular-sanitize/angular-sanitize.min.js")}}"></script>
    <script src="{{URL::asset("vendor/angular-read-more/dist/readmore.js")}}"></script>
 
    <!-- your app's js -->
    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/services.js"></script>
    <script src="js/tabbedcon.js"></script>
    
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <!--Bootstrap-->
    <script src="js/bootstrap.min.js"></script>
    
    <script src="templates/registration.js"></script>
  </head>
  <body ng-app="starter">
<!--     <div ui-view="header"></div>-->
      <div ui-view>
          
      </div>
<!--      <div ui-view="footer"></div>-->
  </body>
</html>
