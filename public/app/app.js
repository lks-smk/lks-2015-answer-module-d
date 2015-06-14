/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/10/15
 */

var app = angular.module('KoperasiApp', ['ngRoute']);

app.config(['$routeProvider', '$controllerProvider',  function($routeProvider, $controllerProvider) {

	app.registerCtrl = $controllerProvider.register;

	function controller(name) {

		return {

			load: function() {

				$.getScript('app/controllers/' + name + '.js');
			}
		};
	}

	$routeProvider.when('/', {

		templateUrl: 'view/simulation',
		controller: 'SimulationController',
		resolve: controller('SimulationController')
	});

	$routeProvider.when('/dashboard', {

		templateUrl: 'view/dashboard',
		controller: 'DashboardController',
		resolve: controller('DashboardController')
	});

	$routeProvider.when('/history', {

		templateUrl: 'view/history',
		controller: 'HistoryController',
		resolve: controller('HistoryController')
	});
}]);

app.service('applicationService', ['$http', function($http) {

	return {

		accept: function(requestId) {

			return $http.patch('api/application/' + requestId + '/status/accept');
		},

		reject: function(requestId) {

			return $http.patch('api/application/' + requestId + '/status/reject');
		},

		getPendingApplications: function() {

			return $http.get('api/application');
		}
	};
}]);

app.service('pendingUiService', [function() {

	var scope;

	return {

		init: function($scope) {

			scope = $scope;
		},

		load: function(data) {

			scope.application.pending = data;
		},

		remove: function(requestId) {

			var curr;

			for (var i = 0; i < scope.application.pending.length; i++) {

				curr = scope.application.pending[i];

				if (curr.requestId == requestId) {

					scope.application.pending.splice(i, 1);
					break;
				}
			}
		}
	};
}]);