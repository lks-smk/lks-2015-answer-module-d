/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
app.registerCtrl('SimulationController', ['$scope', '$route', 'simulationUi', 'creditFactory', function($scope, $route, simulationUi, creditFactory) {

	//Initialize services
	simulationUi.init($scope);

	/**
	 * Handler when simulating
	 *
	 * @param credit
	 */
	$scope.simulation.calc = function(credit) {

		var schedules = simulationUi.generateDebtSchedule(credit.loanAmount, credit.tenor);

		simulationUi.load(schedules);

		$scope.simulation.simulated = !!schedules.length;
	};

	/**
	 * Handler when save simulation
	 *
	 * @param credit
	 */
	$scope.simulation.save = function(credit) {

		if ($scope.simulation.saving === true) {

			return;
		}

		$scope.simulation.submitText    = 'Submitting';
		$scope.simulation.saving        = true;

		creditFactory
			.apply(credit)
			.success(function() {

				simulationUi.reset();

				$scope.simulation.success   = true;
				$scope.simulation.error     = false;
			})
			.error(function() {

				simulationUi.enable();

				$scope.simulation.simulated = true;
				$scope.simulation.success   = false;
				$scope.simulation.error     = true;
			});
	};
}]);