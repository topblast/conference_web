<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title></title>

<!--    <link href="lib/ionic/css/ionic.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">-->

    <!-- IF using Sass (run gulp sass first), then uncomment below and remove the CSS includes above
    <link href="css/ionic.app.css" rel="stylesheet">
    -->

    <!-- ionic/angularjs js -->
<!--    <script src="lib/ionic/js/ionic.bundle.js"></script>-->

    <!-- cordova script (this will be a 404 during development) -->
<!--    <script src="cordova.js"></script>-->
    
    <!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->
    

    <!-- your app's js -->
    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/services.js"></script>
  </head>
  <body ng-app="starter" ng-controller="MainCtrl">
    <!--
      The nav bar that will be updated as we navigate between views.
    -->
   <div class="comment" ng-repeat="speaker in speakers">
        <h3>Speakers #{{ speaker.name }} by {{ speaker.email }}</h3>
        <p>{{ speaker.speaker_id }}</p>
    
        
    </div>
    <!--
      The views will be rendered in the <ion-nav-view> directive below
      Templates are in the /templates folder (but you could also
      have templates inline in this html file if you'd like).
    -->
<!--    <ion-nav-view></ion-nav-view>-->
  </body>
</html>
