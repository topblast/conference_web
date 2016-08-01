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
.factory('Web', function($http){
	var API_LOCATION = 'http://localhost:8000/';
	return {
		user: {},
                /**
                 * @memberof Web
                 * @ngdoc service
                 * @description A list of methods dealing with the clients table
                 */
                Client: {
                        /**
                         * Calls API route for client login, passing the user's credentials as parameters.
                         * @method login
                         * @memberof Web.Client
                         * @param credentials {type} the clients login credentials: email and password.
                         * @param onSuccess {type} response to return if login function is successful.
                         * @param onError {type} response to return if login function fails.
                         * @returns {undefined}
                         */
                        login: function(credentials, onSuccess, onError){
                            $http.post(API_LOCATION + 'clients/login', credentials)
				.then (function(response){
					self.user = response;
                                        //alert(self.user.data.token + ' ' + self.user.status);
					onSuccess(response);
				}, onError);
                        },
                        
                        /**
                         * Calls API route for client registration, passing the user's credentials as parameters.
                         * @memberof Web.Client
                         * @method register 
                         * @param credentials {type} the clients login credentials: email and password.
                         * @param onSuccess {type} response to return if login function is successful.
                         * @param onError {type} response to return if login function fails.
                         * @returns {undefined}
                         */
                        register: function(credentials, onSuccess, onError) {
                            $http.post(API_LOCATION + 'clients/register', credentials)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
                        },
                        /**
                         * Deletes client from database.
                         * @memberof Web.Client
                         * @ngdoc service
                         * @method delete
                         * @param {type} id
                         * @returns {undefined}
                         */
                        delete: function(id){
                            
                        },
                },
                /**
                 * @memberof Web
                 * @ngdoc service
                 * @name Speaker
                 * @description A list of methods dealing with the speakers table
                 */
		Speaker: {
			/**
                         * Gets details on all speakers.
                         * @memberof Web.Speaker
                         * @method list 
                         * @param onSuccess {type} response to return if method is successful.
                         * @param onError {type} response to return if method fails.
                         * @returns {undefined}
                         */
			list: function(onSuccess, onError) {
				var self = this;
				self.user = {};
				return $http.get(API_LOCATION + 'speakers/');
			},
                        
                        /**
                         * Gets details on all speakers.
                         * @memberof Web.Speaker
                         * @method select 
                         * @param onSuccess {type} response to return if method is successful.
                         * @param onError {type} response to return if method fails.
                         * @returns {undefined}
                         */
                        select: function(id){
                                return $http.get(API_LOCATION + 'speakers/' + id);
                        },
                        
                        /**
                         * Gets details on a conference the speaker is presenting for.
                         * @memberof Web.Speaker
                         * @method selectConf 
                         * @param id {type} the conference's id.
                         * @returns {undefined}
                         */
                        selectConf: function(id){
                            return $http.get(API_LOCATION + 'speakers/' + id + '/conferences');
                        },
                        
                        
                        /**
                         * Creates a new speaker.
                         * @memberof Web.Speaker
                         * @method create
                         * @param speakerData (type) form data containing the speaker's details. 
                         * @param onSuccess {type} response to return if method is successful.
                         * @param onError {type} response to return if method fails.
                         * @returns {undefined}
                         */
			create: function(speakerData, onSuccess, onError) {
				var self = this;
				self.user = {};
                                speakerData.type = 'keynote';
				//return $http.post(API_LOCATION + 'speakers', speakerData);
                                $http.post(API_LOCATION + 'speakers/register', speakerData)
                                    .then (function(response){
					self.user = response;
					onSuccess(response);
				}, function(response) 
                                {
                                    onError(response);
                                });
                                
                                
                        },
                        
                        /**
                         * Deletes a speaker.
                         * @memberof Web.Speaker
                         * @method delete
                         * @param id (type) the speaker's id. 
                         * @param onSuccess {type} response to return if method is successful.
                         * @param onError {type} response to return if method fails.
                         * @returns {undefined}
                         */
                        delete: function(id, onSuccess, onError){
                                $http.delete(API_LOCATION + 'speakers/' + id)
                                        .then(function (response){
                                            self.user = response;
                                            onSuccess(response);
                                }, function(response)
                                {
                                    onError(response);
                                });
                        },
		},
		/**
                 * @memberof Web
                 * @ngdoc service
                 * @name Conference
                 * @description A list of methods dealing with the conferences table
                 */
		Conference: {
                        /**
                         * Gets details on all public conferences.
                         * @memberof Web.Conference
                         * @method list 
                         * @param onSuccess {type} response to return if method is successful.
                         * @param onError {type} response to return if method fails.
                         * @returns {undefined}
                         */
			list: function(onSuccess, onError) {
				var self = this;
                                //alert(self.user);
				//self.user = {};
                               // $http.post(API_LOCATION + 'auth/refresh-token');
				return $http.get(API_LOCATION + 'conferences/');

			},

                        /**
                         * Gets details on a specific conferences based on id.
                         * @memberof Web.Conference
                         * @method select 
                         * @param id {type} the conference's id.
                         * @returns {undefined}
                         */
                        select: function(id){
                            return $http.get(API_LOCATION + 'conferences/' + id);
                        },
                        
                        /**
                         * Gets details on the first presentation at a specific conference.
                         * @memberof Web.Conference
                         * @method selectPresentation
                         * @param id {type} the conference's id.
                         * @returns {undefined}
                         */
                        selectPresentation: function(id){
                            return $http.get(API_LOCATION + 'conferences/' + id + '/presentation/');
                        },
                        
                        /**
                         * Gets details on all presentations held at a specific conference.
                         * @memberof Web.Conference
                         * @method selectPresentation
                         * @param id {type} the conference's id.
                         * @returns {undefined}
                         */
                        selectPresentations: function(id){
                            return $http.get(API_LOCATION + 'conferences/' + id + '/presentations/');
                        }

			}, 

			

	

                /**
                 * @memberof Web
                 * @ngdoc service
                 * @name Sponsor
                 * @description A list of methods dealing with the sponsors table
                 */
		Sponsor: {
                        /**
                         * Gets details on all sponsors.
                         * @memberof web.Sponsor
                         * @method list 
                         * @param onSuccess {type} response to return if method is successful.
                         * @param onError {type} response to return if method fails.
                         * @returns {undefined}
                         */
			list: function(onSuccess, onError) {
				var self = this;
				self.user = {};
				$http.get(API_LOCATION + 'sponsors')
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
			
		},
                /**
                 * @memberof Web
                 * @ngdoc service
                 * @name Attendee
                 * @description A list of methods dealing with the attendees table. 
                 */
		Attendee:	{
                        /**
                         * Attempts to login the client, passing the user's credentials as parameters.
                         * @memberof Web.Attendee
                         * @method login
                         * @param {type} credentials the clients login credentials: email and password.
                         * @param {type} onSuccess response to return if login function is successful.
                         * @param {type} onError response to return if login function fails.
                         * @returns {undefined}
                         */
			login: function(credentials, onSuccess, onError) {
				//var self = this;
				//self.user = {};
				$http.post(API_LOCATION + 'attendees/login', credentials)
				.then (function(response){
					//self.user = response;
                                        //alert(self.user.data.token + ' ' + self.user.status);
					onSuccess(response);
				}, onError);
			},
                        /**
                         * Calls API route for attendee logout
                         * @memberof Web.Attendee
                         * @method logout
                         * @returns {undefined}
                         */
                        logout: function(){
                                $http.post(API_LOCATION + 'attendees/logout')
                                        .then(function(response){
                                           // alert("Logout Successful!");
                                            
                                }, function(response){
                                    //alert("Logout Unsuccessful!");
                                });
                        },
                        /**
                         * Calls API route for changing attendee password.
                         * @memberof Web.Attendee
                         * @method changepass
                         * @param {type} id attendee's id
                         * @param {type} onSuccess
                         * @param {type} onError
                         * @returns {undefined}
                         */
			changepass:  function(id, onSuccess, onError) {
				var self = this;
				self.user = {};
				$http.post(API_LOCATION + 'attendees/{id}/changepassword', id)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
                        /**
                         * Calls API route for an attendee's forgotten password
                         * @memberof Web.Attendee
                         * @method forgotpass
                         * @param {type} email the attendee's email
                         * @param {type} onSuccess 
                         * @param {type} onError
                         * @returns {undefined}
                         */
                        forgotpass: function(email, onSuccess, onError){
                        //        $http.post(API_LOCATION + 'attendees/' + email.email + '/forgotpassword')    
                                $http.post(API_LOCATION + 'password/email', email)
                                .then (function(response){
				//	self.user = response;
					onSuccess(response);
				}, onError);
                        },
                        
                        /**
                         * Performs the action of resetting the attendee's password, taking the token as parameter
                         * @param {type} token the password reset token
                         * @param {type} onSuccess
                         * @param {type} onError
                         * @returns {undefined}
                         */
                        resetpass: function(attendeeData, onSuccess, onError){
                            $http.post(API_LOCATION + 'password/reset/' + attendeeData.token, attendeeData)
                                    .then(function(response){
                                        onSuccess(response);
                            }, onError);
                        },
                        
                        /**
                         * Registers a new account for the attendee
                         * @memberof Web.Attendee
                         * @method register
                         * @param {type} credentials the attendee's credentials (email, username, password)
                         * @param {type} onSuccess 
                         * @param {type} onError
                         * @returns {undefined}
                         */
			register: function(credentials, onSuccess, onError) {
				var self = this;
				self.user = {};
				$http.post(API_LOCATION + 'attendees/register', credentials)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
                        
                        /**
                         * Deletes an attendee's account
                         * @memberof Web.Attendee
                         * @method deleteAccount
                         * @param {type} id the attendee's id
                         * @param {type} onSuccess 
                         * @param {type} onError
                         * @returns {undefined}
                         */
			deleteAccount: function(id, onSuccess, onError) {
				var self = this;
				self.user = {};
				$http.delete(API_LOCATION + 'attendees/' + id)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
                        
                        /**
                         * Updates an attendee's details
                         * @memberof Web.Attendee
                         * @method update
                         * @param {type} email the attendee's email
                         * @param {type} onSuccess 
                         * @param {type} onError
                         * @returns {undefined}
                         */
			update: function(id, onSuccess, onError) {
				var self = this;
				self.user = {};
				$http.put(API_LOCATION + 'attendees/{id}', id)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
                        
                        /**
                         * Returns a json array of the conferences the attendee is signed up for upon success, an empty array and 404 error upon failure
                         * @memberof Web.Attendee
                         * @method getConferences
                         * @param {type} id the attendee's id
                         * @param {type} onSuccess 
                         * @param {type} onError
                         * @returns {undefined}
                         */
                        getConferences: function(id, onSuccess, onError){
                             return $http.get(API_LOCATION + 'attendees/' + id + '/conferences');
                        }
                        
		}
	}
});
			

