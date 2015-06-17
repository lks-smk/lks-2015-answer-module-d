<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repositories;

use App\Entities\Application;
use App\Entities\Entity;
use Illuminate\Database\Eloquent\Collection;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/11/15
 */
class ApplicationRepository extends Repository implements ApplicationRepositoryInterface {

	/**
	 * Entity class
	 *
	 * @var string
	 */
	protected $modelClass = Application::class;

	/**
	 * Find pending applications
	 *
	 * @return Collection
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function findPendingApplications() {

		return $this->model()->where('is_approved', -1)->get();
	}

	/**
	 * Find pending credit application by id
	 *
	 * @param string $id
	 *
	 * @return Entity
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function findPendingApplicationById($id) {

		return $this->model()->where('request_id', $id)->where('is_approved', -1)->first();
	}

	/**
	 * Find top approved or rejected applications
	 *
	 * @return Collection
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function findTopApprovedApplications() {

		return $this->model()->where('is_approved', '!=', -1)->limit(10)->orderBy('request_id', 'desc')->get();
	}

	/**
	 * Find credit applications stats
	 *
	 * @return array
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function findApplicationStatistic() {

		return [

			'approved' => $this->model()->where('is_approved', '=', 1)->count(),
			'rejected' => $this->model()->where('is_approved', '=', 0)->count(),
			'pending'  => $this->model()->where('is_approved', '=', -1)->count()
		];
	}

	/**
	 * Find application credit history
	 *
	 * @param string $status
	 * @param array  $dates
	 * @param array  $sort
	 *
	 * @return mixed
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function findApplicationHistories($status, array $dates, array $sort) {

		$model = $this->model();

		// Validate status if exists
		if ($status != ''
			&& in_array(
				$status, [Application::APPLICATION_STATUS_ACCEPTED, Application::APPLICATION_STATUS_REJECTED]
			)
		) {

			$model = $model->where('is_approved', $status);
		}

		// Validate date setting
		if (!isset($dates['start']) || !isset($dates['end'])) {

			throw new \InvalidArgumentException('Invalid date settings.');
		}

		// Validate sort setting
		if (!isset($sort['field']) || !isset($sort['direction'])) {

			throw new \InvalidArgumentException('Invalid sort settings.');
		}

		$model = $model->where('is_approved', '!=', -1);
		$model = $model->where('request_date', '>=', $dates['start'])->where('request_date', '<=', $dates['end']);
		$model = $model->orderBy($sort['field'], $sort['direction']);

		return $model->get();
	}
}