var conferenceAppControllers = angular.module('conferenceAppControllers', ['conferenceAppServices']);



conferenceAppControllers.controller('LoginController', ['$scope', '$http', function ($scope, $http) {

}]);

conferenceAppControllers.controller('SignupController', ['$scope', '$http', function ($scope, $http) {

}]);

conferenceAppControllers.controller('MainController', ['$scope', '$http', 'speakerService', function ($scope, $http, speakerService) {
 $scope.refresh = function(){

        speakerService.getAll(function(response){
            
            $scope.speakers = response;
        
        }, function(){
            
            alert('Some errors occurred while communicating with the service. Try again later.');
        
        });

    }

}]);


