/**
 * @memberof starter
 * @ngdoc module
 * @name starter.controllers
 * 
 * 
 * 
 */

angular.module('starter.controllers', [])

/**
 * @memberof starter
 * @ngdoc controller
 * @desc Controller for the 'main-home' view in the 'main.home' state
 * @name HomeCtrl
 * @param $scope {service} controller scope
 * @param Web {service} factory service that holds all the table-specific services for the conference
 * @param $localstorage {service} ngStorage localStorage
 * @param $location {service} ng location
 * @param $http {service} promise http
 * @returns {undefined}
 */
.controller('HomeCtrl', function($scope, Web, Attendee, $localStorage, $location) {

	$scope.bgImage = 'img/backgrounds/4.jpg';

	var presentations = [];
	$scope.presentation = [];

	$scope.submitSpeaker = function() {
		$scope.loading = true;

		Web.Speakers.Create($scope.speakerData)
			.then(function(response) {
					alert('Speaker added!');
					Web.Speakers.List()
						.success(function(data) {
							$scope.speakers = data;
							$scope.loading = false;
						});
				},
				function(response) {
					alert('Something went wrong with the login process. Try again later!');
				}
			);

	};

	$scope.loading = true;

	Web.Speakers.List()
		.success(function(data) {
			$scope.speakers = data;
			$scope.loading = false;
			// alert('Reached here with ' + $scope.speakers);
		});

	$scope.deleteSpeaker = function(id) {
		Web.Speakers.Delete(id, function(response) {
			alert("Speaker deleted");
			Web.Speakers.List()
				.success(function(data) {
					$scope.speakers = data;
				});
		}, function(response) {
			alert("Error!!!");
		});
	};

	$scope.loading = true;

	Attendee.Conferences($localStorage.currentUser.id)
		.success(function(data) {
			$scope.conferences = data;
			$scope.loading = false;
			//           // alert('Reached here with ' + $scope.speakers);
			angular.forEach(data, function(value, key) {

				Web.Conference.selectPresentation(value.conference_id).success(function(data) {
					$scope.presentation[value.conference_id] = data;

				});
				//        }

			});
		});

	$scope.loading = true;

	$scope.selectPres = function(id) {
		$scope.loading = false;
		console.log(presentations[id].$$state.value.data);

		return presentations[id].$$state.value.data;
	};

	$scope.logout = function() {
		// remove user from local storage and clear http auth header
		Attendee.logout();
		delete $localStorage.currentUser;
		//$http.defaults.headers.common.Authorization = '';
		$location.path('/login');
	};

})

.controller('bgCtrl', function($scope) {
	$scope.bgImage = 'img/backgrounds/3.jpg';
})

/**
 * @memberOf starter
 * @ngdoc controller
 * @name HeaderCtrl
 * @desc Controller for the 'header' view, used in multiple states.
 * @param $scope {service} controller scope
 * @param Attendee {service} factory service that holds all the table-specific services for the conference
 * @param $localstorage {service} ngStorage localStorage
 * @param $location {service} ng location
 * @returns {undefined}
 */
.controller('HeaderCtrl', function($scope, Attendee, $location, $localStorage) {
	// $scope.userDetails = $localStorage.currentUser;

	$scope.logout = function() {
		// remove user from local storage and clear http auth header
		Attendee.Logout();
		// delete $localStorage.currentUser;
		//$http.defaults.headers.common.Authorization = '';
		$location.path('/login');
	};

	$scope.showHelpModal = function($scope) {
		$scope.showModal = true;
	};
})

/**
 * @memberOf starter
 * @ngdoc controller
 * @name SelectCtrl
 * @desc Controller for the 'main-home' view in the 'main.home-presentations' state
 * @param $scope {service} controller scope
 * @param $stateParams {service} Parameters added to the state's url
 * @param Web {service} factory service that holds all the table-specific services for the conference
 * @returns {undefined}
 */
.controller('SelectCtrl', function($scope, $stateParams, Web) {
	Web.Speakers.Select($stateParams.speakerID).success(function(data) {
		$scope.speaker = data;

	});
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name ConfCtrl
 * @param $scope {service} controller scope
 * @param $stateParams {service} Parameters added to the state's url
 * @param Web {service} factory service that holds all the table-specific services for the conference
 * @returns {undefined}
 */
.controller('ConfCtrl', function($scope, $stateParams, Web) {
	Web.Conference.Select($stateParams.conferenceID).success(function(data) {
		$scope.conference = data;

	});

	Web.Conference.Presentations($stateParams.conferenceID).success(function(data) {
		$scope.presentations = data;
	});

	// TODO: Review the function/operation below.
	Web.Speakers.Conferences($stateParams.conferenceID).success(function(data) {
		$scope.speakers = data;
	});

	$scope.deleteSpeaker = function(id) {
		Web.Speakers.Delete(id, function(response) {
			alert("Speaker deleted");
			Web.Speakers.Conferences($stateParams.conferenceID)
				.success(function(data) {
					$scope.speakers = data;
				});
		}, function(response) {
			alert("Error!!!");
		});
	};
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name LoginCtrl
 * @param {type} $scope controller scope
 * @param {type} Attendee factory service that holds all the table-specific services for the conference
 * @param {type} $location
 * @param {type} $routeParams Query Parameters
 * @param {type} $localStorage ngStorage localStorage
 * @returns {undefined}
 */
.controller('LoginCtrl', function($scope, Attendee, $location, $localStorage) {
	if (Attendee.IsLogged())
		$location.path('/main/home');

	$scope.bgImage = 'img/backgrounds/3.jpg';

	$scope.loginAttendee = function() {
		$scope.loading = true;
		Attendee.Login($scope.attendeeData.email, $scope.attendeeData.password)
			.then(function(response) {
					alert('Login Successful!');

					$scope.loading = false;
					/*
					// Store username and token in local storage to keep user logged in between page refreshes
					$localStorage.currentUser = {
						username: response.data.user.name,
						token: response.data.token,
						id: response.data.user.attendee_id
					};*/

					// add jwt token to auth header for all requests made by the $http service
					$location.path('/main/home');
				},
				function(response) {
					alert('Something went wrong with the login process. Try again later!');
				}
			);

	};
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name LoginClientCtrl
 * @param {type} $scope controller scope
 * @param {type} Web factory service that holds all the table-specific services for the conference
 * @param {type} $location
 * @param {type} $http promise http
 * @param {type} $localStorage ngStorage localStorage
 * @returns {undefined}
 */
.controller('LoginClientCtrl', function($scope, Web, $location, $http, $localStorage) {
	$scope.loginClient = function() {

		$scope.loading = true;

		Web.Clients.Login($scope.clientData)
			.then(function(response) {
					alert('Login Successful! ' + response.data.user.contact_name);
					$scope.loading = false;
					//console.log(response.data);
					//console.log(response.data.user);
					// store username and token in local storage to keep user logged in between page refreshes
					$localStorage.currentUser = {
						username: response.data.user.contact_name,
						token: response.data.token
					};

					// add jwt token to auth header for all requests made by the $http service

					$http.defaults.headers.common.Authorization = 'Bearer ' + response.data.token;
					$location.path('/client/profile');

				},
				function(response) {
					alert('Something went wrong with the login process. Try again later!');
				}
			);

	};
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name RegCtrl
 * @param {type} $scope controller scope 
 * @param {type} Web factory service that holds all the table-specific services for the conference
 * @param {type} $location
 * @returns {undefined}
 */
.controller('RegCtrl', function($scope, Web, $location) {
	$scope.bgImage = 'img/backgrounds/3.jpg';

	$scope.submitAttendee = function() {

		$scope.loading = true;

		if ($scope.attendeeData.password !== $scope.pword) {
			alert("passwords don't match!");
			return;
		}

		Web.Attendees.Register($scope.attendeeData)
			.then(function(response) {
					alert('Attendee added!');
					$location.path('/login').search({
						email: $scope.attendeeData.email
					});

				},
				function(response) {
					alert('Something went wrong with the login process. Try again later!');
				}
			);
	};
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name RegClientCtrl
 * @param {type} $scope
 * @param {type} Web
 * @param {type} $location
 * @returns {undefined}
 */
.controller('RegClientCtrl', function($scope, Web, $location) {
	$scope.submitClient = function() {

		$scope.loading = true;

		if ($scope.clientData.password !== $scope.pword) {
			alert("passwords don't match!");
			return;
		}

		Web.Clients.Register($scope.clientData)
			.then(function(response) {
					alert('Client added!');
					$location.path('/client/login');

				},
				function(response) {
					alert('Something went wrong with the registration process. Try again later!');
				}
			);
	};
})

/**
 * @memberof starter
 * @ngdoc controller
 * @name ForgotPassCtrl
 * @param {type} $scope
 * @param {type} Web
 * @param {type} $location
 * @returns {undefined}
 */
.controller('ForgotPassCtrl', function($scope, Web, $location) {
	$scope.sendEmail = function() {
		$scope.loading = true;

		Web.Attendee.ForgotPassword($scope.attendeeData.email)
			.then(function(response) {
					alert('Email Sent!');
				},
				function(response) {
					alert('Email was unsuccessful.');
				}
			);

		$scope.location = false;
	};

})

/**
 * @memberof starter
 * @ngdoc controller
 * @name ResetPassCtrl
 * @param {type} $scope
 * @param {type} $stateParams
 * @param {type} Attendee
 * @returns {undefined}
 */
.controller('ResetPassCtrl', function($scope, $stateParams, Attendee) {
	$scope.sendEmail = function() {
		$scope.loading = true;
		$scope.attendeeData.token = $stateParams.token;
		$scope.attendeeData.email = $stateParams.email;
		console.log($stateParams);

		Attendee.ResetPassword($scope.attendeeData)
			.then(function(response) {
					alert('Password successfully reset!');
				},
				function(response) {
					alert('Password reset unsuccessful.');
				}
			);

		$scope.location = false;
	}
})

.controller('MainCtrl', function($scope) {})

.controller('AccountCtrl', function($scope) {
	$scope.settings = {
		enableFriends: true
	};
});

/*
//POPUP CONTROLLER FOR HELP AND REPORT BUG
.controller('ModalCtrl', function($scope, $uibModal, $log) {
    $scope.animationsEnabled = true;

    $scope.items = ['item1', 'item2', 'item3'];

     $scope.open = function (size) {

    var modalInstance = $uibModal.open({   //to be edited 
      animation: $scope.animationsEnabled,
      templateUrl: 'myModalContent.html',
      controller: 'ModalInstanceCtrl',
      size: size,
      resolve: {
        items: function () {
          return $scope.items;
        }
      }
    });
    modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());  //logs change
    });
  };

  $scope.toggleAnimation = function () {
    $scope.animationsEnabled = !$scope.animationsEnabled;  //for toggling animation.
  };

})

.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, items) {

  $scope.items = items;
  $scope.selected = {
    item: $scope.items[0]
  };

  $scope.ok = function () {
    $uibModalInstance.close($scope.selected.item); //passes selected item. can be used for conference_id selections
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});*/