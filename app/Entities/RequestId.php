<?php
/*
 * This file is part of the Module D package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entities;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/17/15
 */
class RequestId {

	private $_id;

	/**
	 * Initialize new instance and do generate new id
	 */
	public function __construct() {

		$this->_id = $this->generate();
	}

	/**
	 * @return string
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function __toString() {

		return $this->_id;
	}

	/**
	 * Generate new id by last credit application
	 *
	 * @return string
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	protected function generate() {

		$last = Application::orderBy('request_id', 'desc')->first();
		$num  = 0;

		if ($last) {

			$num = str_replace('OR', '', $last->requestId);
			$num = (int)$num;
		}

		return sprintf('OR%04d', $num + 1);
	}
}