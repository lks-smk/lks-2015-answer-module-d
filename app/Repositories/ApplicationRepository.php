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
	 * @return Collection
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function findTopApprovedApplications() {

		return $this->model()->where('is_approved', '!=', -1)->limit(10)->get();
	}
}