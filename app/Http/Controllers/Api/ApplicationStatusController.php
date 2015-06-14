<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers\Api;
use App\Commands\RejectCreditCommand;
use App\Http\Controllers\Controller;
use App\Commands\AcceptCreditCommand;
use Illuminate\Http\Request;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
class ApplicationStatusController extends Controller {

	/**
	 * @param Request $request
	 * @param         $requestId
	 * @param         $status
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function update(Request $request, $requestId, $status) {

		try {

			switch($status) {

				case 'accept':
					$command = new AcceptCreditCommand($requestId, $request->session()->get('username'));
					break;

				case 'reject':
					$command = new RejectCreditCommand($requestId);
					break;

				default:
					throw new \InvalidArgumentException(sprintf('Status %s not defined.', $status));
			}

			$this->dispatch($command);

			$code       = 200;
			$response   = array('success' => true, 'message' => sprintf('Application has been %sed.', $status));
		}
		catch(\Exception $e) {

			$code       = 400;
			$response   = array('success' => false, 'message' => $e->getMessage());
		}

		return response()->json($response, $code);
	}
}