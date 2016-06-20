// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('starter', ['starter.controllers', 'starter.services', 'ui.router'])

.config(function($stateProvider, $urlRouterProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider

  .state('main', {
    url: '/main',
    abstract: true,
    templateUrl: '/templates/main.html'  
    
    
  })
  
  

  // Each tab has its own nav history stack:

  .state('main.home', {
    url: '/home',
    views: {
      'header': {
          templateUrl: 'templates/header.html'
      },
      'main-home': {
        templateUrl: 'templates/main-home.html',
        controller: 'HomeCtrl'
      },
      
      'footer': {
          templateUrl: 'templates/footer.html'
      }
    }
  })
  
   .state('main.home-speakers', {
    url: '/:speakerID',
    views: {
       'header': {
          templateUrl: 'templates/header.html'
      }, 
        
      'main-home': {
        templateUrl: 'templates/test.html',
        controller: 'SelectCtrl'
      }
    }
  })

    .state('main.home-presentations', {
    url: '/:presentationID',
    views: {
      'main-home': {
        templateUrl: 'templates/test.html',
        controller: 'SelectCtrl'
      }
    }
  })
  
  .state('main.test', {
    url: '/test',
    templateUrl: 'templates/test.html',
    controller: 'HomeCtrl'
       
  })
  
  .state('main.conference', {
      url: '/conference/:conferenceID',
       views:{
        'header':{
            templateUrl: 'templates/conference-header.html'   
        },
        'main-home':{
            templateUrl: 'templates/select-conference.html',
            controller: 'ConfCtrl'
        }
     }
     
  })
  
  .state('test', {
    url: '/test',
    templateUrl: 'templates/test.html',
    controller: 'HomeCtrl'
       
  })



    .state('login', {
      url: '/login',
      templateUrl: 'templates/login.html',
      controller: 'loginCtrl',
    })


    .state('register', {
      url: '/register',
      templateUrl: 'templates/register.html',
      controller: 'RegCtrl',
    })

  




  

  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/login');

});
