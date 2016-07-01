angular.module('starter.controllers', [])

.controller('HomeCtrl', function($scope, Web, $localStorage, $location, $http) {
    //$scope.speakers = Web.Speaker.list();
   // alert('Reached here with ' + $scope.speakers);
    // loading variable to show the spinning loading icon
  //  $scope.loading = true;
  var presentations= [];
  $scope.presentation = [];
   
   $scope.submitSpeaker=function(){
       $scope.loading = true;
       
       Web.Speaker.create($scope.speakerData, function (response){
                alert('Speaker added!');
                Web.Speaker.list()
                .success(function(data) {
                    $scope.speakers = data;
                    $scope.loading = false;
                });
            },
            function(response){
                alert('Something went wrong with the login process. Try again later!');
            }
        );
//               .success(function(data) {
//
//                   Web.Speaker.list()
//                           .success(function(getData){
//                               $scope.speakers = getData;
//                               $scope.loading = false;
//                   })
//       });
   };

   $scope.loading = true;

    Web.Speaker.list()
        .success(function(data) {
            $scope.speakers = data;
            $scope.loading = false;
           // alert('Reached here with ' + $scope.speakers);
        });
    
    

    $scope.deleteSpeaker=function(id){
    Web.Speaker.delete(id, function (response){
        alert("Speaker deleted");
         Web.Speaker.list()
                .success(function(data) {
                    $scope.speakers = data;
                });
        }, function (response){
        alert("Error!!!");
        }
    );
    };

//    Web.Conference.list()
//        .success(function(data) {
//            $scope.speakers = data;
    $scope.loading = true;

    Web.Conference.list()
        .success(function(data) {
            $scope.conferences = data;
            $scope.loading = false;
//           // alert('Reached here with ' + $scope.speakers);
            angular.forEach(data, function(value, key){
    //          console.log(Web.Conference.selectPresentation(value.conference_id).success(function(data){
    //        return data;
    //
    //    }));
    //          if(angular.isUndefined(Web.Conference.selectPresentation(value.conference_id).$$state.value))
    //          {
    //            //console.log(value.conference_id);
    //            $scope.presentation[value.conference_id] = '';
    //          }
    //          
    //          else
    //          {
     //           console.log(Web.Conference.selectPresentation(value.conference_id).$$state.value);
                Web.Conference.selectPresentation(value.conference_id).success(function(data){
                $scope.presentation[value.conference_id] = data;

                });
      //        }

               //console.log('This is 77: ' +  $scope.presentation[77]);
            });
        });
   
   $scope.loading = true;
   
  
   
   $scope.selectPres=function(id){
     $scope.loading = false;
     console.log(presentations[id].$$state.value.data);
     
     return presentations[id].$$state.value.data;
    };





    $scope.logout=function() {
            // remove user from local storage and clear http auth header
            Web.Attendee.logout();
            delete $localStorage.currentUser;
            $http.defaults.headers.common.Authorization = '';
            $location.path('/login');
        };



})

.controller('HeaderCtrl', function($scope, Web, $location, $localStorage, $http) {
    $scope.userDetails = $localStorage.currentUser;
            
    $scope.logout=function() {
            // remove user from local storage and clear http auth header
            Web.Attendee.logout();
            delete $localStorage.currentUser;
            $http.defaults.headers.common.Authorization = '';
            $location.path('/login');
        };
})

.controller('SelectCtrl', function($scope, $stateParams, Web){
    Web.Speaker.select($stateParams.speakerID).success(function(data){
        $scope.speaker = data;

    });
})

.controller('ConfCtrl', function($scope, $stateParams, Web){
    Web.Conference.select($stateParams.conferenceID).success(function(data){
        $scope.conference = data;

    });

    Web.Speaker.selectConf($stateParams.conferenceID).success(function(data){
        $scope.speakers = data;
    });
    
    $scope.deleteSpeaker=function(id){
    Web.Speaker.delete(id, function (response){
        alert("Speaker deleted");
         Web.Speaker.selectConf($stateParams.conferenceID)
                 .success(function(data){
                $scope.speakers = data;
            });
        }, function (response){
        alert("Error!!!");
        }
    );
    };
})

.controller('LoginCtrl', function($scope, Web, $location, $http, $localStorage) {
     $scope.loginAttendee=function()
    {
        
         $scope.loading = true;


       Web.Attendee.login($scope.attendeeData, function (response){
                alert('Login Successful!');
                $scope.loading = false;
                //console.log(response.data);
                //console.log(response.data.user);
                // store username and token in local storage to keep user logged in between page refreshes
                $localStorage.currentUser = { username: response.data.user.name, token: response.data.token };
                 
                // add jwt token to auth header for all requests made by the $http service
                   
                $http.defaults.headers.common.Authorization = 'Bearer ' + response.data.token;
                 $location.path('/main/home');

            },
            function(response){
                alert('Something went wrong with the login process. Try again later!');
            }
        );

       
    };
})

.controller('LoginClientCtrl', function($scope, Web, $location, $http, $localStorage) {
     $scope.loginClient=function()
    {
        
         $scope.loading = true;


       Web.Client.login($scope.clientData, function (response){
                alert('Login Successful! ' + response.data.user.contact_name);
                $scope.loading = false;
                //console.log(response.data);
                //console.log(response.data.user);
                // store username and token in local storage to keep user logged in between page refreshes
                $localStorage.currentUser = { username: response.data.user.contact_name, token: response.data.token };
                 
                // add jwt token to auth header for all requests made by the $http service
                   
                $http.defaults.headers.common.Authorization = 'Bearer ' + response.data.token;
                 $location.path('/client/profile');

            },
            function(response){
                alert('Something went wrong with the login process. Try again later!');
            }
        );

       
    };
})

.controller('RegCtrl', function($scope, Web, $location) {
     $scope.submitAttendee=function()
    {

         $scope.loading = true;

         if($scope.attendeeData.password != $scope.pword)
         {
             alert("passwords don't match!");
             return;
         }

       Web.Attendee.register($scope.attendeeData, function (response){
                alert('Attendee added!');
                 $location.path('/login');
                
            },
            function(response){
                alert('Something went wrong with the login process. Try again later!');
            }
        );
    };
})

.controller('RegClientCtrl', function($scope, Web, $location) {
     $scope.submitClient=function()
    {

         $scope.loading = true;

         if($scope.clientData.password != $scope.pword)
         {
             alert("passwords don't match!");
             return;
         }

       Web.Client.register($scope.clientData, function (response){
                alert('Client added!');
                 $location.path('/client/login');
                
            },
            function(response){
                alert('Something went wrong with the registration process. Try again later!');
            }
        );
    };
})

.controller('ForgotPassCtrl', function($scope, Web, $location) {})

.controller('MainCtrl', function($scope) {})

.controller('AccountCtrl', function($scope) {
  $scope.settings = {
    enableFriends: true
  };
});
