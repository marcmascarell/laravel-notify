<?php namespace Mascame\Notify;

use Session;
use Event;
use HTML;
use Config;

class Notify {

	public static $key = 'notifications';
	public static $hooks = array('notifications');

	/**
	 * @param $type
	 * @param null $option
	 * @return mixed|null
	 */
	public static function option($type, $option)
	{
		if (!$option) {
			$key = 'notify::notify.' . $type . '.' . $option;

			if (Config::has($key)) {
				return Config::get($key);
			}
		}

		return $option;
	}

	/**
	 *
	 */
	public static function forget()
	{
		Session::forget(self::$key);
	}

	/**
	 * @param $value
	 * @param bool $autohide
	 */
	public static function success($value, $autohide = false, $icon = null, $dismissable = false)
	{
		Notify::add($value, 'success', $autohide, self::option('success', $icon), self::option('success', $dismissable));
	}

	/**
	 * @param $value
	 * @param bool $autohide
	 */
	public static function info($value, $autohide = false, $icon = null, $dismissable = false)
	{
		Notify::add($value, 'info', $autohide, self::option('success', $icon), self::option('success', $dismissable));
	}

	/**
	 * @param $value
	 * @param bool $autohide
	 */
	public static function warning($value, $autohide = false, $icon = null, $dismissable = false)
	{
		Notify::add($value, 'warning', $autohide, self::option('success', $icon), self::option('success', $dismissable));
	}

	/**
	 * @param $value
	 * @param bool $autohide
	 */
	public static function danger($value, $autohide = false, $icon = null, $dismissable = false)
	{
		Notify::add($value, 'danger', $autohide, self::option('success', $icon), self::option('success', $dismissable));
	}

	/**
	 * @param $value
	 * @param string $type
	 * @param bool $autohide
	 */
	public static function add($value, $type = 'success', $autohide = false, $icon = null, $dismissable = false)
	{
		$notifications = Notify::getAll();

		$notifications[] = array(
			'type'        => $type,
			'value'       => $value,
			'autohide'    => $autohide,
			'icon'        => $icon,
			'dismissable' => $dismissable
		);

		Session::flash(self::$key, $notifications);
	}

	/**
	 * @return mixed
	 */
	public static function getAll()
	{
		return Session::get(self::$key);
	}

	/**
	 * @return mixed
	 */
	public static function all()
	{
		return HTML::notify(self::getAll());
	}

	/**
	 *
	 */
	public static function attach()
	{
		Event::listen(self::$hooks, function () {
			return Notify::getAll();
		});
	}

	public static function javascript()
	{
		?>
		<script>
			$(document).ready(function () {
				setTimeout(function () {
					$('.notify.notify-autohide').fadeOut();
				}, 2500);

				$(".notify.alert-dismissable").click(function() {
					$(this).hide();
				});
			})
		</script>
	<?php
	}



}