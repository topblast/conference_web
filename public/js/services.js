angular.module('starter.services', [])

.factory('Web', function($http){
	var API_LOCATION = 'http://localhost:8000/';
	return {
		user: {},
		Speaker: {
			
			list: function(onSuccess=null, onError=null) {
				var self = this;
				self.user = {};
				return $http.get(API_LOCATION + 'speakers/');
//				$http.get(API_LOCATION + 'speakers')
//				.then (function(response){
//					alert("The response is " + response);
//                                        //return response;
//					onSuccess=response;
//                                        //return onSuccess;
//				}, onError);
			},
			create: function(speakerData, onSuccess, onError) {
                                var self = this;
				self.user = {};
                                speakerData.type = 'random';
				//return $http.post(API_LOCATION + 'speakers', speakerData);
                                $http.post(API_LOCATION + 'speakers', speakerData)
                                    .then (function(response){
					self.user = response;
					onSuccess(response);
				}, function(response) 
                                {
                                    onError(response);
                                });
                                
                        },
		},
		Conference: {
			list: function(onSuccess=null, onError=null) {
				var self = this;
				self.user = {};
				return $http.get(API_LOCATION + 'conferences')
//				.then (function(response){
//					self.user = response;
//					onSuccess(response);
//				}, onError);
			},
					},
		Presentation: {
			list: function(onSuccess=null, onError=null) {
				var self = this;
				self.user = {};
				$http.get(API_LOCATION + 'presentations')
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
			
		},
		Sponsor: {
			list: function(onSuccess=null, onError=null) {
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
			login: function(credentials, onSuccess=null, onError=null) {
				var self = this;
				self.user = {};
				$http.post(API_LOCATION + 'attendees/login', credentials)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
			changepass:  function(id, onSuccess=null, onError=null) {
				var self = this;
				self.user = {};
				$http.post(API_LOCATION + 'attendees/{id}/changepassword', id)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
			register: function(crendentials, onSuccess=null, onError=null) {
				var self = this;
				self.user = {};
				$http.post(API_LOCATION + 'attendees/register', credentials)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
			deleteAccount: function(credentials, onSuccess=null, onError=null) {
				var self = this;
				self.user = {};
				$http.delete(API_LOCATION + 'attendees/{id}', credentials)
				.then (function(response){
					self.user = response;
					onSuccess(response);
				}, onError);
			},
			update: function(id, onSuccess=null, onError=null) {
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
})
			

.factory('Chats', function() {
  // Might use a resource here that returns a JSON array

  // Some fake testing data
  var chats = [{
    id: 0,
    name: 'Ben Sparrow',
    lastText: 'You on your way?',
    face: 'img/ben.png'
  }, {
    id: 1,
    name: 'Max Lynx',
    lastText: 'Hey, it\'s me',
    face: 'img/max.png'
  }, {
    id: 2,
    name: 'Adam Bradleyson',
    lastText: 'I should buy a boat',
    face: 'img/adam.jpg'
  }, {
    id: 3,
    name: 'Perry Governor',
    lastText: 'Look at my mukluks!',
    face: 'img/perry.png'
  }, {
    id: 4,
    name: 'Mike Harrington',
    lastText: 'This is wicked good ice cream.',
    face: 'img/mike.png'
  }];

  return {
    all: { 
        list: function() {
      return chats;
        },
    },
    remove: function(chat) {
      chats.splice(chats.indexOf(chat), 1);
    },
    get: function(chatId) {
      for (var i = 0; i < chats.length; i++) {
        if (chats[i].id === parseInt(chatId)) {
          return chats[i];
        }
      }
      return null;
    }
  };
  
   
   });