angular.module('starter.controllers', [])

.controller('HomeCtrl', function($scope, Web) {
    //$scope.speakers = Web.Speaker.list();
   // alert('Reached here with ' + $scope.speakers);
    // loading variable to show the spinning loading icon
  //  $scope.loading = true;
   
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
   }

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
    }

//    Web.Conference.list()
//        .success(function(data) {
//            $scope.speakers = data;
    $scope.loading = true;

    Web.Conference.list()
        .success(function(data) {
            $scope.conferences = data;
            $scope.loading = false;
//           // alert('Reached here with ' + $scope.speakers);
        });
   
   $scope.loading = true;
   
    $scope.selectPres=function(id){
    Web.Conference.list_presentations(id)
            .success(function (data){
                $scope.presentations = data;
                $scope.loading = false;
    });
    }


    $scope.loading = true;
    
    Web.Conference.listPresentations()
/*        $scope.getConID = function (){

        }

*/
        .success(function(data) {
          $scope.getConferenceID = data;
          $scope.loading = false;
        });


<<<<<<< Updated upstream
=======


>>>>>>> Stashed changes
})

.controller('SelectCtrl', function($scope, $stateParams, Web){
    Web.Speaker.select($stateParams.speakerID).success(function(data){
        $scope.speaker = data;

    })
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
    }
})

.controller('LoginCtrl', function($scope, Web, $location) {
     $scope.loginAttendee=function()
    {
        alert('Function entered!');
         $scope.loading = true;


       Web.Attendee.login($scope.attendeeData, function (response){
                alert('Login Successful!');
                $scope.loading = false;
                 $location.path('/main/home');

            },
            function(response){
                alert('Something went wrong with the login process. Try again later!');
            }
        );
    }
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
    }
})

.controller('ForgotPassCtrl', function($scope, Web, $location) {})

.controller('MainCtrl', function($scope) {})

.controller('AccountCtrl', function($scope) {
  $scope.settings = {
    enableFriends: true
  };
});
