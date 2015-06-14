<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Events;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Entities\Application;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
class CreditWasAccepted implements ShouldBeQueued, ShouldBeMailed {

	private $message;
	private $application;

	/**
	 * @param Application $application
	 * @param string      $message
	 */
	public function __construct(Application $application, $message) {

		$this->application  = $application;
		$this->message      = $message;
	}

	/**
	 * @return string
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function getMessage() {

		return $this->message;
	}

	/**
	 * @return Application
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function getApplication() {

		return $this->application;
	}
}