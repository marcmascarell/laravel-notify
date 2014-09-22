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

		HTML::macro('notify', function ($notifications) {

			if (!empty($notifications)) {
				foreach ($notifications as $notification) {
					?>
						<div class="alert notify alert-<?php print $notification['type']; ?> <?php
						(!$notification['dismissable']) ?: print 'alert-dismissable' ?> <?php
						(!$notification['autohide']) ?: print 'notify-autohide' ?>">

							<?php
								if (isset($notification['icon'])) {
									print $notification['icon'];
								}

								if ($notification['dismissable']) {
									?>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<?php
								}

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
