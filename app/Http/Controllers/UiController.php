<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
class UiController extends Controller {

	/**
	 * @param $view
	 *
	 * @return \Illuminate\View\View
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function handle($view) {

		return view($view);
	}
}