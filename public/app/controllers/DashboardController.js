/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
app.registerCtrl('DashboardController', ['$scope', 'applicationService', 'pendingUiService', function($scope, applicationService, pendingUiService) {

	$scope.application = { pending: [] };

	/**
	 * Init scope for pending ui
	 */
	pendingUiService.init($scope);

	/**
	 * Load Pending Application
	 */
	applicationService.getPendingApplications().success(function(response) {

		pendingUiService.load(response);
	});

	/**
	 * Handler when accept application
	 *
	 * @param requestId
	 */
	$scope.application.accept = function(requestId) {

		applicationService.accept(requestId).success(function() {

			pendingUiService.remove(requestId);
		});
	};

	/**
	 * Handler when reject application
	 *
	 * @param requestId
	 */
	$scope.application.reject = function(requestId) {

		applicationService.reject(requestId).success(function() {

			pendingUiService.remove(requestId);
		});
	};

}]);