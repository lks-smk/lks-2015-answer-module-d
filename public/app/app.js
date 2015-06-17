/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/10/15
 */

var app = angular.module('koperasi', ['ngRoute', 'koperasi.ui', 'koperasi.data']);

/**
 * Base Configuration
 *
 * Register routing and init lazy loading for controller
 */
app.config(['$routeProvider', '$controllerProvider', function ($routeProvider, $controllerProvider) {

	app.registerCtrl = $controllerProvider.register;

	/**
	 * Loader Service
	 * Lazy load controller
	 *
	 * @param name
	 * @returns {{load: Function}}
	 */
	function loader(name) {

		return {

			load: function () {

				$.getScript('app/controllers/' + name + '.js');
			}
		};
	}

	$routeProvider.when('/', {

		templateUrl: 'view/guest/simulation',
		controller: 'SimulationController',
		resolve: loader('SimulationController'),
		active: 'simulation'
	});

	$routeProvider.when('/dashboard', {

		templateUrl: 'view/auth/dashboard',
		controller: 'DashboardController',
		resolve: loader('DashboardController'),
		active: 'dashboard'
	});

	$routeProvider.when('/history', {

		templateUrl: 'view/auth/history',
		controller: 'HistoryController',
		resolve: loader('HistoryController'),
		active: 'history'
	});

	$routeProvider.when('/history/:requestId', {

		templateUrl: 'view/auth/debt',
		controller: 'DebtController',
		resolve: loader('DebtController'),
		active: 'history'
	});
}]);

/**
 * Controller that handle side bar
 */
app.controller('SideBarController', function ($scope, $route) {

	$scope.$route = $route;
});
