// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('starter', ['starter.controllers', 'starter.services', 'ui.router', 'ngStorage'])

.run(function ($rootScope, $http, $location, $localStorage) {
        // keep user logged in after page refresh
        if ($localStorage.currentUser) {
            $http.defaults.headers.common.Authorization = 'Bearer ' + $localStorage.currentUser.token;
        }
 
        // redirect to login page if not logged in and trying to access a restricted page
        $rootScope.$on('$locationChangeStart', function (event, next, current) {
            var publicPages = ['/login', '/forgotpass', '/register']; //Pages that should be accessible when not logged in
            var restrictedPage = publicPages.indexOf($location.path()) === -1; //Pages that require login access
            
            //If a restricted page is accessed without login credentials
            if (restrictedPage && !$localStorage.currentUser) {
                $location.path('/login'); //redirect to the login page
            }
            
            //If a public page is accessed with login credentials
            if(publicPages && $localStorage.currentUser){
                $location.path('/main/home'); //redirect to the main homepage
            }
        });
    })

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
          templateUrl: 'templates/header.html',
          controller: 'HeaderCtrl'
      },
      'side-menu': {
        templateUrl: 'templates/side-menu.html'
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
          templateUrl: 'templates/header.html',
          controller: 'HeaderCtrl'
      }, 
        
      'main-home': {
        templateUrl: 'templates/test.html',
        controller: 'SelectCtrl'
      }
    }
  })

    .state('main.home-presentations', {
    url: '/:conferenceID',
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
            templateUrl: 'templates/conference-header.html',
            controller: 'HeaderCtrl'
        },
        'main-home':{
            templateUrl: 'templates/select-conference.html',
            controller: 'ConfCtrl'
        }
     }
/*
     .state('main.presentations', {
       
       url: '/conference/:conferenceID/presentations',
        views:{
          'presentations':{
            templateUrl: 'main-presentation.html'
          }
        }
     })
*/     
  })
  
  .state('test', {
    url: '/test',
    templateUrl: 'templates/test.html',
    controller: 'HomeCtrl'
       
  })



    .state('login', {
      url: '/login',
      templateUrl: 'templates/login.html',
      controller: 'LoginCtrl',
    })


    .state('register', {
      url: '/register',
      templateUrl: 'templates/registration.html',
      controller: 'RegCtrl',
    })

    
    .state('forgotpassword', {
        url:'/forgotpass',
        templateUrl: 'templates/pass-reset.html',
        controller: 'ForgotPassCtrl',
    })


.state('changepassword', {
  url: '/changepass',
  templateUrl: 'templates/change-password.html',
  //controller: ChangePassCtrl.  needs to be created
})



  

  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/main/home');

});

 