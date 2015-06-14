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
 * @created     6/11/15
 */
class CreditWasApplied implements ShouldBeQueued, ShouldBeMailed {

	/**
	 * @var Application
	 */
	private $application;

	/**
	 * @var string
	 */
	private $message;

	/**
	 * Initialize new instance and bind created application
	 *
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