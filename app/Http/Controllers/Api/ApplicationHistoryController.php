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
use Illuminate\Http\Request;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/15/15
 */
class ApplicationHistoryController extends Controller {

	protected $repo;

	/**
	 * Initialize new instance
	 *
	 * @param ApplicationRepositoryInterface $repo
	 */
	public function __construct(ApplicationRepositoryInterface $repo) {

		$this->repo = $repo;
	}

	/**
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function index(Request $request) {

		$status = $request->get('status');
		$dates  = $request->get('date');
		$sort   = $request->get('sort');

		try {

			return response()->json($this->repo->findApplicationHistory($status, (array) $dates, (array) $sort));
		}
		catch(\Exception $e) {

			return response()->json([ 'message' => $e->getMessage() ]);
		}
	}
}