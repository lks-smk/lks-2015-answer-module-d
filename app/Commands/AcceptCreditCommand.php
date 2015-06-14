<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Commands;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
class AcceptCreditCommand extends Command {

	public $requestId;
	public $acceptBy;

	protected $rules = ['requestId' => 'required'];

	/**
	 * @param string $requestId
	 * @param string $acceptBy
	 */
	public function __construct($requestId, $acceptBy) {

		$this->requestId    = $requestId;
		$this->acceptBy     = $acceptBy;

		$this->validate();
	}

	/**
	 * Serialize command
	 *
	 * @return array
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function serialize() {

		return [

			'requestId' => $this->requestId,
			'acceptBy'  => $this->acceptBy
		];
	}
}