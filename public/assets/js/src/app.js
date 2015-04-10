angular
.module('app', [])
.factory('calculator', function() {
    return new Calculator(new Stack());
})
.controller('CalculatorCtrl', function($scope, $http, calculator) {
    $scope.addNumber = function(n) {
        calculator.addNumber(n);
        updateExpression();
    };

    $scope.addOperator = function(o) {
        calculator.addOperator(o);
        updateExpression();
    };

    $scope.del = function() {
        calculator.deleteTop();
        updateExpression();
    };

    $scope.clear = function() {
        calculator.clear();

        $scope.expression = '';
    };

    $scope.solve = function() {
        $http
            .post('/api/calculator/solve', {expr: $scope.expression})
            .success(function(response) {
                $scope.clear();
                $scope.addNumber(response.result);
            });
    };

    function updateExpression() {
        $scope.expression = calculator.getExpression();
    }
});

