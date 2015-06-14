/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
app.registerCtrl('HistoryController', function ($scope, $filter, historyUi, creditFactory) {

	//Initialize services
	historyUi.init($scope);

	/**
	 * Initialize datepicker plugin
	 */
	$('#reservation').val($filter('date')(new Date(), 'yyyy-MM-dd - yyyy-MM-dd')).daterangepicker({format: 'YYYY-MM-DD'}, function (start, end) {

		$scope.history.setting.filter.date = {

			start: start.format('YYYY-MM-DD'),
			end: end.format('YYYY-MM-DD')
		};
	});

	/**
	 * Initialize data model
	 *
	 * @type {{setting: {sort: {field: string, direction: string}, filter: {date: *, status: string}}, histories: Array}}
	 */
	$scope.history = {

		setting: {

			sort: {

				field: 'request_id',
				direction: 'asc'
			},
			filter: {

				date: $filter('date')(new Date(), 'yyyy-MM-dd - yyyy-MM-dd'),
				status: ''
			}
		},

		histories: []
	};

	/**
	 * Handler when view history
	 *
	 * @param setting
	 */
	$scope.history.view = function (setting) {

		if (typeof setting.filter.date == 'string') {

			var date = setting.filter.date.split(' - ');

			setting.filter.date = {start: date[0], end: date[1]};
		}

		creditFactory.getHistory(setting.filter.status, setting.filter.date, setting.sort).success(function (response) {

			if (response instanceof Array) {

				historyUi.load(response);
			}
		});
	};
});