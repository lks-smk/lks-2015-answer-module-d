/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/15/15
 */
app.registerCtrl('DebtController', function($scope, $routeParams, creditFactory, debtUi) {

	$scope.credit = {};

	//Init services
	debtUi.init($scope);

	/**
	 * Load detail and list of debt
	 */
	creditFactory.getDebt($routeParams.requestId).success(function(response) {

		debtUi.load(response);
	});
});