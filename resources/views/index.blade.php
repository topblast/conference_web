<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title></title>


    <link href="css/style.css" rel="stylesheet">
    
    <script src="{{URL::asset("public/vendor/angular/angular.min.js")}}"></script> 
    <script src="{{URL::asset("public/vendor/angular-ui-router/release/angular-ui-router.min.js")}}"></script> 
 
    <!-- your app's js -->
    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/services.js"></script>
  </head>
  <body ng-app="starter">
     <div ui-view="header"></div>
      <div ui-view="container">
          
      </div>
      <div ui-view="footer"></div>
  </body>
</html>
