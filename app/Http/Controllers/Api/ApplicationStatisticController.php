<?php
/*
 * This file is part of the Module D package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Repositories\ApplicationRepositoryInterface;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/15/15
 */
class ApplicationStatisticController extends Controller {

	protected $repo;

	/**
	 * Initialize instance
	 *
	 * @param ApplicationRepositoryInterface $repo
	 */
	public function __construct(ApplicationRepositoryInterface $repo) {

		$this->repo = $repo;
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function index() {

		return response()->json($this->repo->findApplicationStatistic());
	}
}