/**
 * 
 * @ngdoc directive
 * @name starter
 * 
 * @description
 * 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
 * The starter module contains the configuration for each state of the conference app.
 * @param array {service}  
 * an array of 'requires':
 * 'starter.services' is found in services.js
 * 'starter.controllers' is found in controllers.js
 */
angular.module('starter', ['starter.controllers', 'starter.services', 'ui.router', 'ngStorage', 'angularUtils.directives.dirPagination', 'ng-backstretch'])
/**
 * @memberof starter
 * @param {e} $rootScope
 * 
 * @param {type} $http
 * 
 * @param {type} $location
 * @param {type} $localStorage
 * $localStorage is used to call ngStorage methods.
 * @returns {undefined}
 */
.run(function ($rootScope, $http, $location, $localStorage) {
        // keep user logged in after page refresh
        if ($localStorage.currentUser) {
            $http.defaults.headers.common.Authorization = 'Bearer ' + $localStorage.currentUser.token;
        }
 
        // redirect to login page if not logged in and trying to access a restricted page

//        $rootScope.$on('$locationChangeStart', function (event, next, current) {
//            var loginPages = ['/login', '/forgotpass', '/register', '/client/login', '/client/register']; //Pages that should be accessible when not logged in
//            var publicPages = ['/public']; //Pages that are accessible either logged in or not
//            var restrictedPage = loginPages.indexOf($location.path()) === -1; //Pages that require login access
//            
//            //If a restricted page is accessed without login credentials
//            if (restrictedPage && !$localStorage.currentUser) {
//                $location.path('/login'); //redirect to the login page
//            }
//            
//            //If a public page is accessed with login credentials
//            if(loginPages && $localStorage.currentUser){
//                $location.path('/main/home'); //redirect to the main homepage
//            }
//        });

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
  
//  .state('forms', {
//      url: '',
//      abstract: true,
//      templateUrl: '/templates/.html'
//  })
  

  // Each tab has its own nav history stack:

  .state('main.home', {
    url: '/home',
    views: {
      'header': {
          templateUrl: 'templates/header.html',
          controller: 'HeaderCtrl'
      },
      'main-home': {
        templateUrl: 'templates/main-home.html',
        controller: 'HomeCtrl'
      },
      'footer': {
          templateUrl: 'templates/footer.html'
      },
      'help': {
        templateUrl: 'templates/help.html'
      },
      'report': {
        templateUrl: 'templates/report.html'
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
      },
      'help': {
        templateUrl: 'templates/help.html'
      },
      'report': {
        templateUrl: 'templates/report.html'
      }
    }
  })

    .state('main.home-presentations', {
    url: '/:conferenceID',
    views: {
      'main-home': {
        templateUrl: 'templates/test.html',
        controller: 'SelectCtrl'
      },
      'help': {
        templateUrl: 'templates/help.html'
      },
      'report': {
        templateUrl: 'templates/report.html'
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
        },
      'help': {
        templateUrl: 'templates/help.html'
      },
      'report': {
        templateUrl: 'templates/report.html'
      }
     }

    })
     
    
     
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
  
  
  .state('test', {
    url: '/test',
    templateUrl: 'templates/test.html',
    controller: 'HomeCtrl'
       
  })
  
  .state('client-profile', {
      url: '/client/profile',
      templateUrl: 'templates/client-profile.html'
    })


    .state('login', {
      url: '/login',
      templateUrl: 'templates/login.html',
      controller: 'LoginCtrl'
    })
    
    .state('client-login', {
      url: '/client/login',
      templateUrl: 'templates/client-login.html',
      controller: 'LoginClientCtrl'
    })
    
    
    

    .state('register', {
      url: '/register',
      templateUrl: 'templates/registration.html',
      controller: 'RegCtrl'
    })
    
     .state('client-register', {
      url: '/client/register',
      templateUrl: 'templates/client-registration.html',
      controller: 'RegClientCtrl'
    })

    
    .state('forgotpassword', {
        url:'/forgotpass',
        templateUrl: 'templates/pass-reset.html',
        controller: 'ForgotPassCtrl'
    })


 .state('help', {
        url:'/help',
        templateUrl: 'templates/help.html'
        //controller: 'ForgotPassCtrl',
    })

  

.state('report', {
        url:'/report',
        templateUrl: 'templates/report.html'
        //controller: 'ForgotPassCtrl',
    })
  
  
.state('change-password', {
        url:'/change-password',
        templateUrl: 'templates/change-password.html'
        //controller: 'ForgotPassCtrl',
    })

.state('user', {
        url:'/user',
        templateUrl: 'templates/user.html',
        //controller: 'ForgotPassCtrl',
    })

.state('speaker bio', {
        url:'/speaker',
        templateUrl: 'templates/speaker bio.html'
        //controller: 'ForgotPassCtrl',
    })

.state('private conferences', {
        url:'/private',
        templateUrl: 'templates/private conferences.html'
        //controller: 'ForgotPassCtrl',
    })

.state('conhome', {
        url:'/conhome',
        templateUrl: 'templates/conhome.html'
        //controller: 'ForgotPassCtrl',
    })


//WARRENS TESTING!!!!!!!!!!
//WARRENS TESTING!!!!!!!!!!
//WARRENS TESTING!!!!!!!!!!
//WARRENS TESTING!!!!!!!!!!
//WARRENS TESTING!!!!!!!!!!
//WARRENS TESTING!!!!!!!!!!
//WARRENS TESTING!!!!!!!!!!
//WARRENS TESTING!!!!!!!!!!

.state('maintest', {
    url: '/maintest',
    abstract: true,
    templateUrl: '/templates/maintest.html' 
    
    
    
  })

.state('maintest.public', {
  url: '/public',
  views: {
    'maintestbody': {
      templateUrl: 'templates/maintestpublic.html'
    }
  }
})

.state('maintest.private', {
  url: '/private',
  abstract: true,
  views: {
    'maintestbody': {
      templateUrl: 'templates/contest.html'
    }
  }
})








/*.state('contest', {
    url: '/contest',
    abstract: true,
    templateUrl: '/templates/contest.html'  
    
    
  })*/
  
  

  // Each tab has its own nav history stack:

  .state('maintest.private.schedule', {
    url: '/schedule',
    views: {
      'Page_Body': {
          templateUrl: 'templates/Schedule.html',
          //controller: 'HeaderCtrl'
      }
    }
  })

    .state('maintest.private.speakers', {
    url: '/speakers',
    views: {
      'Page_Body': {
          templateUrl: 'templates/Speakers.html',
          //controller: 'HeaderCtrl'
      }
    }
  })
    .state('maintest.private.map', {
    url: '/map',
    views: {
      'Page_Body': {
          templateUrl: 'templates/map.html',
          //controller: 'HeaderCtrl'
      }
    }
  })

    .state('maintest.private.about', {
    url: '/about',
    views: {
      'Page_Body': {
          templateUrl: 'templates/about.html',
          //controller: 'HeaderCtrl'
      }
    }
  })      

  
  .state('tabbed con', {
        url:'/tabbed',
        templateUrl: 'templates/tabbed con.html'
        //controller: 'ForgotPassCtrl',
    })
  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/login');

});

 