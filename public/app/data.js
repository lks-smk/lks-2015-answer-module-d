/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/14/15
 */

var app = angular.module('koperasi.data', []);

app.constant('X_CSRF_TOKEN', angular.element('meta[name=X-CSRF-TOKEN]').attr('content'));

/**
 * Factory Credit Application
 */
app.factory('creditFactory', ['$http', function($http, X_CSRF_TOKEN) {

	return {

		/**
		 * Send apply credit to webservice
		 *
		 * @param credit
		 * @returns {*}
		 */
		apply: function(credit) {

			credit = credit || {};
			credit._token = X_CSRF_TOKEN;

			return $http.post('api/application', credit);
		},

		/**
		 * Send accept credit by request id to webservice
		 *
		 * @param requestId
		 * @returns {*}
		 */
		accept: function(requestId) {

			return $http.patch('api/application/' + requestId + '/status/accept', { _token: X_CSRF_TOKEN });
		},

		/**
		 * Send reject credit by request id to webservice
		 *
		 * @param requestId
		 * @returns {*}
		 */
		reject: function(requestId) {

			return $http.patch('api/application/' + requestId + '/status/reject', { _token: X_CSRF_TOKEN });
		},

		/**
		 * Get pending credit from webservice
		 *
		 * @returns {*}
		 */
		getPendingApplications: function() {

			return $http.get('api/application');
		},

		/**
		 * Get top credit from webservices
		 *
		 * @returns {*}
		 */
		getTopApplications: function() {

			return $http.get('api/application/top');
		},

		/**
		 * Get credit statistics
		 *
		 * @returns {*}
		 */
		getStatistic: function() {

			return $http.get('api/application/stats');
		},

		/**
		 * Get credit history
		 *
		 * @param status
		 * @param date
		 * @param sort
		 * @returns {*}
		 */
		getHistory: function(status, date, sort) {

			return $http.get('api/application/history', {

				params: {
					status              : status,
					"date[start]"       : date.start,
					"date[end]"         : date.end,
					"sort[field]"       : sort.field,
					"sort[direction]"   : sort.direction
				}
			});
		},

		/**
		 * Get detail application and debt list
		 *
		 * @param requestId
		 * @returns {*}
		 */
		getDebt: function(requestId) {

			return $http.get('api/application/' + requestId);
		}
	};
}]);