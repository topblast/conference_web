angular.module('starter.services', [])

.factory('Web', function($http){
	var API_LOCATION = 'http://localhost:8000/';
	return {
		user: {},
                
                Client: {
                        login: function(onSuccess, onError){
                            
                        },
                        register: function(onSuccess, onError) {
                            
                        },
                        
                        delete: function(id){
                            
                        },
                },
                
		Speaker: {
			
			list: function(onSuccess, onError) {
				var self = this;
				self.user = {};
				return $http.get(API_LOCATION + 'speakers/');
			},
                        
                        select: function(id){
                                return $http.get(API_LOCATION + 'speakers/' + id);
                        },
                        
                        selectConf: function(id){
                            return $http.get(API_LOCATION + 'speakers/' + id + '/conferences');
                        },
                        
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
		
		Conference: {
			list: function(onSuccess, onError) {
				var self = this;
				self.user = {};
				return $http.get(API_LOCATION + 'conferences/');

			},
<<<<<<< HEAD
=======

>>>>>>> origin/dev

			listPresentations: function(id, onSuccess, onError) { 


				return $http.get(API_LOCATION + 'conference/' + id + '/presentations');
<<<<<<< HEAD
			}

					},
/*			
		Presentation: {
			list: function(onSuccess, onError, id) {
				var self = this;
				self.user = {};
				return $http.get(API_LOCATION + 'conferences/' + id + '/presentations/');
//				.then (function(response){
//					self.user = response;
//					onSuccess(response);
//				}, onError);
=======
			},

                        
                     
                        
                        select: function(id){
                            return $http.get(API_LOCATION + 'conferences/' + id);
                        },

>>>>>>> origin/dev
			},


		Sponsor: {
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
		Attendee:	{
			login: function(credentials, onSuccess, onError) {
				var self = this;
				self.user = {};
				$http.post(API_LOCATION + 'attendees/login', credentials)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
			changepass:  function(id, onSuccess, onError) {
				var self = this;
				self.user = {};
				$http.post(API_LOCATION + 'attendees/{id}/changepassword', id)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
			register: function(credentials, onSuccess, onError) {
				var self = this;
				self.user = {};
				$http.post(API_LOCATION + 'attendees/register', credentials)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
			deleteAccount: function(credentials, onSuccess, onError) {
				var self = this;
				self.user = {};
				$http.delete(API_LOCATION + 'attendees/{id}', credentials)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
			update: function(id, onSuccess, onError) {
				var self = this;
				self.user = {};
				$http.put(API_LOCATION + 'attendees/{id}', id)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			}
		}
	}
});
			

