/**
 * 
 * @ngdoc module
 * @name starter
 * 
 * @description
 * 'starter' is the name of this angular module example (also set in a '<body>' attribute in index.html)
 * The starter module contains the configuration for each state of the conference app.
 * @param array {service}  
 * an array of 'requires':
 * 'starter.services' is found in services.js
 * 'starter.controllers' is found in controllers.js
 */

angular.module('starter', [
		'starter.controllers',
		'starter.services',
		'ui.router',
		'ngStorage',
		'angularUtils.directives.dirPagination',
		'ng-backstretch'
	])
	/**
	 * @memberof starter
	 * @ngdoc run
	 * @name run
	 * @desc determines actions to take when the run event of the application is called
	 * @param {e} $rootScope
	 * 
	 * @param {type} $http
	 * 
	 * @param {type} $location
	 * @param {type} $localStorage
	 * $localStorage is used to call ngStorage methods.
	 * @returns {undefined}
	 */

.run(function($rootScope, $http, $location, $localStorage) {
			// keep user logged in after page refresh
			if ($localStorage.currentUser) {
				$http.defaults.headers.common.Authorization = 'Bearer ' + $localStorage.currentUser.token;
			}
			/*
			 * This section is currently commented out to make testing easier
			 */
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
		}

	)
	/**
	 * @memberof starter
	 * @ngdoc config
	 * @name states
	 * @desc Contains all the states for the application.
	 * @param {type} $stateProvider
	 * @param {type} $urlRouterProvider
	 * @returns {undefined}
	 */

.config(function($stateProvider, $urlRouterProvider) {

		// Ionic uses AngularUI Router which uses the concept of states
		// Learn more here: https://github.com/angular-ui/ui-router
		// Set up the various states which the app can be in.
		// Each state's controller can be found in controllers.js
		$stateProvider
		/**
		 * @memberof states
		 * @name main
		 * @ngdoc state
		 * @desc The abstract state for main.
		 * This is the parent state that will be called for all states related to main
		 */
			.state('main', {
				url: '/main',
				abstract: true,
				templateUrl: '/templates/main/main.html'
			})
			//  .state('forms', {
			//      url: '',
			//      abstract: true,
			//      templateUrl: '/templates/.html'
			//  })
			// Each tab has its own nav history stack:
			/**
			 * @memberof states
			 * @name main.home
			 * @ngdoc state
			 * @desc Child state of main.
			 * This is the state for the main homepage when the attendee successfully logs in
			 */
			.state('main.home', {
				url: '/home',
				views: {
					'header': {
						templateUrl: 'templates/main/home/header.html',
						controller: 'HeaderCtrl'
					},
					'main-home': {
						templateUrl: 'templates/main/home/index.html',
						controller: 'HomeCtrl'
					},
					'footer': {
						templateUrl: 'templates/main/home/footer.html'
					}
				}
			})
			/**
			 * @memberof states
			 * @name main.home-speakers
			 * @ngdoc state
			 * @desc The child state for main.
			 * This is the state that will display a speaker's profile
			 */
			.state('main.home-speakers', {
				url: '/:speakerID',
				views: {
					'header': {
						templateUrl: 'templates/main/home-speakers/header.html',
						controller: 'HeaderCtrl'
					},
					'main-home': {
						templateUrl: 'templates/main/home-speakers/test.html',
						controller: 'SelectCtrl'
					}
				}
			})
			/**
			 * @memberof states
			 * @name main.home-presentations
			 * @ngdoc state
			 * @desc Child state of main.
			 * This displays the presentations for a specific conference
			 */
			.state('main.home-presentations', {
				url: '/:conferenceID',
				views: {
					'main-home': {
						templateUrl: 'templates/main/home-presentations/test.html',
						controller: 'SelectCtrl'
					},
					'help': {
						templateUrl: 'templates/main/home-presentations/help.html'
					},
					'report': {
						templateUrl: 'templates/main/home-presentations/report.html'
					}
				}
			})
			/**
			 * @memberof states
			 * @name main.test
			 * @ngdoc state
			 * @desc Child state of main.
			 * Test state for development purposes
			 */
			.state('main.test', {
				url: '/test',
				templateUrl: 'templates/main/test/test.html',
				controller: 'HomeCtrl'
			})
			/**
			 * @memberof states
			 * @name main.conference
			 * @ngdoc state
			 * @desc Child state of main.
			 * This displays the details of a specific conference
			 */
			.state('main.conference', {
				url: '/conference/:conferenceID',
				views: {
					'header': {
						templateUrl: 'templates/main/conference/header.html',
						controller: 'HeaderCtrl'
					},
					'main-home': {
						templateUrl: 'templates/main/conference/select.html',
						controller: 'ConfCtrl'
					}
				}
			})
			/*
			     .state('main.presentations', {

			       url: '/conference/:conferenceID/presentations',
			        views:{
			          'presentations':{
			            templateUrl: 'template/main/presentation.html'
			          }
			        }
			     })
			*/
			.state('test', {
				url: '/test',
				templateUrl: 'templates/test.html',
				controller: 'HomeCtrl'
			})
			/**
			 * @memberof states
			 * @name client-profile
			 * @ngdoc state
			 * @desc 
			 * This state displays the client's/user's profile
			 */
			.state('client-profile', {
				url: '/client/profile',
				templateUrl: 'templates/client/profile.html'
			})
			/**
			 * @memberof states
			 * @name login
			 * @ngdoc state
			 * @desc 
			 * This state displays the login page and handles the attendee logging in. 
			 */
			.state('login', {
				url: '/login',
				templateUrl: 'templates/attendee/login.html',
				controller: 'LoginCtrl'
			})
			/**
			 * @memberof states
			 * @name client-login
			 * @ngdoc state
			 * @desc 
			 * This state displays the client's login page and handles the client logging in. 
			 */
			.state('client-login', {
				url: '/client/login',
				templateUrl: 'templates/client/login.html',
				controller: 'LoginClientCtrl'
			})
			/**
			 * @memberof states
			 * @name register
			 * @ngdoc state
			 * @desc 
			 * This state displays the registration page and handles the attendee creating a new account. 
			 */
			.state('register', {
				url: '/register',
				templateUrl: 'templates/attendee/registration.html',
				controller: 'RegCtrl'
			})
			/**
			 * @memberof states
			 * @name client-register
			 * @ngdoc state
			 * @desc 
			 * This state displays the client's registration page and handles the client creating a new account. 
			 */
			.state('client-register', {
				url: '/client/register',
				templateUrl: 'templates/client/registration.html',
				controller: 'RegClientCtrl'
			})
			/**
			 * @memberof states
			 * @name forgotpassword
			 * @ngdoc state
			 * @desc 
			 * This state displays the forgot password page. 
			 */
			.state('forgotpassword', {
				url: '/forgotpass',
				templateUrl: 'templates/attendee/forgotpass.html',
				controller: 'ForgotPassCtrl'
			})
			/**
			 * @memberOf states
			 * @name resetpassword
			 * @ngdoc state
			 * @desc
			 * This state displays the reset password page.
			 */
			.state('resetpassword', {
				url: '/resetpass/:token/:email',
				templateUrl: 'templates/attendee/reset-pass.html',
				controller: 'ResetPassCtrl'
			}).state('help', {
				url: '/help',
				templateUrl: 'templates/help.html' //controller: 'ForgotPassCtrl',
			}).state('report', {
				url: '/report',
				templateUrl: 'templates/report.html' //controller: 'ForgotPassCtrl',
			})
			/**
			 * @memberof states
			 * @name change-password
			 * @ngdoc state
			 * @desc 
			 * This state displays the change password page. 
			 */
			.state('change-password', {
				url: '/change-password',
				templateUrl: 'templates/attendee/change-password.html' //controller: 'ForgotPassCtrl',
					//TODO: add controller for change password.
			}).state('user', {
				url: '/user',
				templateUrl: 'templates/user.html', //controller: 'ForgotPassCtrl',
			}).state('speaker bio', {
				url: '/speaker',
				templateUrl: 'templates/speaker-bio.html' //controller: 'ForgotPassCtrl',
			})
			/**
			 * @memberof states
			 * @name private-conferences
			 * @ngdoc state
			 * @desc 
			 * This state displays the registration page and handles the attendee creating a new account.
			 * @todo add controller for private conferences
			 */
			.state('private-conferences', {
				url: '/private',
				templateUrl: 'templates/private conferences.html' //controller: 'ForgotPassCtrl',
			})

      		.state('conhome', {
				url: '/conhome',
				templateUrl: 'templates/conhome.html' //controller: 'ForgotPassCtrl',
			})

			.state('Speakers', {
				url: '/Speakers',
				templateUrl: 'templates/speakers.html' //controller: 'ForgotPassCtrl',
			})

			.state('publicCon', {
				url: '/publicCon',
				templateUrl: 'templates/publicCon.html' //controller: 'ForgotPassCtrl',
			})

			.state('privateCon', {
				url: '/privateCon',
				templateUrl: 'templates/privateCon.html' //controller: 'ForgotPassCtrl',
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
			}).state('maintest.public', {
				url: '/public',
				views: {
					'maintestbody': {
						templateUrl: 'templates/maintestpublic.html'
					}
				}
			}).state('maintest.private', {
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
						templateUrl: 'templates/Schedule.html', //controller: 'HeaderCtrl'
					}
				}
			}).state('maintest.private.speakers', {
				url: '/speakers',
				views: {
					'Page_Body': {
						templateUrl: 'templates/Speakers.html', //controller: 'HeaderCtrl'
					}
				}
			}).state('maintest.private.map', {
				url: '/map',
				views: {
					'Page_Body': {
						templateUrl: 'templates/map.html', //controller: 'HeaderCtrl'
					}
				}
			}).state('maintest.private.about', {
				url: '/about',
				views: {
					'Page_Body': {
						templateUrl: 'templates/about.html', //controller: 'HeaderCtrl'
					}
				}
			}).state('tabbed con', {
				url: '/tabbed',
				templateUrl: 'templates/tabbed con.html' //controller: 'ForgotPassCtrl',
			}) // if none of the above states are matched, use this as the fallback
		$urlRouterProvider.otherwise('/login');
	}

);

