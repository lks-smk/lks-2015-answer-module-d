<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Handlers\Events;
use App\Events\CreditWasApplied;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/11/15
 */
class CreditWasAppliedEventHandler {

	use CreditMailer;

	/**
	 * Handler when credit was applied
	 *
	 * @param CreditWasApplied $event
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function handle(CreditWasApplied $event) {

		$this->mail($event->getApplication(), $event->getMessage());
	}
}