<?php namespace Mascame\Notify;

use Illuminate\Support\ServiceProvider;
use HTML;
use Config;

class NotifyServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('mascame/notify');

		$this->app['notify'] = $this->app->share(function ($app) {
			return new PublishCommand();
		});

		$this->commands('notify');

		HTML::macro('notify', function ($notifications) {

			if (!empty($notifications)) {

				foreach ($notifications as $notification) {
					?>
						<div class="<?php print $notification['default']['class']; ?> <?php print $notification['class']; ?> <?php
						(!$notification['dismissable']) ?: print 'alert-dismissable' ?> <?php
						(!$notification['autohide']) ?: print 'notify-autohide' ?>">

							<?php
								print $notification['icon'] . ' ';

								if ($notification['dismissable']) { ?>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<?php }

								print $notification['value'];
							?>
						</div>
					<?php
				}

				Notify::javascript();
				Notify::forget();
			} else {
				print "<!-- No notifications -->";
			}
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
