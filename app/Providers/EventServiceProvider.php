<?php namespace App\Providers;

use App\Events\CreditWasAccepted;
use App\Events\CreditWasApplied;
use App\Handlers\Events\CreditWasAcceptedEventHandler;
use App\Handlers\Events\CreditWasAppliedEventHandler;
use App\Events\CreditWasRejected;
use App\Handlers\Events\CreditWasRejectedEventHandler;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [

		CreditWasApplied::class => [

			CreditWasAppliedEventHandler::class
		],

	    CreditWasAccepted::class => [

		    CreditWasAcceptedEventHandler::class
	    ],

	    CreditWasRejected::class => [

		    CreditWasRejectedEventHandler::class
	    ]
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
