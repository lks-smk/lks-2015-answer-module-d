<?php namespace App\Providers;

use App\Repositories\ApplicationRepository;
use App\Repositories\ApplicationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->register();
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(ApplicationRepositoryInterface::class, function() {

			return ApplicationRepository::make();
		});
	}

}
