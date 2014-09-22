Laravel Notify
=========

Notify is a package to rapidly notificate your users about something using Bootstrap classes

[A nice alternative if this don't satisfy your needs](https://github.com/AndreasHeiberg/laravel-notify)

Installation
--------------
Require this package in your composer.json and run composer update:

    "mascame/notify": "dev-master"

Add to `app/config`:

```php
// the Service Provider
'Mascame\Notify\NotifyServiceProvider'

// the alias
'Notify' => '\Mascame\Notify\Notify'
```


Publish assets and config

```sh
php artisan config:publish mascame/notify
```

Usage
--------------

- Require bootstrap or compatible framework.
- Edit config file to your needs.

In template:
```php
Notify::all();

// blade
{{ Notify::all(); }}
```

In your logic:
```php
// $autohide = false, $icon = null, $dismissable = false

Notify::success('Successfuly notified!');
Notify::danger('Real danger!');
Notify::info('Informed!');
Notify::warning('Warning!');
Notify::loading('Loading...');

Notify::add($value, $type = 'success', $autohide = false, $icon = null, $dismissable = false);
```

A real world example:

```php
// this will autohide and get the default values for icon and dismissable

public function logout()
{
    Auth::logout();
    Notify::success('Successfuly logged out!', true);
    
    return Redirect::to('home');
}
```

License
----

MIT
