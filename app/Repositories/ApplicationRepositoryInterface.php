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
use App\Entities\Entity;
use Illuminate\Database\Eloquent\Collection;


/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
interface ApplicationRepositoryInterface extends RepositoryInterface {

	/**
	 * @return Collection
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function findPendingApplications();

	/**
	 * @param string $id
	 *
	 * @return Entity
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function findPendingApplicationById($id);

	/**
	 * @return Collection
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function findTopApprovedApplications();

	/**
	 * @return array
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function findApplicationStatistic();

	/**
	 * @param string $status
	 * @param array  $dates
	 * @param array  $sort
	 *
	 * @return mixed
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function findApplicationHistory($status, array $dates, array $sort);
}