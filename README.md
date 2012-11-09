# php-fas - PHP Authentication Library for FAS

```php
$user = id(new FAS())
  ->setDebug(2)
  ->setUsername($username)
  ->setPassword($password);
echo $fas->authenticate() ? 'OK' : 'Failed';
```

Normally, you'd store the output of `$fas->authenticate()`, and check it
(using `===`). If it's `false`, auth failed. Otherwise, it contains an
instance of `FASUser`, which contains information about a given user.

# License

GPLv2, same as FAS.
