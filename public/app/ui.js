/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/14/15
 */
var app = angular.module('koperasi.ui', []);

/**
 * Pending UI Service
 */
app.service('pendingUi', function(topUi) {

	var scope;

	/**
	 * Registering scope
	 *
	 * @param $scope
	 */
	this.init = function($scope) {

		scope = $scope;
		topUi.init(scope);
	};

	/**
	 * Bind data result to ui
	 *
	 * @param data
	 */
	this.load = function(data) {

		scope.application.pending = data;
	};

	/**
	 * Accept credit
	 *
	 * @param requestId
	 */
	this.accept = function(requestId) {

		this.remove(requestId, function(credit) {

			credit.isApproved = 1;
			topUi.add(credit);
		});
	};

	/**
	 * Reject credit
	 *
	 * @param requestId
	 */
	this.reject = function(requestId) {

		this.remove(requestId, function(credit) {

			credit.isApproved = 0;
			topUi.add(credit);
		});
	};

	/**
	 * Remove an item from ui by request id
	 *
	 * @param requestId
	 * @param callback
	 */
	this.remove = function(requestId, callback) {

		var curr, i;

		for (i = 0; i < scope.application.pending.length; i++) {

			curr = scope.application.pending[i];

			if (curr.requestId == requestId) {

				scope.application.pending.splice(i, 1);

				if (typeof callback == 'function') {

					callback(curr, i);
				}
				break;
			}
		}
	};
});

/**
 * Statistic Ui Service
 */
app.service('statsUi', function() {

	var scope;

	/**
	 * Register scope
	 *
	 * @param $scope
	 */
	this.init = function($scope) {

		scope = $scope;
	};

	/**
	 * Increment accepted stats
	 */
	this.approveIncrement = function() {

		++scope.application.stats.approved;
	};

	/**
	 * Increment rejected stats
	 */
	this.rejectIncrement = function() {

		++scope.application.stats.rejected;
	};

	/**
	 * Bind stats to ui
	 *
	 * @param stats
	 */
	this.load = function(stats) {

		scope.application.stats = stats;
	};
});

/**
 * Top UI Service
 */
app.service('topUi', function() {

	var scope;

	/**
	 * Registering scope
	 *
	 * @param $scope
	 */
	this.init = function($scope) {

		scope = $scope;
	};

	/**
	 * Add an item to ui
	 *
	 * @param item
	 */
	this.add = function(item) {

		scope.application.top.unshift(item);
	};

	/**
	 * Bind sets of data
	 *
	 * @param data
	 */
	this.load = function(data) {

		scope.application.top = data;
	};
});

/**
 * History Ui Service
 */
app.service('historyUi', function() {

	var scope;

	/**
	 * Registering scope
	 *
	 * @param $scope
	 */
	this.init = function($scope) {

		scope = $scope;
	};

	/**
	 * Bind sets of data to ui
	 *
	 * @param data
	 */
	this.load = function(data) {

		scope.history.histories = data;
	};
});

/**
 * Debt UI Service
 */
app.service('debtUi', function() {

	var scope;

	/**
	 * Registering scope
	 *
	 * @param $scope
	 */
	this.init = function($scope) {

		scope = $scope;
	};

	/**
	 * Bind sets of data
	 *
	 * @param data
	 */
	this.load = function(data) {

		scope.credit = data;
	};
});

/**
 * Simulation Ui Service
 */
app.service('simulationUi', function() {

	var scope;

	/**
	 * Registering scope
	 *
	 * @param $scope
	 */
	this.init = function($scope) {

		scope = $scope;

		scope.simulation = {
			submitText  : 'Submit',
			simulated   : false,
			saving      : false,
			credit      : { tenor: 6 },
			schedule    : []
		};
	};

	/**
	 * Get calculated montly payment
	 *
	 * @param ir Interest rate
	 * @param am Amount
	 * @param tr Tenor
	 *
	 * @returns {number}
	 */
	this.getMonthlyPayment = function(ir, am, tr) {

		ir = ir / 1200;

		return ir * -am * Math.pow((1 + ir), tr) / (1 - Math.pow((1 + ir), tr));
	};

	/**
	 * Generate debt schedule by amount and tenor
	 *
	 * @param am Amount
	 * @param tr Tenor
	 * @returns {Array}
	 */
	this.generateDebtSchedule = function(am, tr) {

		var mp          = this.getMonthlyPayment(2, am, tr), //Monthly payment
			schedules   = [],
			balance,
			item,
			i;

		for(i = 0; i < tr; i++) {

			balance = i == 0 ? am : schedules[i - 1].balance;

			item = {};
			item.paymentAmount  = mp;
			item.interest       = (balance * 2) / 1200;
			item.principalDebt  = mp - item.interest;
			item.balance        = balance - item.principalDebt;
			item.paymentDate    = new Date();

			item.paymentDate.setMonth(item.paymentDate.getMonth() + (i + 1));

			schedules.push(item);
		}

		return schedules;
	};

	/**
	 * Bind data to ui
	 *
	 * @param data
	 */
	this.load = function(data) {

		scope.simulation.schedule = data;
	};

	/**
	 * Clear form data
	 */
	this.clear = function() {

		scope.simulation.credit     = { tenor: 6 };
		scope.simulation.schedule   = [];
	};

	/**
	 * Enable and reset form
	 */
	this.enable = function() {

		scope.simulation.submitText = 'Submit';
		scope.simulation.simulated  = false;
		scope.simulation.saving     = false;
	};

	/**
	 * Reset simulation
	 */
	this.reset = function() {

		scope.calculatorForm.$setPristine();
		scope.creditForm.$setPristine();

		this.clear();
		this.enable();
	};
});