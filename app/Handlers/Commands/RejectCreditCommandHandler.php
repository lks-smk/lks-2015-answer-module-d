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
use Illuminate\Events\Dispatcher;
use App\Repositories\ApplicationRepositoryInterface;
use App\Commands\RejectCreditCommand;
use App\Entities\Application;
use App\Events\CreditWasRejected;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
class RejectCreditCommandHandler extends CommandHandler {

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
	 * Handler when reject credit
	 *
	 * @param RejectCreditCommand $command
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public function handle(RejectCreditCommand $command) {

		/** @var Application $application */
		$application = $this->repo->findPendingApplicationById($command->requestId);

		if ( ! $application) {

			throw new \InvalidArgumentException(sprintf(
				'Pending application with request id %s not found.',
				$command->requestId
			));
		}

		if ($application->reject()) {

			$this->dispatcher->fire(
				new CreditWasRejected(
					$application,
					sprintf('Your application with request id %s has been rejected.', $application->requestId)
				)
			);
		}
	}
}