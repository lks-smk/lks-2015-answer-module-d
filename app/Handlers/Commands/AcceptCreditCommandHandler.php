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
use App\Commands\AcceptCreditCommand;
use App\Entities\Application;
use App\Events\CreditWasAccepted;
use App\Repositories\ApplicationRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
class AcceptCreditCommandHandler extends CommandHandler {

	protected $repo;

	/**
	 * @param Dispatcher                     $dispatcher
	 * @param ApplicationRepositoryInterface $repository
	 */
	public function __construct(Dispatcher $dispatcher, ApplicationRepositoryInterface $repository) {

		parent::__construct($dispatcher);
		$this->repo = $repository;
	}

	/**
	 * Handler when accept application
	 *
	 * @param AcceptCreditCommand $command
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function handle(AcceptCreditCommand $command) {

		/** @var Application $application */
		$application = $this->repo->findPendingApplicationById($command->requestId);

		if ( ! $application) {

			throw new \InvalidArgumentException(sprintf(
				'Pending application with request id %s not found.',
				$command->requestId
			));
		}

		if ($application->accept($command->acceptBy)) {

			$this->dispatcher->fire(
				new CreditWasAccepted(
					$application,
					sprintf('Your application with request id %s has been accepted.', $application->requestId)
				)
			);
		}
	}
}