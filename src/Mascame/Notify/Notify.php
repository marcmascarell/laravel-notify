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
	public static function option($type, $option, $value = null)
	{
		if (!$value) {
			$key = 'notify::notify.' . $type . '.' . $option;

			if (Config::has($key)) {
				return Config::get($key);
			}
		}

		return $value;
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
	public static function success($value, $autohide = false, $icon = false, $dismissable = false)
	{
		Notify::add($value, 'success', $autohide, $icon, $dismissable);
	}

	/**
	 * @param $value
	 * @param bool $autohide
	 */
	public static function info($value, $autohide = false, $icon = false, $dismissable = false)
	{
		Notify::add($value, 'info', $autohide, $icon, $dismissable);
	}

	/**
	 * @param $value
	 * @param bool $autohide
	 */
	public static function warning($value, $autohide = false, $icon = false, $dismissable = false)
	{
		Notify::add($value, 'warning', $autohide, $icon, $dismissable);
	}

	/**
	 * @param $value
	 * @param bool $autohide
	 */
	public static function danger($value, $autohide = false, $icon = false, $dismissable = false)
	{
		Notify::add($value, 'danger', $autohide, $icon, $dismissable);
	}

	/**
	 * @param $value
	 * @param bool $autohide
	 */
	public static function loading($value, $autohide = false, $icon = false, $dismissable = false)
	{
		Notify::add($value, 'loading', $autohide, $icon, $dismissable);
	}

	/**
	 * @param $value
	 * @param string $type
	 * @param bool $autohide
	 */
	public static function add($value, $type = 'success', $autohide = false, $icon = false, $dismissable = false)
	{
		$notifications = Notify::getAll();

		$notifications[] = array(
			'type'        => $type,
			'value'       => $value,
			'autohide'    => $autohide,
			'icon'        => (is_bool($icon) && $icon === true || self::option('default', 'show_icon')) ? self::option($type, 'icon') : $icon,
			'class'       => self::option($type, 'class'),
			'dismissable' => self::option($type, 'dismissable', $dismissable),
			'default' => array(
				'class' => self::option('default', 'class')
			)
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