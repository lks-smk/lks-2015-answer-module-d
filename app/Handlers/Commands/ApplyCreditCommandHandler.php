<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Handlers\Commands;
use App\Commands\ApplyCreditCommand;
use App\Entities\Application;
use App\Events\CreditWasApplied;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/11/15
 */
class ApplyCreditCommandHandler extends CommandHandler {

	/**
	 * Handler for apply credit
	 *
	 * @param ApplyCreditCommand $command
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function handle(ApplyCreditCommand $command) {

		$application = Application::applyCredit($command->serialize());

		$this->dispatcher->fire(
			new CreditWasApplied(
				$application,
				sprintf('Your application with request id %s has been submitted.', $application->requestId)
			)
		);
	}
}