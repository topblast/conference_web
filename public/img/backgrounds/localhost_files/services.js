/**
 * @memberof starter
 * @ngdoc module
 * @name starter.services
 * 
 */

angular.module('starter.services', [])

/**
 * @memberof starter.services
 * @ngdoc factory
 * @name Web
 * @desc Contains services for each table in the database.
 *  Each service has methods.
 *  These methods call API routes in the backend of the program to achieve their results
 * @param $http {service} AngularJS' ng http service
 * @returns {services_L13.servicesAnonym$1}
 */
.factory('Web', function($http) {
		var Web;
		(function(Web) {
			var API_LOCATION = 'http://localhost:8000/';
			/**
			 * @memberof Web
			 * @ngdoc service
			 * @name Attendee
			 * @description A list of methods dealing with the attendees table.
			 */
			var Attendees = (function() {
				function Attendees() {}
				/**
				 * Attempts to login the client, passing the user's credentials as parameters.
				 * @memberof Web.Attendee
				 * @method Login
				 * @param {type} credentials the clients login credentials: email and password.
				 * @returns {Promise}
				 */
				Attendees.Login = function(credentials) {
					return $http.post(API_LOCATION + 'attendees/login', credentials);
				};
				/**
				 * Calls API route for attendee logout
				 * @memberof Web.Attendee
				 * @method Logout
				 * @returns {Promise}
				 */
				Attendees.Logout = function() {
					return $http.get(API_LOCATION + 'attendees/logout');
				};
				/**
				 * Calls API route for changing attendee password.
				 * @memberof Web.Attendee
				 * @method ChangePassword
				 * @param {type} id attendee's id
				 * @returns {Promise}
				 */
				Attendees.ChangePassword = function(id) {
					return $http.get(API_LOCATION + 'attendees/' + id + '/changepassword');
				};
				/**
				 * Calls API route for an attendee's forgotten password
				 * @memberof Web.Attendee
				 * @method ForgotPassword
				 * @param {type} email the attendee's email
				 * @returns {Promise}
				 */
				Attendees.ForgotPassword = function(email) {
					return $http.post(API_LOCATION + 'password/email', {
						email: email
					});
				};
				/**
				 * Performs the action of resetting the attendee's password, taking the token as parameter
				 * @memberof Web.Attendee
				 * @method ResetPassword
				 * @param {type} token the password reset token
				 * @returns {Promise}
				 */
				Attendees.ResetPassword = function(attendeeData) {
					return $http.post(API_LOCATION + 'password/reset/' + attendeeData.token, attendeeData);
				};
				/**
				 * Registers a new account for the attendee
				 * @memberof Web.Attendee
				 * @method Register
				 * @param {type} credentials the attendee's credentials (email, username, password)
				 * @returns {Promise}
				 */
				Attendees.Register = function(credentials) {
					return $http.post(API_LOCATION + 'attendees/register', credentials);
				};
				/**
				 * Deletes an attendee's account
				 * @memberof Web.Attendee
				 * @method Delete
				 * @param {type} id the attendee's id
				 * @returns {Promise}
				 */
				Attendees.Delete = function(id) {
					return $http.delete(API_LOCATION + 'attendees/' + id);
				};
				/**
				 * Updates an attendee's details
				 * @memberof Web.Attendee
				 * @method Update
				 * @param {type} id the attendee's id
				 * @param {type} Updated user data
				 * @returns {Promise}
				 */
				Attendees.Update = function(id, updateData) {
					return $http.put(API_LOCATION + 'attendees/' + id, updateData);
				};
				/**
				 * Returns a json array of the conferences the attendee is signed up for upon success, an empty array and 404 error upon failure
				 * @memberof Web.Attendee
				 * @method Conferences
				 * @param {type} id the attendee's id
				 * @returns {Promise}
				 */
				Attendees.Conferences = function(id) {
					return $http.get(API_LOCATION + 'attendees/' + id + '/conferences');
				};
				return Attendees;
			}());
			Web.Attendees = Attendees;
			/**
			 * @memberof Web
			 * @ngdoc service
			 * @description A list of methods dealing with the clients table
			 */
			var Clients = (function() {
				function Clients() {}
				/**
				 * Calls API route for client login, passing the user's credentials as parameters.
				 * @method Login
				 * @memberof Web.Client
				 * @param credentials {Object} the clients login credentials: email and password.
				 * @returns {Promise}
				 */
				Clients.Login = function(credentials) {
					return $http.post(API_LOCATION + 'clients/login', credentials);
				};
				/**
				 * Calls API route for client registration, passing the user's credentials as parameters.
				 * @memberof Web.Client
				 * @method Register
				 * @param credentials {Object} the clients login credentials: email and password.
				 * @returns {Promise}
				 */
				Clients.Register = function(credentials) {
					return $http.post(API_LOCATION + 'clients/register', credentials);
				};
				/**
				 * Deletes client from database.
				 * @memberof Web.Client
				 * @ngdoc service
				 * @method Delete
				 * @param {type} id
				 * @returns {undefined}
				 */
				Clients.Delete = function(id) {};
				return Clients;
			}());
			Web.Clients = Clients;
			/**
			 * @memberof Web
			 * @ngdoc service
			 * @name Conference
			 * @description A list of methods dealing with the conferences table
			 */
			var Conferences = (function() {
				function Conferences() {}
				/**
				 * Gets details on all public conferences.
				 * @memberof Web.Conference
				 * @method List
				 * @returns {Promise}
				 */
				Conferences.List = function() {
					return $http.get(API_LOCATION + 'conferences');
				};
				/**
				 * Gets details on a specific conferences based on id.
				 * @memberof Web.Conference
				 * @method Select
				 * @param id {type} the conference's id.
				 * @returns {Promise}
				 */
				Conferences.Select = function(id) {
					return $http.get(API_LOCATION + 'conferences/' + id);
				};
				/**
				 * Gets details on all presentations held at a specific conference.
				 * @memberof Web.Conference
				 * @method Presentations
				 * @param id {type} the conference's id.
				 * @returns {Promise}
				 */
				Conferences.Presentations = function(conference_id) {
					return $http.get(API_LOCATION + 'conferences/' + conference_id + '/presentations');
				};
				/**
				 * Gets details on the first presentation at a specific conference.
				 * @memberof Web.Conference
				 * @method Presentation
				 * @param id {type} the conference's id.
				 * @returns {Promise}
				 */
				Conferences.Presentation = function(conference_id, presentation_id) {
					return $http.get(API_LOCATION + 'conferences/' + conference_id + '/presentations/' + presentation_id);
				};
				return Conferences;
			}());
			Web.Conferences = Conferences;
			/**
			 * @memberof Web
			 * @ngdoc service
			 * @name Speaker
			 * @description A list of methods dealing with the speakers table
			 */
			var Speakers = (function() {
				function Speakers() {}
				/**
				 * Gets details on all speakers.
				 * @memberof Web.Speaker
				 * @method List
				 * @returns {Promise}
				 */
				Speakers.List = function() {
					return $http.get(API_LOCATION + 'speakers');
				};
				/**
				 * Gets details on all speakers.
				 * @memberof Web.Speaker
				 * @method Select
				 * @returns {Promise}
				 */
				Speakers.Select = function(id) {
					return $http.get(API_LOCATION + 'speakers/' + id);
				};
				/**
				 * Gets details on a conference the speaker is presenting for.
				 * @memberof Web.Speaker
				 * @method Conferences
				 * @param id {type} the Speakers's id.
				 * @returns {undefined}
				 */
				Speakers.Conferences = function(speaker_id) {
					return $http.get(API_LOCATION + 'speakers/' + speaker_id + '/conferences');
				};
				/**
				 * Creates a new speaker.
				 * @memberof Web.Speaker
				 * @method Create
				 * @param speakerData (type) form data containing the speaker's details.
				 * @returns {Promise}
				 */
				Speakers.Create = function(speakerData) {
					return $http.post(API_LOCATION + 'speakers/register', speakerData);
				};
				return Speakers;
			}());
			Web.Speakers = Speakers;
			/**
			 * @memberof Web
			 * @ngdoc service
			 * @name Sponsor
			 * @description A list of methods dealing with the sponsors table
			 */
			var Sponsors = (function() {
				function Sponsors() {}
				/**
				 * Gets details on all sponsors.
				 * @memberof web.Sponsor
				 * @method List
				 * @returns {Promise}
				 */
				Sponsors.List = function() {
					return $http.get(API_LOCATION + 'sponsors');
				};
				return Sponsors;
			}());
			Web.Sponsors = Sponsors;
		})(Web || (Web = {}));
		return Web;
	})
	.factory('Attendee', function($http, Web, $localStorage) {
		var AttendeeService = (function() {
			function AttendeeService() {
				this.User = $localStorage.user_data;
				this.Token = $localStorage.user_token;
			}
			/**
			 * Set the user data to localstorage
			 * @memberof Attendee
			 * @method IsLogged
			 * @returns {boolean}
			 */
			AttendeeService.prototype.SetUser = function(user_data) {
				this.User = user_data;
				$localStorage.user_data = this.User;
			};
			/**
			 * Set the token to localstorage
			 * @memberof Attendee
			 * @method SetToken
			 * @returns {boolean}
			 */
			AttendeeService.prototype.SetToken = function(token) {
				this.Token = token;
				$localStorage.user_token = this.Token;
			};
			/**
			 * Check is the current user is logged in
			 * @memberof Attendee
			 * @method IsLogged
			 * @returns {boolean}
			 */
			AttendeeService.prototype.IsLogged = function() {
				return this.User != null && this.Token != null;
			};
			/**
			 * Log Attendee into Service
			 * @memberof Attendee
			 * @method Login
			 * @param {type} Email the attendee's email
			 * @param {type} Password the attendee's email
			 * @returns {boolean}
			 */
			AttendeeService.prototype.Login = function(email, password) {
				var _this = this;
				return Web.Attendees.Login({
					email: email,
					password: password
				}).then(function(response) {
					_this.SetUser(response.data.user);
					_this.SetToken(response.data.token);
					$http.defaults.headers.common.Authorization = 'Bearer ' + _this.Token;
					return response;
				});
			};
			/**
			 * Logs out of attendee account
			 * @memberof Attendee
			 * @method Logout
			 * @returns {boolean}
			 */
			AttendeeService.prototype.Logout = function() {
				this.SetUser(null);
				this.SetToken(null);
				$http.defaults.headers.common.Authorization = '';
				return Web.Attendees.Logout();
			};
			/**
			 * Send the change password email of the current signed in attendee
			 * @memberof Attendee
			 * @method ChangePassword
			 * @returns {undefined}
			 */
			AttendeeService.prototype.ChangePassword = function() {
				return Web.Attendees.ChangePassword(this.User.attendee_id);
			};
			/**
			 * Get all accessable conferences of the current signed in attendee.
			 * @memberof Attendee
			 * @method Conferences
			 * @returns {undefined}
			 */
			AttendeeService.prototype.Conferences = function() {
				return Web.Attendees.Conferences(this.User.attendee_id);
			};
			return AttendeeService;
		}());
		return new AttendeeService();
	});