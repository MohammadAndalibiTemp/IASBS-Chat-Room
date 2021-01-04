var app = angular.module('myApp', []);
app.controller('myController', function($scope, $http) {
    $http.get("getMsgList.php")
        .then(function (response) {$scope.lst = response.data;});
});
