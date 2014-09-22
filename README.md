Laravel Notify
=========

Notify is a package to rapidly notificate your users about something using Bootstrap classes

Installation
--------------
Require this package in your composer.json and run composer update:

    "mascame/notify": "dev-master"

Add the Service Provider to `app/config` at the bottom of Providers:

```php
'Mascame\Notify\NotifyServiceProvider'
```
Add the alias:

```php
'Notify' => '\Mascame\Notify\Notify'
```

Publish assets and config

```sh
php artisan config:publish mascame/notify
```

Usage
--------------

Edit config file to your needs.

In template
```php
Notify::all();
```

In your logic
```php
Notify::success('Successfuly notified!');
Notify::danger('Real danger!');
Notify::info('Informed!');
Notify::warning('Warning!');

Notify::add($value, $type = 'success', $autohide = false, $icon = null, $dismissable = false);
```

License
----

MIT
