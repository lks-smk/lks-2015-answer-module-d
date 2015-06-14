/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
app.registerCtrl('DashboardController', function ($scope, creditFactory, pendingUi, topUi, statsUi) {

	$scope.application = {pending: [], top: [], stats: {approved: 0, rejected: 0, pending: 0}};

	/**
	 * Init ui services
	 */
	pendingUi.init($scope);
	topUi.init($scope);
	statsUi.init($scope);

	/**
	 * Load Pending Applications
	 */
	creditFactory.getPendingApplications().success(function (response) {

		pendingUi.load(response);
	});

	/**
	 * Load Top Applications
	 */
	creditFactory.getTopApplications().success(function (response) {

		topUi.load(response);
	});

	/**
	 * Load Application statistics
	 */
	creditFactory.getStatistic().success(function (response) {

		statsUi.load(response);
	});

	/**
	 * Handler when accept application
	 *
	 * @param requestId
	 */
	$scope.application.accept = function (requestId) {

		creditFactory.accept(requestId).success(function () {

			pendingUi.accept(requestId);
			statsUi.approveIncrement();
		});
	};

	/**
	 * Handler when reject application
	 *
	 * @param requestId
	 */
	$scope.application.reject = function (requestId) {

		creditFactory.reject(requestId).success(function () {

			pendingUi.reject(requestId);
			statsUi.rejectIncrement();
		});
	};

});